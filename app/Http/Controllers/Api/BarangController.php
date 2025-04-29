<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\BarangModel;
use Illuminate\Http\Request;

class BarangController extends Controller
{
    public function index() {
        return BarangModel::all();
    }

    public function store(Request $request) {
        $barang = BarangModel::create($request->all());
        return response()->json($barang, 201);
    }

    public function show(BarangModel $id) {
        return BarangModel::find($id);
    }

    public function update(Request $request, BarangModel $id) {
        $id->update($request->all());
        return BarangModel::find($id);
    }

    public function destroy(BarangModel $id) {
        $id->delete();
        return response()->json([
            'success' => true,
            'Data Telah Berhasil Dihapus!'
        ]);
    }
}
