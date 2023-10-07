@extends('template')
@section('title','Login')
@section('navName','Login')
@section('content')
<form method="POST" action="{{ route('invUpdate',$data->id) }}">
  @csrf
  <div class="mb-3 mt-3">
    <label for="qty" class="form-label">Kode </label>
    <input type="text" class="form-control" id="qty" aria-describedby="qty" name="qty" value="{{ $data->qty }}">
  </div>
  <div class="mb-3 mt-3">
    <label for="name" class="form-label">Nama </label>
    <input type="text" class="form-control" id="name" aria-describedby="name" name="name" value="{{ $data->name }}">
  </div>
  <div class="mb-3 mt-3">
    <label for="price" class="form-label">Harga </label>
    <input type="number" class="form-control" id="price" aria-describedby="price" name="price" value="{{ $data->price }}">
  </div>

  <div class="mb-3 mt-3">
    <label for="stock" class="form-label">stock </label>
    <input type="number" class="form-control" id="stock" aria-describedby="stock" name="stock" value="{{ $data->stock }}">
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection