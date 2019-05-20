<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Barang;
use Illuminate\Support\Facades\DB;
use Auth;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function add(){
        $join = DB::table('category')
                // ->join('category', 'barang.id_category', '=', 'category.id_category')
                ->select('category.*', 'category.namacategory')
                ->get();                        
        return view('add', ['join' => $join]);
    }
    public function addpost(Request $Request){
        $validation = $Request->validate([
            'namabarang' => 'required',
            'id_category' => 'required',
            'image' => 'required',
            'deskripsi' => 'required',
            'harga' => 'required',
            'size' => 'required',
            'stock' => 'required'
        ]);

        $id_customer = $Request->id_customer;
        $namabarang = $Request->namabarang;
        $id_category = $Request->id_category;
        $image = $Request->file('image');
        $deskripsi = $Request->deskripsi;
        $harga = $Request->harga;
        $size = $Request->size;
        $stock = $Request->stock;
        $name = 'haxor-' . time() . '.' . $image->getClientOriginalExtension();
        $path = $image->storeAs('/public/product/', $name);

        $input = Barang::create([
            'namabarang' => $namabarang,
            'id_category' => $id_category,
            'image' =>  $name,
            'deskripsi' => $deskripsi,
            'harga' => $harga,
            'size' => $size,
            'jumlah' => $stock,
            'id_customer' => $id_customer
        ]);
        if (!$input) {
            echo "gagal!";
        }
        else return redirect()->back()->with('success','Barang ditambahkan!');
        
    }
    public function orderdetail(){
        $table = DB::table('order')
        ->select('*')
        ->leftJoin('payment', 'order.id_payment', '=', 'payment.id_payment')
        ->where('id_customer', Auth::User()->id_customer)
        ->get();
        return view('orderdetail', ['table' => $table]);
    }
    public function kelola(){
        $table = DB::table('barang')
            ->select('*')
            ->where('id_customer', Auth::User()->id_customer)
            ->get();
        return view('kelola', ['table' => $table]);
    }
    public function delete($id){
        Barang::where('id_barang',$id)->delete();
        return redirect('kelola');
    }
}
