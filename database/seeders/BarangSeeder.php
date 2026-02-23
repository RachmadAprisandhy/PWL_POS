<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            [
                'kategori_id' => 1,
                'barang_kode' => 'MKN01',
                'barang_nama' => 'Roti',
                'harga_beli' => 5000,
                'harga_jual' => 8000,
                'created_at' => now(),
                'updated_at' => now()
            ],
        ];

        DB::table('m_barang')->insert($data);
    }
}