@extends('layouts.template')

@section('content')
    <div class="card card-outline card-primary">
        <div class="card-header">
            <h3 class="card-title"> {{$page->title}} </h3>
            <div class="card-tools"></div>
        </div>
        <div class="card-body">
            @empty($level)
                <div class="alert alert-danger alert-dismissable">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!</h5>
                    Daya yang Anda cari tidak ditemukan.
                </div>
            @else
                <table class="table table-bordered table-striped table-hover tabel-sm">
                    <tr>
                        <th>ID</th>
                        <th> {{$level->level_id}} </th>
                    </tr>
                    <tr>
                        <th>Kode</th>
                        <th> {{$level->level_kode}} </th>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <th> {{$level->level_nama}} </th>
                    </tr>
                </table>
            @endempty
            <a href="{{url('level')}}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection

@push('css')
@endpush
@push('js')
@endpush