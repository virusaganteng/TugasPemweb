@extends('layouts.app')

@section('content')

@if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-15">
            <div class="card">
            <div class="card-body">
              <table class="table">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Id_Order</th>
      <th scope="col">Method Payment</th>
      <th scope="col">Alamat</th>
      <th scope="col">Zipcode</th>
      <th scope="col">NoTelp</th>
      <th scope="col">Tanggal Sewa</th>
      <th scope="col">Tanggal Kembali</th>
      <th scope="col">Jumlah Bayar</th>
    </tr>
  </thead>
  <tbody>
  
  
    @foreach($table as $index => $table)
  
    <tr>
      <th scope="row">{{$index+1}}</th>
      <td>{{$table->id_order}}</td>
      <td>{{$table->tipepembayaran . " " . $table->norek}}</td>
      <td>{{ $table->alamat }}</td>
      <td>{{$table->zipcode}}</td>
      <td>{{$table->notelp}}</td>
      <td>{{$table->tanggalsewa}}</td>
      <td>{{$table->tanggalkembali}}</td>
      <td>{{"Rp ". $table->jumlahbayar}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
            </div>
        </div>
    </div>
</div>

@endsection
