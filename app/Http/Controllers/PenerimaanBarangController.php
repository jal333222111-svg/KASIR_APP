<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PenerimaanBarangController extends Controller
{
    public function index()
    {
        // Tidak perlu $products, karena select2 pakai ajax
        return view('penerimaan-barang.index');
    }
}
