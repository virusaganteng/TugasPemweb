@extends('layouts.app')

@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
            <div class="card-body">
            <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Nama Barang</th>
      <th scope="col">Image</th>
      <th scope="col">Deskripsi</th>
      <th scope="col">Harga</th>
      <th scope="col">Jumlah</th>
      <th scope="col">Action</th>
    </tr>
  </thead>
  <tbody>
    @foreach($table as $index => $table)
    <tr>
      <th scope="row">{{$index+1}}</th>
      <td>{{ $table->namabarang }}</td>
      <td><img style="height:100px;" src="{{ asset('storage/product/'.$table->image) }}"></td>
      <td>{{ $table->deskripsi}}</td>
      <td>{{ $table->harga }}</td>
      <td>{{$table->jumlah}}</td>
      <td>EDIT | <a href="{{url('delete/'.$table->id_barang)}}">DELETE</a></td>
     </tr> 
      @endforeach
  </tbody>
</table>
        </div>
    </div>
</div>

@endsection
