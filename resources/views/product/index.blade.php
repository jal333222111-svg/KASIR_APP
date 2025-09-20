@extends('layouts.app')
@section('content_title','Product')
@section('content')
<div class="container mt-5">
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <div class="card border-0 shadow-sm rounded">
        <div class="card-body">
            <a href="{{ route('master-data.product.create') }}" class="btn btn-md btn-primary mb-3">ADD PRODUCT</a>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>IMAGE</th>
                        <th>TITLE</th>
                        <th>PRICE</th>
                        <th>STOCK</th>
                        <th style="width: 20%">ACTIONS</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($products as $product)
                        <tr>
                            <td class="text-center">
                                @if($product->image)
                                    <img src="{{ asset('storage/'.$product->image) }}" 
                                         class="rounded" 
                                         style="width: 120px; height: auto;" 
                                         alt="{{ $product->title }}" />
                                @else
                                    <span class="text-muted">No Image</span>
                                @endif
                            </td>
                            <td>{{ $product->title }}</td>
                            <td>{{ "Rp " . number_format($product->price, 2, ',', '.') }}</td>
                            <td>{{ $product->stock }}</td>
                            <td class="text-center">
                                <form onsubmit="return confirm('Apakah Anda Yakin ?');" 
                                      action="{{ route('master-data.product.destroy', $product->id) }}" 
                                      method="POST">
                                    <a href="{{ route('master-data.product.show', $product->id) }}" 
                                       class="btn btn-sm btn-dark">SHOW</a>
                                    <a href="{{ route('master-data.product.edit', $product->id) }}" 
                                       class="btn btn-sm btn-primary">EDIT</a>
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger">DELETE</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Data produk belum ada</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>

            {{-- Pagination --}}
            <div class="d-flex justify-content-center">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
