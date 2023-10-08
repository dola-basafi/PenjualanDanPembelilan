@extends('template')
@section('title','Detail Purchase')
@section('navName','Detail Purchase')
@section('content')
   
<table id="purchase" class="table table table-striped">
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
    @dd($item)
    <tr>
      <td>{{ $loop->index + 1 }}</td>
      <td>{{ $item->inventory->name }}</td>
      <td>{{ $item->inventory->stock }}</td>
      <td>            
            <form action="{{ route('purchaseUpdate',$item->id) }}" method="post">
              @csrf
              <input type="number" name="qty" id="qty" value="{{ $item->qty }}">
              <button class="btn btn-info" type="submit">Update</button>
            </form>
            </td>
            <td>{{ $item->price }}</td>
            <td>
              <form action="{{ route('purchaseDestroyDetail',$item->id) }}" method="post">
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
  new DataTable('#purchase')
</script>



@endsection