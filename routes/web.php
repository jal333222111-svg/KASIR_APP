<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KategoriController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\PenerimaanBarangController;
use App\Http\Controllers\UserController;
use Symfony\Component\CssSelector\Node\FunctionNode;

Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('auth.login');
    });

    Route::post('/login',[LoginController::class,'handleLogin'])->name('login');
});

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::post('/logout',[LoginController::class,'logout'])->name('logout');
    

    Route::prefix('get-data')->as('get-data.')->group(function () {
        Route::get('produk', [ProductController::class, 'getData'])->name('produk');
        Route::get('cek-stok-produk', [ProductController::class, 'cekStok'])->name('cek-stok');
    });

    Route::prefix('users')->as('users.')->controller(UserController::class)->group(function () {
        Route::get('/','index')->name('index');
        Route::post('/','store')->name('store');
        Route::delete('/{id}/destroy','destroy')->name('destroy');
        Route::post('/ganti-password', 'gantiPassword')->name('ganti-password');
        Route::post('/reset-password', 'resetPassword')->name('reset-password');
        
    });


    //mastre-data.kategori.index
    //mastre-data.kategori.index

    Route::prefix('master-data')->as('master-data.')->group(function(){
        Route::resource('product', ProductController::class);
        
        Route::prefix('kategori')->as('kategori.')->controller(KategoriController::class)->group(function(){
            Route::get('/','index')->name('index');
            Route::post('/','store')->name('store');
            Route::delete('/{id}/destroy','destroy')->name('destroy');
        });

    });
            
        Route::get('/penerimaan-barang', [PenerimaanBarangController::class, 'index'])->name('penerimaan-barang.index');

        // endpoint ajax untuk select2
        Route::get('/get-data/produk', [ProductController::class, 'getDataProduk'])->name('get-data.produk');

        // endpoint ajax untuk cek stok produk
        Route::get('/get-data/cek-stok', [ProductController::class, 'cekStok'])->name('get-data.cek-stok');

});
