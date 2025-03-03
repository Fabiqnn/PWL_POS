<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items = [
            ['barang_id' => 1, 'kategori_id' => 1, 'barang_kode' => 'ELC001', 'barang_nama' => 'Smartphone', 'harga_beli' => 3000000, 'harga_jual' => 3500000],
            ['barang_id' => 2, 'kategori_id' => 1, 'barang_kode' => 'ELC002', 'barang_nama' => 'Laptop', 'harga_beli' => 7000000, 'harga_jual' => 8500000],
            ['barang_id' => 3, 'kategori_id' => 2, 'barang_kode' => 'FRN001', 'barang_nama' => 'Meja Kerja', 'harga_beli' => 500000, 'harga_jual' => 750000],
            ['barang_id' => 4, 'kategori_id' => 2, 'barang_kode' => 'FRN002', 'barang_nama' => 'Lemari Kayu', 'harga_beli' => 1200000, 'harga_jual' => 1500000],
            ['barang_id' => 5, 'kategori_id' => 3, 'barang_kode' => 'FAS001', 'barang_nama' => 'Jaket Kulit', 'harga_beli' => 450000, 'harga_jual' => 600000],
            ['barang_id' => 6, 'kategori_id' => 3, 'barang_kode' => 'FAS002', 'barang_nama' => 'Sepatu Sneakers', 'harga_beli' => 300000, 'harga_jual' => 450000],
            ['barang_id' => 7, 'kategori_id' => 4, 'barang_kode' => 'MKN001', 'barang_nama' => 'Biskuit', 'harga_beli' => 10000, 'harga_jual' => 15000],
            ['barang_id' => 8, 'kategori_id' => 4, 'barang_kode' => 'MKN002', 'barang_nama' => 'Cokelat Batang', 'harga_beli' => 25000, 'harga_jual' => 35000],
            ['barang_id' => 9, 'kategori_id' => 5, 'barang_kode' => 'OBT001', 'barang_nama' => 'Paracetamol', 'harga_beli' => 5000, 'harga_jual' => 10000],
            ['barang_id' => 10, 'kategori_id' => 5, 'barang_kode' => 'OBT002', 'barang_nama' => 'Vitamin C', 'harga_beli' => 15000, 'harga_jual' => 25000],
        ];
        DB::table('m_barang')->insert($items);
    }
}
