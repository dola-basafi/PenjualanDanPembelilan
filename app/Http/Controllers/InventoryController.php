<?php

namespace App\Http\Controllers;

use App\Models\Inventory;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
  function index(){
    $data = Inventory::all();
    return view('inventory.index',compact('data'));
  }
  function edit(Request $request, $id){
    $data = Inventory::find($id);
    return view('inventory.edit',compact('data'));
  }
  function create(){
    return view('inventory.create');
  }
  function store(Request $request){
    $validate = $request->validate([
      'code' => ['required','unique:inventories'],
      'name' => ['required'],
      'price' => ['required','numeric','min:1'],
      'stock' => ['required','numeric','min:1']
    ],[
      'required' => ':attribute tidak boleh kosong',
      'min' => ':attribute harus lebih besar dari 0',
      'unique' => ':attribute kode sudah pernah di gunakan'

    ]);

    Inventory::create($validate);

    return redirect()->route('invIndex')->with('success','berhasil menambahkan data inventory');
  }
  function update(Request $request,$id){
    $data = Inventory::find($id);
    $validate = $request->validate([
      'code' => ['required'],
      'name' => ['required'],
      'price' => ['required','numeric','min:1'],
      'stock' => ['required','numeric','min:1']
    ],[
      'required' => ':attribute tidak boleh kosong',
      'min' => ':attribute harus lebih besar dari 0'
    ]);

    $data->update($validate);
    return redirect()->route('invIndex')->with('success','berhasil menambahkan data inventory');
  }
  function destroy($id){
    $data = Inventory::find($id);
    $data->delete();
    return redirect()->route('invIndex')->with('success','berhasil menghapus data inventory');

  }
}
