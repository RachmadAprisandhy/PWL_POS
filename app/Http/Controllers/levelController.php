<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class levelController extends Controller
{
    public function index()
    {
       // DB::table('m_level')->insert([
        //    'level_kode' => 'CUS',
        //    'level_nama' => 'Customer',
       //     'created_at' => now(),
       //     'updated_at' => now()
       // ]);
        //$row = DB::update('update m_level set level_nama = ? where level_kode = ?', ['pelanggan', 'CUS']);
        //return 'update data berhasil jumlah data yang diupdate: ' . $row;

        //$row = DB::delete('delete from m_level where level_kode = ?', ['CUS']);
        //return 'delete data berhasil jumlah data yang dihapus: ' . $row. 'baris';

        $data = DB::select('select * from m_level');
        return view('level', ['data' => $data]);
    }
}