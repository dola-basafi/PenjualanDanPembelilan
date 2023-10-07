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
      <th>Qty</th>
      <th>Price</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
    <form action="{{ route('salesUpdate',$data['id']) }}" method="post">
    @foreach ($data as $item)
    @php
        $a =  $item->inventory->name
    @endphp
{{ $a }}
        <tr>
          <td>{{ $loop->index + 1 }}</td>
          <td>{{ $item->inventory->name }}</td>
          <td>            
              <input type="number" name="qty[$loop->index]" id="qty" value="{{ $item->qty }}">
            </td>
            <td>{{ $item->price }}</td>
            <td>
              <a href="{{ route('salesEdit',$item->id) }}" class="btn btn-info">Edit</a>
            </td>
          </tr>
          @endforeach
          <button class="btn btn-info">Update</button>
        </form>
  </tbody>
</table>

<script>
  new DataTable('#sale')
</script>



@endsection