<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StokSeeder extends Seeder
{
    public function run(): void
    {
        $barangs = DB::table('m_barang')->pluck('barang_id');

        foreach ($barangs as $barangId) {

            DB::table('t_stok')->insert([
                'barang_id'    => $barangId,
                'user_id'      => 1,
                'stok_tanggal' => now(),
                'stok_jumlah'  => rand(10, 50),
                'created_at'   => now(),
                'updated_at'   => now(),
            ]);
        }
    }
}