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
                        <th> {{$user->user_id}} </th>
                    </tr>
                    <tr>
                        <th>Level</th>
                        <th> {{$user->level->level_nama}} </th>
                    </tr>
                    <tr>
                        <th>Username</th>
                        <th> {{$user->username}} </th>
                    </tr>
                    <tr>
                        <th>Nama</th>
                        <th> {{$user->nama}} </th>
                    </tr>
                    <tr>
                        <th>Password</th>
                        <th>***********</th>
                    </tr>
                </table>
            @endempty
            <a href="{{url('user')}}" class="btn btn-sm btn-default mt-2">Kembali</a>
        </div>
    </div>
@endsection

@push('css')
@endpush
@push('js')
@endpush