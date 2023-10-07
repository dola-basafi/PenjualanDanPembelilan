@extends('template')
@section('title','Detail Sale')
@section('navName','Detail Sale')
@section('content')
    @php
        $a = ""
    @endphp
<table id="sale" class="table table table-striped">
  <thead>
    <tr>
      <th>NO</th>
      <th>Name</th>
      <th>Stock</th>
      <th>Qty</th>
      <th>Price</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($data as $item)
    
    <tr>
      <td>{{ $loop->index + 1 }}</td>
      <td>{{ $item->inventory->name }}</td>
      <td>{{ $item->inventory->stock }}</td>
      <td>            
            <form action="{{ route('salesUpdate',$item->id) }}" method="post">
              @csrf
              <input type="number" name="qty" id="qty" value="{{ $item->qty }}">
              <button class="btn btn-info" type="submit">Update</button>
            </form>
            </td>
            <td>{{ $item->price }}</td>
            <td>
              <form action="{{ route('salesDestroyDetail',$item->id) }}" method="post">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete</button>
              </form>
            </td>
          </tr>
          @endforeach
  </tbody>
</table>

<script>
  new DataTable('#sale')
</script>



@endsection