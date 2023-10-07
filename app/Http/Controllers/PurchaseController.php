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
}
