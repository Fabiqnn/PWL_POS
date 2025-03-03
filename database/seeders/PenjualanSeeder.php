<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $sales = [
            ['penjualan_id' => 1, 'user_id' => 1, 'pembeli' => 'Budi', 'penjualan_kode' => 'SALE001', 'penjualan_tanggal' => '2025-03-01'],
            ['penjualan_id' => 2, 'user_id' => 2, 'pembeli' => 'Ani', 'penjualan_kode' => 'SALE002', 'penjualan_tanggal' => '2025-03-02'],
            ['penjualan_id' => 3, 'user_id' => 3, 'pembeli' => 'Dewi', 'penjualan_kode' => 'SALE003', 'penjualan_tanggal' => '2025-03-03'],
            ['penjualan_id' => 4, 'user_id' => 1, 'pembeli' => 'Rizal', 'penjualan_kode' => 'SALE004', 'penjualan_tanggal' => '2025-03-04'],
            ['penjualan_id' => 5, 'user_id' => 2, 'pembeli' => 'Sari', 'penjualan_kode' => 'SALE005', 'penjualan_tanggal' => '2025-03-05'],
            ['penjualan_id' => 6, 'user_id' => 3, 'pembeli' => 'Tono', 'penjualan_kode' => 'SALE006', 'penjualan_tanggal' => '2025-03-06'],
            ['penjualan_id' => 7, 'user_id' => 1, 'pembeli' => 'Siti', 'penjualan_kode' => 'SALE007', 'penjualan_tanggal' => '2025-03-07'],
            ['penjualan_id' => 8, 'user_id' => 2, 'pembeli' => 'Joko', 'penjualan_kode' => 'SALE008', 'penjualan_tanggal' => '2025-03-08'],
            ['penjualan_id' => 9, 'user_id' => 3, 'pembeli' => 'Lina', 'penjualan_kode' => 'SALE009', 'penjualan_tanggal' => '2025-03-09'],
            ['penjualan_id' => 10, 'user_id' => 1, 'pembeli' => 'Amin', 'penjualan_kode' => 'SALE010', 'penjualan_tanggal' => '2025-03-10'],
        ];
        DB::table('t_penjualan')->insert($sales);
    }
}
