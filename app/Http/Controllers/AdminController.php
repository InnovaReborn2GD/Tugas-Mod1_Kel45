<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function create()
    {
        return view('admin.add');
    }

    public function store(Request $request)
    {
        $request->validate(['id_admin' => 'required', 'nama' => 'required', 'alamat' => 'required', 'username' => 'required', 'password' => 'required',]);
        DB::insert(
            'INSERT INTO admin(id_admin,nama, alamat, username, password, deleted_at) VALUES (:id_admin, :nama, :alamat, :username, :password, :deleted_at)',
            [
                'id_admin' => $request->id_admin,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'username' => $request->username,
                'password' => $request->password,
                'deleted_at' => null,
            ]
        );
        return redirect()->route('admin.index')->with('success', 'Data Admin berhasil disimpan');
    }
    
    // public function show all values from a table
    public function index()
    {
        $datas = DB::table('admin')->whereNull('deleted_at')->get();
        return view('admin.index')->with('datas', $datas);
    }

    public function trash()
    {
        $datas = DB::table('admin')->whereNotNull('deleted_at')->get();
        return view('admin.trash')->with('datas', $datas);
    }

        // public function edit a row from a table 
    public function edit($id)
    {
        $data = DB::table('admin')->where('id_admin', $id)->first();
        return view('admin.edit')->with('data', $data);
    }
    // public function to update the table value 
    public function update($id, Request $request)
    {
        $request->validate([
            'id_admin' => 'required',
            'nama' => 'required',
            'alamat' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);
        DB::update(
            'UPDATE admin SET id_admin = :id_admin, 
            nama = :nama, alamat = :alamat, 
            username = :username, password = :password 
            WHERE id_admin = :id',
            [
                'id' => $id,
                'id_admin' => $request->id_admin,
                'nama' => $request->nama,
                'alamat' => $request->alamat,
                'username' => $request->username,
                'password' => $request->password,
            ]
        );
        return redirect()->route('admin.index')->with('success', 'Data Admin berhasil diubah');
    }

    public function delete($id)
    {
        DB::table('admin')->where('id_admin', $id)->update([
            'deleted_at' => now(),
        ]);

        return redirect()->route('admin.index')->with('success', 'Data Admin dipindahkan ke Trash');
    }

    public function undo($id)
    {
        DB::table('admin')->where('id_admin', $id)->update([
            'deleted_at' => null,
        ]);

        return redirect()->route('admin.trash')->with('success', 'Data Admin berhasil dikembalikan');
    }

    public function undoAll()
    {
        DB::table('admin')->whereNotNull('deleted_at')->update([
            'deleted_at' => null,
        ]);

        return redirect()->route('admin.trash')->with('success', 'Semua data berhasil dikembalikan');
    }

    public function forceDelete($id)
    {
        DB::table('admin')->where('id_admin', $id)->delete();

        return redirect()->route('admin.trash')->with('success', 'Data Admin berhasil dihapus permanen');
    }

}
