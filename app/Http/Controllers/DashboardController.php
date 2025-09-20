<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $products = Product::latest()->get(); // ambil semua produk
        return view('dashboard.index', compact('products'));
    }
}


