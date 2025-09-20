<?php

namespace App\Http\Controllers;

use App\Models\Kategori;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

use function Laravel\Prompts\confirm;

class KategoriController extends Controller
{
   public function index()
   {
    $kategori = Kategori::all();
    confirmDelete('Hapus Data', 'Apakah Anda Yakin inginmenghapus data ini?');
    return view('kategori.index', compact('kategori'));
   }
   
   public function store(Request $request)
   {
      $id = $request->id;
      $request->validate([
         'nama_kategori' => 'required|unique:kategoris,nama_kategori,'.$id,
         'deskripsi'     => 'required|max:100|min:10'
      ],[
         'nama_kategori.required' => 'Nama Kategori Harus Di isi',
         'nama_kategori.unique' => 'nama Kategori Sudah ada',
         'deskripsi.required' => 'Deskripsi Harus di isi',
         'deskripsi.max' => 'Deskripsi maksimal 100 karakter',
         'deskripsi.min' => 'Deskripsi minimal 10 Karakter',
      ]);
      
      Kategori::updateOrCreate(
         ['id' => $id],
         [
            'nama_kategori' => $request->nama_kategori,
            'slug' => Str::slug($request->nama_kategori),
            'deskripsi' => $request->deskripsi,
         ]
         );
         toast()->success('Data Berhasil Di simpan');
         return redirect()->route('master-data.kategori.index');
   }

   public function destroy(String $id)  
   {
      $kategori = Kategori::findOrFail($id);
      $kategori->delete();
      toast()->success('Data Berhasil Dihapus');
      return redirect()->route('master-data.kategori.index');
   }
}
