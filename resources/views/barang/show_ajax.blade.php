@empty($user)
    <div id="modal-master" class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Kesalahan</h5>
                <button type="button" class="close" data-dismiss="modal" arialabel="Close"><span
                        aria-hidden="true">&times;</span></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger">
                    <h5><i class="icon fas fa-ban"></i> Kesalahan!!!</h5>
                    Data yang anda cari tidak ditemukan
                </div>
                <a href="{{ url('/barang') }}" class="btn btn-warning">Kembali</a>
            </div>
        </div>
    </div>
@else
<div id="modal-master" class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Detail Barang</h5>
            <button type="button" class="close" data-dismiss="modal" arialabel="Close"><span
                    aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
            <table class="table table-bordered table-striped table-hover tabel-sm">
                <tr>
                    <th>ID</th>
                    <th> {{$user->user_id}} </th>
                </tr>
                <tr>
                    <th>kategori</th>
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
        </div>
        <div class="modal-footer">
            <button type="button" data-dismiss="modal" class="btn btn-warning">Kembali</button>
        </div>
    </div>
</div>
@endempty