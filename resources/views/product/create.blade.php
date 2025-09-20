@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card border-0 shadow-sm rounded">
        <div class="card-body">
            <form action="{{ route('master-data.product.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group mb-3">
                    <label>IMAGE</label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" name="image">
                    @error('image') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="form-group mb-3">
                    <label>TITLE</label>
                    <input type="text" class="form-control @error('title') is-invalid @enderror" 
                           name="title" value="{{ old('title') }}">
                    @error('title') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="form-group mb-3">
                    <label>DESCRIPTION</label>
                    <textarea class="form-control @error('description') is-invalid @enderror" 
                              name="description" rows="5">{{ old('description') }}</textarea>
                    @error('description') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="form-group mb-3">
                    <label>PRICE</label>
                    <input type="number" class="form-control @error('price') is-invalid @enderror" 
                           name="price" value="{{ old('price') }}">
                    @error('price') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <div class="form-group mb-3">
                    <label>STOCK</label>
                    <input type="number" class="form-control @error('stock') is-invalid @enderror" 
                           name="stock" value="{{ old('stock') }}">
                    @error('stock') <div class="text-danger">{{ $message }}</div> @enderror
                </div>

                <button type="submit" class="btn btn-md btn-primary">SAVE</button>
                <a href="{{ route('master-data.product.index') }}" class="btn btn-md btn-secondary">KEMBALI</a>
            </form>
        </div>
    </div>
</div>
@endsection
