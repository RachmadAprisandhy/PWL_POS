<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB; // ← WAJIB DITAMBAHKAN

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        $data = [
            ['id' => 1, 'kode_kategori' => 'MKN', 'nama_kategori' => 'Makanan'],
            ['id' => 2, 'kode_kategori' => 'MN',  'nama_kategori' => 'Minuman'],
            ['id' => 3, 'kode_kategori' => 'KSM', 'nama_kategori' => 'Kosmetik'],
            ['id' => 4, 'kode_kategori' => 'PRT', 'nama_kategori' => 'Peralatan Rumah'],
        ];

        DB::table('m_kategori')->insert($data);
    }
}
