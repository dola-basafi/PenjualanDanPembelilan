@extends('template')
@section('title','Create Inventory')
@section('navName','Create Inventory')
@section('content')
<form method="POST" action="{{ route('invStore') }}">
  @csrf
  <div class="mb-3 mt-3">
    <label for="code" class="form-label">Kode </label>
    <input type="text" class="form-control" id="code" aria-describedby="code" name="code">
  </div>
  <div class="mb-3 mt-3">
    <label for="name" class="form-label">Nama </label>
    <input type="text" class="form-control" id="name" aria-describedby="name" name="name">
  </div>
  <div class="mb-3 mt-3">
    <label for="price" class="form-label">Harga </label>
    <input type="number" class="form-control" id="price" aria-describedby="price" name="price">
  </div>

  <div class="mb-3 mt-3">
    <label for="stock" class="form-label">stock </label>
    <input type="number" class="form-control" id="stock" aria-describedby="stock" name="stock">
  </div>
 
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection