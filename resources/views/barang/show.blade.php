@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"> {{$page->title}} </h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($user)
                <div class="alert alert-danger alert-dismissable">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Daya yang Anda cari tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover tabel-sm">
                    <tr>
                        <th>ID</th>
                        <th> {{$user->barang_id}} </th>
                    </tr>
                    <tr>
                        <th>Kategori</th>
                        <th> {{$user->kategori->kategori_nama}} </th>
                    </tr>
                    <tr>
                        <th>Kode Barang</th>
                        <th> {{$user->barang_kode}} </th>
                    </tr>
                    <tr>
                        <th>Nama Barang</th>
                        <th> {{$user->barang_nama}} </th>
                    </tr>
                    <tr>
                        <th>Harga Beli</th>
                        <th> {{$user->harga_beli}} </th>
                    </tr>
                    <tr>
                        <th>Harga Jual</th>
                        <th> {{$user->harga_jual}} </th>
                    </tr>
                </table>
            @endempty
            <a href="{{url('barang')}}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection

@push('css')
@endpush
@push('js')
@endpush