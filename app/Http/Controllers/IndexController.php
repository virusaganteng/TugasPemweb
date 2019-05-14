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
    public function product($id){
    	$Barang = Barang::find($id);
    	if (!$Barang) {
    		abort(404);
    	}
    	else return view('product', ['Barang' => $Barang]);
    }
    public function cart(){
    	if (session('cart') == null) {
    		abort(404);
    	}
    	return view('/cart');
    }
    public function addtocart($id){
    	$Barang = Barang::find($id);
    	if (!$Barang) {
    		abort(404);
    	}
    	$cart = session()->get('cart');
    	//jka cart kosong dan diisi oleh produk pertama
    	if (!$cart) {
    		$cart = [
    			$id => [
    				"nama" => $Barang->namabarang,
    				"qty" => 1,
    				"size" => $Barang->size,
    				"image" => $Barang->image,
    				"harga" => $Barang->harga,
    				"id_supplier" => $Barang->id_supplier
    			]
    		];
    		session()->put('cart',$cart);
    		return redirect()->back()->with('success','Produk telah ditambahkan!');
    	}
    	//jika cart tidak kosong dan produk sudah ditambah maka auto increment qty
    	if (isset($cart[$id])) {
    		$cart[$id]['qty']++;
    		session()->put('cart',$cart);
    		return redirect()->back()->with('success','Produk telah ditambahkan!');
    	}
    	//jika item tidak ada di cart maka menambah ke cart dengan qty = 1
    	$cart[$id] = [
    		"nama" => $Barang->namabarang,
    		"size" => $Barang->size,
    		"qty" => 1,
    		"image" => $Barang->image,
    		"harga" => $Barang->harga,
    		"id_supplier" => $Barang->id_supplier
    	];
    	session()->put('cart',$cart);
    	return redirect()->back()->with('succes','Produk telah ditambahkan!');
    }
    public function apus(){
    	session()->forget('cart');
    	return redirect('/');
    }



}
