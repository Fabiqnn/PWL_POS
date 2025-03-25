<?php

namespace App\Http\Controllers;

use App\Models\SupplierModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
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
        $users = SupplierModel::all();

        return DataTables::of($users)
            ->addIndexColumn()
            ->addColumn('aksi', function ($user) {
                // $btn = '<a href="' . url('/supplier/' . $supplier->supplier_id) . '" class="btn btn-info btn-sm">Detail</a> ';
                // $btn .= '<a href="' . url('/supplier/' . $supplier->supplier_id . '/edit') . '" class="btn btn-warning btn-sm">Edit</a> ';
                // $btn .= '<form class="d-inline-block" method="POST" action="' .
                //     url('/supplier/' . $supplier->supplier_id) . '">'
                //     . csrf_field() . method_field('DELETE') . '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button>' ;
                $btn = '<button onclick="modalAction(\'' . url('/supplier/' . $user->supplier_id .'/show_ajax') . '\')" class="btn btn-info btn-sm">Detail</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/supplier/' . $user->supplier_id .'/edit_ajax') . '\')" class="btn btn-warning btn-sm">Edit</button> ';
                $btn .= '<button onclick="modalAction(\'' . url('/supplier/' . $user->supplier_id .'/delete_ajax') . '\')" class="btn btn-danger btn-sm">Hapus</button> ';
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

    public function create_ajax() {
        return view('supplier.create_ajax');
    }

    public function store_ajax(Request $request) {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kode_supplier' => 'required|string|max:10|unique:m_supplier,kode_supplier',
                'nama_supplier' => 'required|string|max:100',
            ];
        }

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json([
                'status' => false,
                'message' => 'Validasi Gagal',
                'msgField' => $validator->errors()
            ]);
        }

        SupplierModel::create($request->all());
        return response()->json([
            'status' => true,
            'message' => 'Data user berhasil disimpan'
        ]);

        redirect('/');
    }

    public function show_ajax(string $id) {
        $user = SupplierModel::find($id);

        return view('supplier.show_ajax', ['user' => $user]);
    }

    public function edit_ajax(string $id) {
        $user = SupplierModel::find($id);

        return view('supplier.edit_ajax', ['user' => $user]);
    }

    public function update_ajax(Request $request, string $id) {
        if ($request->ajax() || $request->wantsJson()) {
            $rules = [
                'kode_supplier' => 'required|max:10|unique:m_supplier,kode_supplier,'.$id.',supplier_id',
                'nama_supplier' => 'required|max:100'
            ];
            $validator = Validator::make($request->all(), $rules);

            if ($validator->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Validasi Gagal',
                    'msgField' => $validator->errors()
                ]);
            }

            $check = SupplierModel::find($id);
            if ($check) {
                $check->update($request->all());
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil diupdate'
                ]);
            } else {
                return response()->json([
                    'status' => false, 
                    'message' => 'Data tidak ditemukan'
                ]);
            }
        }
    }

    public function confirm_ajax(string $id) {
        $user = SupplierModel::find($id);

        return view('supplier.confirm_ajax', ['user' => $user]);
    }

    public function delete_ajax(Request $request, string $id) {
        if ($request->ajax() || $request->wantsJson()) {
            $user = SupplierModel::find($id);
            if ($user) {
                $user->delete();
                return response()->json([
                    'status' => true,
                    'message' => 'Data berhasil dihapus'
                ]);
            } else {
                return response()->json([
                    'status' => false,
                    'message' => 'Data tidak ditemukan'
                ]);
            }
            return redirect('/');
        }
    }
}
