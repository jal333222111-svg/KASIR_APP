@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card border-0 shadow-sm rounded p-4">
        <div class="row">
            {{-- Gambar Produk --}}
            <div class="col-md-4 mb-3 mb-md-0">
                @if($product->image)
                    <img src="{{ asset('storage/'.$product->image) }}" 
                         class="rounded w-100 shadow-sm" 
                         alt="{{ $product->title }}">
                @else
                    <div class="bg-light p-5 text-center rounded shadow-sm">No Image</div>
                @endif
            </div>

            {{-- Detail Produk --}}
            <div class="col-md-8">
                <h3 class="mb-3">{{ $product->title }}</h3>
                <p><strong>Price:</strong> {{ "Rp " . number_format($product->price, 2, ',', '.') }}</p>
                <p><strong>Stock:</strong> {{ $product->stock }}</p>
                <hr>
                <p class="text-muted">{!! nl2br(e($product->description)) !!}</p>

                <a href="{{ route('master-data.product.index') }}" class="btn btn-md btn-secondary mt-3">
                    BACK
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
