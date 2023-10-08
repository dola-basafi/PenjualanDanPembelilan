@extends('template')
@section('title','Purchase')
@section('navName','Purchase')
@section('content')
<table id="purchase" class="table table table-striped">
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
          <form action="{{ route('purchaseDestroy',$item->id) }}" method="post">
            @csrf
            @method('delete')
            <a href="{{ route('purchaseDetail', $item->id) }}" class="btn btn-info">Detail</a>
            <button class="btn btn-danger" type="submit">Delete</button>
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