<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::latest()->paginate(10);
        return view('product.index', compact('products'));
    }

    public function create()
    {
        return view('product.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'image'       => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|numeric|min:0',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // simpan ke storage/app/public/products
            $imagePath = $request->file('image')->store('products', 'public');
        }

        Product::create([
            'image'       => $imagePath, // simpan path lengkap di DB
            'title'       => $request->title,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
        ]);

        return redirect()->route('master-data.product.index')
                         ->with('success', 'Produk berhasil ditambahkan');
    }

    public function show(Product $product)
    {
        return view('product.show', compact('product'));
    }

    public function edit(Product $product)
    {
        return view('product.edit', compact('product'));
    }

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'image'       => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'price'       => 'required|numeric|min:0',
            'stock'       => 'required|numeric|min:0',
        ]);

        $imagePath = $product->image;

        if ($request->hasFile('image')) {
            // hapus file lama kalau ada
            if ($product->image && Storage::disk('public')->exists($product->image)) {
                Storage::disk('public')->delete($product->image);
            }

            // upload baru
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'image'       => $imagePath,
            'title'       => $request->title,
            'description' => $request->description,
            'price'       => $request->price,
            'stock'       => $request->stock,
        ]);

        return redirect()->route('master-data.product.index')
                         ->with('success', 'Produk berhasil diperbarui');
    }

    public function destroy(Product $product)
    {
        // hapus file gambar kalau ada
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        $product->delete();

        return redirect()->route('master-data.product.index')
                         ->with('success', 'Produk berhasil dihapus');
    }
        
    public function getDataProduk(Request $request)
    {
        $search = $request->get('search');

        $query = \App\Models\Product::query();

        if (!empty($search)) {
            $query->where('title', 'like', "%{$search}%");
        }

        $products = $query->limit(10)->get(); // limit supaya ringan

        return response()->json($products);
    }

    public function cekStok(Request $request)
    {
        $id = $request->get('id');
        $product = \App\Models\Product::find($id);

        if (!$product) {
            return response()->json(['stock' => 0]);
        }

        return response()->json([
            'stock' => $product->stock
        ]);
    }

}

