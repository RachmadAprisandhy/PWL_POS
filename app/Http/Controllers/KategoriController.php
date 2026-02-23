<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KategoriController extends Controller
{
    public function index()
    {
      //  $data = [
        //    'kode_kategori' => 'JJN',
          //  'nama_kategori' => 'Jajanan',
            //'created_at' => now()
        //];
        
        //DB::table('m_kategori')->insert($data);
        //return 'Insert data baru berhasil';
        //$row = DB::table('m_kategori')->where('kode_kategori', 'JJN')->update(['nama_kategori' => 'snack']);
        //return 'Update data berhasil, jumlah baris yang diupdate: ' . $row;

        $row = DB::table('m_kategori')->where('kode_kategori', 'JJN')->delete();
        return 'Delete data berhasil. Jumlah data yang dihapus: ' . $row . ' baris';
        //$data = DB::table('m_kategori')->get();
        //return view('kategori', ['data' => $data]);
    }
}