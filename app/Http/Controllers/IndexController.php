<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;

class IndexController extends Controller
{
    public function index()
    {
        $Barang = Barang::all(); // mengambil data Barang

        return view('index', ['Barang' => $Barang]);
    }
}
