@extends('layouts.app')
@section('content_title','Dashboard')
@section('content')
<div class="row">
    @forelse($products as $product)
        <div class="col-md-3 mb-4">
            <div class="card h-100 border-0 shadow-sm rounded product-card">
                
                {{-- Gambar Produk --}}
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" 
                         class="card-img-top rounded-top" 
                         alt="{{ $product->title }}" 
                         style="height: 180px; object-fit: cover;">
                @else
                    <div class="d-flex align-items-center justify-content-center bg-light" 
                         style="height: 180px;">
                        <span class="text-muted">No Image</span>
                    </div>
                @endif

                {{-- Isi Card --}}
                <div class="card-body d-flex flex-column">
                    <h6 class="card-title mb-1">{{ $product->title }}</h6>
                    
                    <p class="fw-bold text-primary mb-1">
                        Rp {{ number_format($product->price,0,',','.') }}
                    </p>
                    
                    <p class="text-muted mb-1">Stok: {{ $product->stock }}</p>
                    
                    <p class="small text-muted flex-grow-1">
                        {{ \Illuminate\Support\Str::limit($product->description, 60, '...') }}
                    </p>

                    <a href="{{ route('master-data.product.show', $product->id) }}" 
                       class="btn btn-dark btn-sm mt-auto w-100">
                       SHOW
                    </a>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info text-center">
                Belum ada produk
            </div>
        </div>
    @endforelse
</div>
@endsection
