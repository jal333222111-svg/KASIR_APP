@extends('layouts.app')
@section('content_title','Penerimaan Barang')

@section('content')
<div class="card">
    <div class="card-header">
        <h4 class="card-title">Penerimaan Barang</h4>
    </div>
    <div class="card-body">
        <div class="d-flex align-items-center">
            <select name="select2" id="select2" class="form-control" style="width: 300px"></select>
            <input type="number" name="current_stok" id="current_stok" class="form-control mx-2" style="width: 120px" readonly placeholder="Stok">
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function () {
        let selectedProduk = {}

        // Inisialisasi Select2
        $('#select2').select2({
            theme:'bootstrap',
            placeholder:'Cari Produk.....',
            ajax:{
                url:"{{ route('get-data.produk') }}",
                dataType:'json',
                delay:250,
                data:(params) => {
                    return{
                        search:params.term
                    }
                },
                processResults:(data)=>{
                    data.forEach(item =>{
                        selectedProduk[item.id]=item;
                    })
                    return{
                        results:data.map((item)=>{
                            return{
                                id:item.id,
                                text:item.title // pakai kolom 'title' dari tabel produk
                            }
                        })
                    }
                },
                cache:true
            },
            minimumInputLength:3
        });

        // Ambil stok ketika produk dipilih
        $("#select2").on("change", function () {
            let id = $(this).val();
            $.ajax({
                type: "GET",
                url: "{{ route('get-data.cek-stok') }}",
                data: { id:id },
                dataType: "json",
                success: function (response) {
                    $("#current_stok").val(response.stock);
                }
            });
        });
    });
</script>
@endpush
