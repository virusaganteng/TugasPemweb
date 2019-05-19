<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Barang;
use DB;
use Auth;
use App\User;

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
      if (Auth::User() == null) {
       return redirect('/login');
      }
      else {
      $cust = Auth::User()->id_customer;
    	$Barang = Barang::find($id);
    	if (!$Barang) {
    		abort(404);
    	}
    	$cart = session()->get('cart');
    	//jka cart kosong dan diisi oleh produk pertama
    	if (!$cart) {
    		$cart = [
    			$id => [
            "id_customer" => $cust,
            "id_barang" => $Barang->id_barang,
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
        "id_customer" => $cust,
        "id_barang" => $Barang->id_barang,
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
    }
    public function apus(){
    	session()->forget('cart');
    	return redirect('/');
    }

    public function checkout(){
      // if (session('cart')==null) {
      //   abort('404');
      // }
      if (session('cart')==null) {
        abort(404);
      }
      else {
      return view('/checkout');
      }
    }
    public function addcheckout(Request $Request){
      $lamasewa = $Request->lamasewa;
      return view('checkout', ['lamasewa' => $lamasewa]);
    }
    public function checkoutproses(Request $Request){
      $id_customer = $Request->id_customer;
      $id_barang = $Request->id_barang;
      $alamat = $Request->alamat;
      $payment = $Request->payment;
      $zipcode = $Request->zipcode;
      $notelp = $Request->notelp;
      $tanggalsewa = $Request->tanggalsewa;
      $tanggalkembali = $Request->tanggalkembali;
      $jumlahbayar = $Request->jumlahbayar;

      $input = DB::table('order')->insert([
        'id_customer' => $id_customer,
        'id_payment' => $payment,
        'alamat' => $alamat,
        'id_payment' => $payment,
        'zipcode' => $zipcode,
        'notelp' => $notelp,
        'tanggalsewa' => date('Y-m-d',strtotime($tanggalsewa)),
        'tanggalkembali' => date('Y-m-d',strtotime($tanggalkembali)),
        'jumlahbayar' => $jumlahbayar
      ]);

      // foreach (session('cart') as $id => $value) {
        
      
      //   for ($i=0; $i <= count($value['id_barang']) ; $i++) { 
      //   $input = DB::table('orderdetail')->insert([
      //   'id_barang' => $id_barang
      //   ]);
      //   }
      // }

      if (!$input) {
        echo dd($input);
      }
      else {
        
        session()->forget('cart');
        return redirect('/home');
        
      }

    }



}
