@extends('template')
@section('title','Data Sales')
@section('navName','Data Sales')
@section('content')
<table id="sale" class="table table table-striped display nowrap">
  <thead>
    <tr>
      <th>NO</th>
      <th>Number</th>
      <th>Date</th>
      <th>Di buat oleh</th>
      
    </tr>
  </thead>
  <tbody>
    @foreach ($data as $item)
      <tr>
        <td>{{ $loop->index + 1 }}</td>
        <td>{{ $item->number }}</td>
        <td>{{ $item->date }}</td>
        <td>{{ $item->user->name }}</td>
       
      </tr>
    @endforeach
  </tbody>
</table>

<script>
 $(document).ready(function() {
    $('#sale').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
</script>
@endsection