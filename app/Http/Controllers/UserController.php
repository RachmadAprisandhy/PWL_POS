<?php

namespace App\Http\Controllers;

use App\Models\UserModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\LevelModel;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
   public function index()
{
    $breadcrumbs = (object) [
        'title' => 'Data User',
        'list' => ['Home', 'User']
    ];

    $page = (object) [
        'title' => 'Daftar user yang terdaftar dalam sistem',
    ];
    
    $activeMenu = 'User';

    $level = LevelModel::all(); 

    return view('user.index', [
        'breadcrumbs' => $breadcrumbs,
        'page' => $page,
        'activeMenu' => $activeMenu,
        'level' => $level 
    ]);
}
    public function tambah()
    {
        return view('user_tambah');
    }
    public function tambah_simpan(Request $request)
    {
        UserModel::create([
            'username' => $request->username,
            'nama' => $request->nama,
            'password' => Hash::make($request->password),
            'level_id' => $request->level_id,
        ]);
        return redirect('/user');
    }
       public function ubah($id)
      {
         $user = UserModel::find($id);
         return view('user_ubah',['data'=>$user]);
      }
      public function ubah_simpan($id, Request $request)
      {
         $user = UserModel::find($id);

         $user->username = $request->username;
         $user->nama = $request->nama;
         $user->password = Hash::make($request->password);
         $user->level_id = $request->level_id;

         $user->save();
         return redirect('/user');
      }
      public function hapus($id)
      {
         $user = UserModel::find($id);
         $user->delete();
         return redirect('/user');
      }
      public function list(Request $request)
      {
         $user = UserModel::select('user_id', 'username', 'nama', 'level_id')->with('level');
            if ($request->level_id) {
                $user->where('level_id', $request->level_id);
            }
            return DataTables::of($user)
        // menambahkan kolom index / no urut (default nama kolom: DT_RowIndex)
        ->addIndexColumn()
        ->addColumn('aksi', function ($user) {
            $btn = '<a href="'.url('/user/' . $user->user_id).'" class="btn btn-info btn-sm">Detail</a> ';
            $btn .= '<a href="'.url('/user/' . $user->user_id . '/edit').'" class="btn btn-warning btn-sm">Edit</a> ';
            $btn .= '<form class="d-inline-block" method="POST" action="'.url('/user/'.$user->user_id).'">'
                    . csrf_field() . method_field('DELETE') .
                    '<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm(\'Apakah Anda yakin menghapus data ini?\');">Hapus</button></form>';
            return $btn;
        })
        ->rawColumns(['aksi'])
        ->make(true);
      }
      public function create()
     {
        $breadcrumbs = (object) [
            'title' => 'Tambah User',
            'list' => ['Home', 'User', 'Tambah']
        ];
        $page = (object) [
            'title' => 'Tambah User Baru'
        ];
        $level = LevelModel::all();
        $activeMenu = 'User';
        return view('user.create', [
            'breadcrumbs' => $breadcrumbs,
            'page' => $page,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
     }
     public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username',
            'nama'     => 'required|string|max:100', 
            'password' => 'required|min:5',         
            'level_id' => 'required|integer'        
        ]);

        UserModel::create([
            'username' => $request->username,
            'nama'     => $request->nama,
            'password' => bcrypt($request->password), 
            'level_id' => $request->level_id
        ]);

        return redirect('/user')->with('success', 'Data user berhasil disimpan');
    }
    public function show($id)
    {
    $user = UserModel::with('level')->find($id);

    if (!$user) {
        return redirect('/user')->with('error', 'Data user tidak ditemukan');
    }

    $breadcrumbs = (object) [
        'title' => 'Detail User',
        'list' => ['Home', 'User', 'Detail']
    ];

    $page = (object) [
        'title' => 'Detail User: ' . $user->nama 
    ];

    $activeMenu = 'User';

    return view('user.show', [
        'breadcrumbs' => $breadcrumbs,
        'page' => $page,
        'user' => $user,
        'activeMenu' => $activeMenu
    ]);
    }

    public function edit(String $id)
    {
        $user = UserModel::find($id);
        $level = LevelModel::all();

        $breadcrumbs = (object) [
            'title' => 'Edit User',
            'list' => ['Home', 'User', 'Edit']
        ];
        $page = (object) [
            'title' => 'Edit User: ' . $user->nama
        ];
        $activeMenu = 'User';

        return view('user.edit', [
            'breadcrumbs' => $breadcrumbs,
            'page' => $page,
            'user' => $user,
            'level' => $level,
            'activeMenu' => $activeMenu
        ]);
    }

    public function update(String $id, Request $request)
    {
        $request->validate([
            'username' => 'required|string|min:3|unique:m_user,username,' . $id . ',user_id',
            'nama'     => 'required|string|max:100', 
            'password' => 'nullable|min:5',         
            'level_id' => 'required|integer'        
        ]);

        UserModel::find($id)->update([
            'username' => $request->username,
            'nama'     => $request->nama,
            'password' => $request->password ? bcrypt($request->password) : UserModel::find($id)->password, 
            'level_id' => $request->level_id
        ]);
        return redirect('/user')->with('success', 'Data user berhasil diperbarui');
    }
    public function destroy(String $id)
    {
        $check = UserModel::find($id);
        if (!$check) {
            return redirect('/user')->with('error', 'Data user tidak ditemukan');
    }
        try{
            UserModel::destroy($id);
            return redirect('/user')->with('success', 'Data user berhasil dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect('/user')->with('error', 'Gagal menghapus data user: ' . $e->getMessage());
        }
    }
}