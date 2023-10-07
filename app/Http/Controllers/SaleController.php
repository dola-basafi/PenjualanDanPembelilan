<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use App\Models\Sale;
use App\Models\SalesDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SaleController extends Controller
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
      $number = Sale::latest()->first();
      if ($number == null) {
        $number = '1'.date('dmy');
      }else{
        $number = ($number->id+1).date('dmy');
      }      
      $sales = Sale::create([
        'date' => Carbon::now(),
        'number' => intVal($number),
        'user_id' => $request->user()->id
      ]);     
      foreach ($validate['data'] as $val) {
        $inventory = Inventory::find($val['id']);   
        if ($val['qty'] > $inventory['stock']) {
          return redirect()->route('invIndex')->withErrors('qty '.$inventory['name'].' tidak boleh lebih besar dari stock yang ada');
        }     
        $inventory['stock'] = $inventory['stock'] - $val['qty'];
        $inventory->update();
        
        $val['sale_id'] = $sales->id ;
        $val['inventory_id'] = $val['id'];
        $val['price'] = $inventory['price'];
        unset($val['id']);
        SalesDetail::create($val);
      }
      return redirect()->route('invIndex')->with('success','anda berhasil menjual barang');

    }
    function index(Request $request){
      if ($request->user()->role == 1) {
        $data = Sale::with('user:id,name')->get();
      }else{
        $data = Sale::with('user:id,name')->where('user_id',$request->user()->id)->get();
      }
      return view('sale.index',compact('data'));
    }
    function detail(Request $request ,$id){
      $sales = Sale::find($id);
      $data = SalesDetail::with('inventory:id,name')->where('sale_id',$id)->get();
      if ($sales->user_id != $request->user()->id and $request->user()->role != 1) {
        return redirect()->back()->withErrors('anda tidak di perbolehkan mengakses data ini');
      }
      $data['id'] = $id;
      return view('sale.detail',compact('data'));

    }
    function edit($id,Request $request){
      $data = SalesDetail::with('sale.user:id','inventory:id,stock')->find($id);
      if ($data->sale->user->id != $request->user()->id and $request->user()->role != 1) {
        return redirect()->back()->withErrors('anda tidak di perbolehkan mengakses data ini');        
      }
     
      dd('test');
    }

    function update($id, Request $request){

      dd($request->all());
      $data = SalesDetail::with('sale.user:id','inventory:id,stock')->find($id);
      if ($data->sale->user->id != $request->user()->id and $request->user()->role != 1) {
        return redirect()->back()->withErrors('anda tidak di perbolehkan mengakses data ini');        
      }
      $validate = $request->validate([
        'price' => ['required','numeric','min:1'],
        'qty' => ['required','numeric','min:1'],
      ] ,[
        'required' => ':attribute tidak boleh kosong',
        'min' => ':attribute harus lebih besar dari 0'
      ]);

      if ($validate['qty'] > $data->inventory->stock) {
        return redirect()->route('invIndex')->withErrors('qty  tidak boleh lebih besar dari stock yang ada');
      } 
    }
}
