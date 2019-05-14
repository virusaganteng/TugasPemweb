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
               <form method="POST" enctype="multipart/form-data" action="{{ route('addpost') }}">
                {{ csrf_field() }}
                   <div class="form-group">
                    <label class="NamaBarang">Nama Barang</label>
                    <input type="text" class="form-control" name="namabarang" id="NamaBarang" placeholder="Product" name="">
                    <label class="Category">Category</label>
                    <select name="id_category" id="id_category" class="form-control form-control-sm">
                    @foreach ($join as $j)
                    <option value="{{$j->id_category}}">{{$j->namacategory}}</option>
                    @endforeach
                    </select>
                   </div>
                   <div class="form-group">
                    <label class="upload">Upload Gambar</label>
                    <input type="file" class="form-control-file" id="upload" name="image">
                   </div>
                   <div class="form-group">
                    <label class="deskripsi">Deskripsi Barang</label>
                    <textarea id="deskripsi" name="deskripsi" class="form-control"></textarea>
                   </div>
                   <div class="form-group">
                    <label class="harga">harga</label>
                    <input style="width: 150px;" type="text" placeholder="1000" name="harga" id="harga" class="form-control"></input>
                   </div>
                   <div class="form-group">
                    <label class="size">Size</label>
                    <select multiple class="form-control" name="size" id="size">
                        <option value="M">M</option>
                        <option value="L">L</option>
                        <option value="XL">XL</option>
                    </select>
                   </div>
                   <div class="form-group">
                    <label class="stock">Jumlah Stock</label>
                    <input style="width: 150px;" type="text" placeholder="10" name="stock" id="stock" class="form-control"></input>
                   </div>
                   <button type="s" class="form-control">Submit</button>
               </form> 
            </div>
        </div>
    </div>
</div>

@endsection
