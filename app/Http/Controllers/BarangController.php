<?php

namespace App\Http\Controllers;

use App\Models\BarangModel;
use App\Models\KategoriModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class BarangController extends Controller
{
    public function index() {
        $breadcrumb = (object) [
            'title' => 'Daftar barang',
            'list' => ['Home', 'barang']
        ];

        $page = (object) [
            'title' => 'Daftar barang yang terdaftar dalam sistem'
        ];

        $activeMenu = 'barang';

        $kategori = KategoriModel::all();

        return view('barang.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'kategori'=>$kategori ,'activeMenu' => $activeMenu]);
    }

    public function list()
    {
        $barang = BarangModel::with('kategori') // Ambil data kategori
            ->select('barang_id', 'kategori_id', 'barang_kode', 'barang_nama', 'harga_beli', 'harga_jual');

        return DataTables::of($barang)
            ->addIndexColumn()
            ->addColumn('kategori_nama', function ($barang) {
                return $barang->kategori ? $barang->kategori->kategori_nama : '-';
            })
            ->addColumn('aksi', function ($barang) {
                $btn = '<a href="' . url('/barang/' . $barang->barang_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/barang/' . $barang->barang_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' . url('/barang/' . $barang->barang_id) . '">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function create() {
        $breadcrumb = (object) [
            'title' => 'Tambah barang',
            'list' => ['Home', 'barang', 'tambah']
        ];

        $page = (object) [
            'title' => 'Tambah barang ke dalam sistem'
        ];

        $kategori = KategoriModel::all();

        $activeMenu = 'barang';
        return view('barang.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu, 'kategori' => $kategori]);
    }

    public function store(Request $request) {
        $request->validate([
            'barang_kode' => 'required|String|min:3|unique:m_barang,barang_kode',
            'barang_nama' => 'required|string|max:100',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
            'kategori_id' => 'required|integer'
        ]);

        BarangModel::create([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' =>$request->harga_beli,
            'harga_jual' =>$request->harga_jual,
            'kategori_id' =>$request->kategori_id
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil disimpan');
    }

    public function show(string $id) {
        $user = BarangModel::with('kategori')->find($id);

        $breadcrumb = (object) [
            'title' => 'Detail barang',
            'list' => ['Home', 'barang', 'detail']
        ];

        $page = (object) [
            'title' => 'Detail barang yang terdaftar dalam sistem'
        ];

        $activeMenu = 'barang';

        $kategori = KategoriModel::all();

        return view('barang.show', ['user' => $user, 'breadcrumb' => $breadcrumb, 'page' => $page, 'kategori'=>$kategori ,'activeMenu' => $activeMenu]);
    }

    public function edit(string $id) {
        $user = BarangModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit barang',
            'list' => ['Home', 'barang', 'edit']
        ];

        $page = (object) [
            'title' => 'Edit barang yang terdaftar dalam sistem'
        ];

        $activeMenu = 'barang';

        $kategori = KategoriModel::all();

        return view('barang.edit', ['user' => $user, 'breadcrumb' => $breadcrumb, 'page' => $page, 'kategori'=>$kategori ,'activeMenu' => $activeMenu]); 
    }

    public function update(Request $request, string $id) {
        $request->validate([
            'barang_kode' => 'required|String|min:3|unique:m_barang,barang_kode,'.$id.',barang_id',
            'barang_nama' => 'required|string|max:100',
            'harga_beli' => 'required|integer',
            'harga_jual' => 'required|integer',
            'kategori_id' => 'required|integer'
        ]);

        BarangModel::find($id)->update([
            'barang_kode' => $request->barang_kode,
            'barang_nama' => $request->barang_nama,
            'harga_beli' =>$request->harga_beli,
            'harga_jual' =>$request->harga_jual,
            'kategori_id' =>$request->kategori_id
        ]);

        return redirect('/barang')->with('success', 'Data barang berhasil disimpan');
    }

    public function destroy(string $id) {
        $check = BarangModel::find($id);
        if (!$check) {
            return redirect('/barang')->with('error', 'Data barang tidak ditemukan');
        }

        try {
            BarangModel::destroy($id);
            return redirect('/barang')->with('success', 'Data barang berhasil dihapus');
        }catch (\Illuminate\Database\QueryException $e) {
            return redirect('/barang')->with('error', 'Data barang gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
    }
}