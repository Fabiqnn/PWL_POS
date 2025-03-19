<?php

namespace App\Http\Controllers;

use App\Models\SupplierModel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SupplierController extends Controller
{
    public function index() {

        $breadcrumb = (object) [
            'title' => 'Data Supplier',
            'list' => ['Home', 'supplier']
        ];

        $page = (object) [
            'title' => 'Daftar supplier user yang terdatar dalam sistem'
        ];

        $activeMenu = 'supplier';

        return view('supplier.index', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function list() {
        $levels = SupplierModel::all();

        return DataTables::of($levels)
            ->addIndexColumn()
            ->addColumn('aksi', function ($supplier) {
                $btn = '<a href="' . url('/supplier/' . $supplier->supplier_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                $btn .= '<a href="' . url('/supplier/' . $supplier->supplier_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                $btn .= '<form class="d-inline-block" method="POST" action="' .
                    url('/supplier/' . $supplier->supplier_id) . '">'
                    . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button>' ;
                return $btn;
            })
            ->rawColumns(['aksi'])
            ->make(true);
    }

    public function show(string $id) {
        $user = SupplierModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Detail Supplier',
            'list' => ['Home', 'supplier', 'Detail']
        ];

        $page = (object) [
            'title' => 'Detail supplier'
        ];

        $activeMenu = 'supplier';

        return view('supplier.show', ['breadcrumb' => $breadcrumb, 'page' => $page, 'supplier' => $user, 'activeMenu' => $activeMenu]);
    }

    public function edit(string $id) {
        $user = SupplierModel::find($id);

        $breadcrumb = (object) [
            'title' => 'Edit Supplier',
            'list' => ['Home', 'supplier', 'Edit']
        ];

        $page = (object) [
            'title' => 'Edit supplier'
        ];

        $activeMenu = 'supplier';
        return view('supplier.edit', ['breadcrumb' => $breadcrumb, 'page' => $page, 'user' => $user,'activeMenu' => $activeMenu]);
    }

    public function update(Request $request, string $id) {
        $request->validate([
            'kode_supplier' => 'required|String|max:10|unique:m_supplier,kode_supplier,'.$id.',supplier_id',
            'nama_supplier' => 'required|String|max:100'
        ]);

        SupplierModel::find($id)->update([
            'kode_supplier' => $request->kode_supplier,
            'nama_supplier' => $request->nama_supplier
        ]);

        return redirect('/supplier')->with('success', 'Data supplier berhasil diubah');
    }

    public function create() {

        $breadcrumb = (object) [
            'title' => 'Tambah Supplier',
            'list' => ['Home', 'supplier', 'tambah']
        ];

        $page = (object) [
            'title' => 'Tambah supplier'
        ];

        $activeMenu = 'supplier';
        return view('supplier.create', ['breadcrumb' => $breadcrumb, 'page' => $page, 'activeMenu' => $activeMenu]);
    }

    public function store(Request $request) {
        $request->validate([
            'kode_supplier' => 'required|String|max:10|unique:m_supplier,kode_supplier',
            'nama_supplier' => 'required|String|max:100'
        ]);

        SupplierModel::create([
            'kode_supplier' => $request->kode_supplier,
            'nama_supplier' => $request->nama_supplier
        ]);

        return redirect('/supplier')->with('success', 'Data supplier berhasil ditambah');
    }

    public function destroy(string $id) {
        $check = SupplierModel::find($id);
        if (!$check) {
            return redirect('/supplier')->with('error', 'Data supplier tidak ditemukan');
        }

        try {
            SupplierModel::destroy($id);
            return redirect('/supplier')->with('success', 'Data supplier berhasil dihapus');
        }catch (\Illuminate\Database\QueryException $e) {
            return redirect('/supplier')->with('error', 'Data supplier gagal dihapus karena masih terdapat tabel lain yang terkait dengan data ini');
        }
        
    }
}
