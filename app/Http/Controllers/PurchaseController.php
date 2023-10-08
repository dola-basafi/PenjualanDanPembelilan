<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PurchaseController extends Controller
{
  function store(Request $request){
    $validate = $request->validate([
      'data.*.id' => ['required','numeric'],
      'data.*.qty' =>['required','numeric','min:1'],
    ],[
      'required' => ':attribute tidak boleh kosong',
      'numeric' => ':attribute harus angka',
      'min' => 'qty minimal 1'
    ]);
    $number = Purchase::latest()->first();
    if ($number == null) {
      $number = '1'.date('dmy');
    }else{
      $number = ($number->id+1).date('dmy');
    }      
    $purchase = Purchase::create([
      'date' => Carbon::now(),
      'number' => intVal($number),
      'user_id' => $request->user()->id
    ]);     
    foreach ($validate['data'] as $val) {
      $inventory = Inventory::find($val['id']);   
       
      $inventory['stock'] = $inventory['stock'] + $val['qty'];
      $inventory->update();
      
      $val['purchase_id'] = $purchase->id ;
      $val['inventory_id'] = $val['id'];
      $val['price'] = $inventory['price'];
      unset($val['id']);
      PurchaseDetail::create($val);
    }
    return redirect()->route('invIndex')->with('success','anda berhasil menjual barang');

  }
  function index(Request $request){
    if ($request->user()->role == 1) {
      $data = Purchase::with('user:id,name')->get();
    } else {
      $data = Purchase::with('user:id,name')->where('user_id', $request->user()->id)->get();
    }
    return view('purchase.index', compact('data'));
  }
  function detail(Request $request, $id)
  {
    $purchase = Purchase::find($id);
    $data = PurchaseDetail::with('inventory:id,name,stock')->where('purchase_id', $id)->get();
    if ($purchase->user_id != $request->user()->id and $request->user()->role != 1) {
      return redirect()->back()->withErrors('anda tidak di perbolehkan mengakses data ini');
    }
    return view('purchase.detail', compact('data', 'id'));
  }
  function update($id, Request $request)
  {

    $data = PurchaseDetail::with('purchase.user:id', 'inventory:id,stock')->find($id);
    if ($data->purchase->user->id != $request->user()->id and $request->user()->role != 1) {
      return redirect()->back()->withErrors('anda tidak di perbolehkan mengakses data ini');
    }
    $validate = $request->validate([
      'qty' => ['required', 'numeric', 'min:1'],
    ], [
      'required' => ':attribute tidak boleh kosong',
      'min' => ':attribute harus lebih besar dari 0'
    ]);

    
    $data['qty'] = $validate['qty'];
    $data->update();
    return redirect()->back()->with('success', 'berhasil update data');
  }
  function destroyPurchasesDetatils($id, Request $request)
  {
    $data = PurchaseDetail::with('purchase.user:id', 'inventory:id,stock')->find($id);
    if ($data->purchase->user->id != $request->user()->id and $request->user()->role != 1) {
      return redirect()->back()->withErrors('anda tidak di perbolehkan mengakses data ini');
    }
    $data->delete();
    return redirect()->back()->with('success', 'berhasil hapus data');
  }

  function destroy(Request $request, $id)
  {
    $data = Purchase::with('user')->find($id);
    if ($data->user->id != $request->user()->id and $request->user()->role != 1) {
      return redirect()->back()->withErrors('anda tidak di perbolehkan mengakses data ini');
    }
    PurchaseDetail::where('purchase_id',$id)->delete();
    $data->delete();  
    return redirect()->route('purchaseIndex')->with('success','data berhasil di hapus');
  }
}
