@extends('template')
@section('title','Login')
@section('navName','Login')
@section('content')
<form method="POST" action="{{ route('login') }}">
  @csrf
  <div class="mb-3 mt-3">
    <label for="email" class="form-label">Email address</label>
    <input type="email" class="form-control" id="email" aria-describedby="email" name="email">
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" id="password" name="password">
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection    
