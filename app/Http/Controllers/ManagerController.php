<?php

namespace App\Http\Controllers;

use App\Models\Purchase;
use App\Models\Sale;
use Illuminate\Http\Request;

class ManagerController extends Controller
{
  function index(){
    return view('manager.index');
  }
  function sales(){
    $data = Sale::all();
    return view('manager.sales',compact('data'));
  }
  function purchases(){
    $data = Purchase::all();
    return view('manager.purchase',compact('data'));
  }
}
