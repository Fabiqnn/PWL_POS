@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title">{{ $page->title }}</h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($user)
                <div class="alert alert-danger alert-dismissible">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Data yang Anda cari tidak ditemukan.
                </div>
                <a href="{{ url('supplier') }}" class="btn btn-sm btn-default mt-2">Kembali</a>
            @else
                <form method="POST" action="{{ url('/supplier/' . $user->supplier_id) }}" class="formhorizontal">
                    @csrf
                    {!! method_field('PUT') !!}
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label" style="font-size: 13px">Supplier Kode</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="kode_supplier" name="kode_supplier"
                                value="{{ old('kode_supplier', $user->kode_supplier) }}" required>
                            @error('kode_supplier')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label" style="font-size: 13px">Supplier Nama</label>
                        <div class="col-11">
                            <input type="text" class="form-control" id="nama_supplier" name="nama_supplier"
                                value="{{ old('nama_supplier', $user->nama_supplier) }}" required>
                            @error('nama_supplier')
                                <small class="form-text text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-1 control-label col-form-label"></label>
                        <div class="col-11">
                            <button type="submit" class="btn btn-primary btn-sm">Simpan</button>
                            <a class="btn btn-sm btn-default ml-1" href="{{ url('supplier') }}">Kembali</a>
                        </div>
                    </div>
                </form>
            @endempty
        </div>
    </div>
@endsection

@push('css')
@endpush
@push('js')
@endpush