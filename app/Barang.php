<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    protected $table = 'barang';
    public $timestamps = false;
    protected $primaryKey = 'id_barang';
    protected $fillable = ['namabarang','id_barang','id_category','image','deskripsi','harga','size','jumlah'];
}
