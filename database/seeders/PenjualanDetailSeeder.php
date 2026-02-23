<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PenjualanDetailSeeder extends Seeder
{
    public function run(): void
    {
        $penjualans = DB::table('t_penjualan')->pluck('penjualan_id');
        $barangs = DB::table('m_barang')->pluck('barang_id');

        foreach ($penjualans as $penjualanId) {

            for ($i = 1; $i <= 3; $i++) {

                DB::table('t_penjualan_detail')->insert([
                    'penjualan_id' => $penjualanId,
                    'barang_id' => $barangs->random(),
                    'harga' => rand(10000, 50000),
                    'jumlah' => rand(1, 5),
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }
        }
    }
}