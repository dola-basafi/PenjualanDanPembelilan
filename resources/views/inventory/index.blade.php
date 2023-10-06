@extends('template')
@section('title', 'Inventory')
@section('navName', 'Inventory')
@section('content')
    <a href="{{ route('invCreate') }}" class="btn btn-info mb-2">
      Add Data
    </a>
    <table id="inventory" class="table table-striped">
      <thead>
        <tr>
          <th>Kode</th>
          <th>Nama</th>
          <th>Stock</th>
          <th>Harga</th>
         
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        @foreach ($data as $item)
            <tr>
              <td>{{ $item->code }}</td>
              <td>{{ $item->name }}</td>
              <td>{{ $item->stock }}</td>
              <td>{{ $item->price }}</td>

              @if (auth()->user()->role == 1)
              <td>
                <form action="{{ route('indDelete',$item->id) }}" method="post">
                  @csrf
                  @method('delete')
                  <button type="submit" class="btn btn-danger">delete</button>
                  <a href="{{ route('invEdit',$item->id) }}" class="btn btn-primary">edit</a>
                </form>
              </td>              
              @endif
            </tr>
        @endforeach
      </tbody>
    </table>
    <script>
      new DataTable('#inventory');
    </script>
@endsection
