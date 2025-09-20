<div>
   <button type="button" 
           class="btn {{ $id ? 'btn-warning':'btn-primary' }}" 
           data-toggle="modal" 
           data-target="#formProduct{{ $id ?? '' }}">
          @if ($id)
            <i class="fas fa-edit"></i>
          @else
            Produk baru
          @endif
   </button>

   <div class="modal fade" id="formProduct{{ $id ?? '' }}">
       <form action="{{ route('master-data.product.store') }}" method="POST">
           @csrf
           <input type="hidden" name="id" value="{{ $id ?? '' }}">
           
           <div class="modal-dialog">
             <div class="modal-content">
               <div class="modal-header">
                 <h4 class="modal-title">{{ $id ? 'Form Edit Product' : 'Form Product Baru' }}</h4>
                 <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                   <span aria-hidden="true">&times;</span>
                 </button>
               </div>

               <div class="modal-body">
                   {{-- Nama --}}
                   <div class="form-group my-1">
                      <label for="nama_produk">Nama Product</label> 
                      <input type="text" name="nama_produk" id="nama_produk" 
                             class="form-control" 
                             value="{{ $id ? $nama_produk : old('nama_produk') }}">
                   </div>

                   {{-- Kategori --}}
                   <div class="form-group my-1">
                       <label for="kategori_id">Kategori Product</label>
                       <select name="kategori_id" id="kategori_id" class="form-control">
                           <option value="">Pilih Kategori</option>
                           @foreach ($kategori as $item)
                               <option value="{{ $item->id }}" 
                                   {{ ($kategori_id ?? old('kategori_id')) == $item->id ? 'selected' : '' }}>
                                   {{ $item->nama_kategori }}
                               </option>
                           @endforeach
                       </select>
                   </div>

                   {{-- Harga Jual --}}
                   <div class="form-group my-1">
                       <label for="harga_jual">Harga Jual</label>
                       <input type="number" name="harga_jual" id="harga_jual" class="form-control" 
                              value="{{ $id ? $harga_jual : old('harga_jual') }}">
                   </div>

                   {{-- Harga Pokok --}}
                   <div class="form-group my-1">
                       <label for="harga_beli_pokok">Harga Beli Pokok</label>
                       <input type="number" name="harga_beli_pokok" id="harga_beli_pokok" class="form-control" 
                              value="{{ $id ? $harga_beli_pokok : old('harga_beli_pokok') }}">
                   </div>

                   {{-- Stok --}}
                   <div class="form-group my-1">
                       <label for="stok">Stok Tersedia</label>
                       <input type="number" name="stok" id="stok" class="form-control" 
                              value="{{ $id ? $stok : old('stok') }}">
                   </div>

                   {{-- Stok Minimal --}}
                   <div class="form-group my-1">
                       <label for="stok_minimal">Stok Minimal</label>
                       <input type="number" name="stok_minimal" id="stok_minimal" class="form-control" 
                              value="{{ $id ? $stok_minimal : old('stok_minimal') }}">
                   </div>

                   {{-- Status Aktif --}}
                   <div class="form-group my-1 d-flex flex-column">
                       <div class="d-flex align-items-center">
                           <label for="is_active" class="mr-4" >Produk Aktif?</label>
                           <input type="checkbox" name="is_active" id="is_active"
                           {{old('is_active', $id ? $is_active :false) ? 'checked' : ''}}>
                       </div>
                       <small class="text-secondary -mt-2">Jika aktif maka produk akan tampil di halaman kasir</small>
                   </div>
               </div>

               <div class="modal-footer justify-content-between">
                 <button type="button" class="btn btn-default" data-dismiss="modal">Batal</button>
                 <button type="submit" class="btn btn-primary">Simpan</button>
               </div>
             </div>
           </div>
       </form>
     </div>
</div>
