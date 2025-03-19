@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"> {{$page->title}} </h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($supplier)
                <div class="alert alert-danger alert-dismissable">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Daya yang Anda cari tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover tabel-sm">
                    <tr>
                        <th>ID</th>
                        <th> {{$supplier->supplier_id}} </th>
                    </tr>
                    <tr>
                        <th>Kode Supplier</th>
                        <th> {{$supplier->kode_supplier}} </th>
                    </tr>
                    <tr>
                        <th>Nama Supplier</th>
                        <th> {{$supplier->nama_supplier}} </th>
                    </tr>
                </table>
            @endempty
            <a href="{{url('supplier')}}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection

@push('css')
@endpush
@push('js')
@endpush