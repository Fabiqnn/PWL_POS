<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\KategoriModel;
use Illuminate\Http\Request;

class KategoriController extends Controller
{
    public function index() {
        return KategoriModel::all();
    }

    public function store(Request $request) {
        $kategori = KategoriModel::create($request->all());
        return response()->json($kategori, 201);
    }

    public function show(KategoriModel $id) {
        return KategoriModel::find($id);
    }

    public function update(Request $request, KategoriModel $id) {
        $id->update($request->all());
        return KategoriModel::find($id);
    }

    public function destroy(KategoriModel $id) {
        $id->delete();
        return response()->json([
            'success' => true,
            'Data Telah Berhasil Dihapus!'
        ]);
    }
}
