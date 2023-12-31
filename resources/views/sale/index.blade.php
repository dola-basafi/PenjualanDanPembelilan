@extends('template')
@section('title', 'Sales List')
@section('navName', 'Sales List')
@section('content')
  <table id="sale" class="table table table-striped">
    <thead>
      <tr>
        <th>NO</th>
        <th>Number</th>
        <th>Date</th>
        <th>Di buat oleh</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($data as $item)
        <tr>
          <td>{{ $loop->index + 1 }}</td>
          <td>{{ $item->number }}</td>
          <td>{{ $item->date }}</td>
          <td>{{ $item->user->name }}</td>
          <td>
            <form action="{{ route('salesDestroy',$item->id) }}" method="post">
              @csrf
              @method('delete')
              <a href="{{ route('salesDetail', $item->id) }}" class="btn btn-info">Detail</a>
              <button class="btn btn-danger" type="submit">Delete</button>
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
