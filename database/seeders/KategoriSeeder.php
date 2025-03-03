<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

use function Laravel\Prompts\table;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            ['kategori_id' => 1, 'kategori_kode' => 'ELC', 'kategori_nama' => 'Elektronik'],
            ['kategori_id' => 2, 'kategori_kode' => 'FRN', 'kategori_nama' => 'Furniture'],
            ['kategori_id' => 3, 'kategori_kode' => 'FAS', 'kategori_nama' => 'Fashion'],
            ['kategori_id' => 4, 'kategori_kode' => 'MKN', 'kategori_nama' => 'Makanan'],
            ['kategori_id' => 5, 'kategori_kode' => 'OBT', 'kategori_nama' => 'Obat-obatan'],
        ];
        DB::table('m_kategori')->insert($data);
    }
}
