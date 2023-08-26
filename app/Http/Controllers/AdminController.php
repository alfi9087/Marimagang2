<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;

class AdminController extends Controller
{
    public function store(Request $request)
    {
        $ValidatedData = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|unique:users',
            'password' => 'required|min:8'
        ]);

        $ValidatedData['password'] = bcrypt($ValidatedData['password']);

        Admin::create($ValidatedData);

        return redirect('/adminshow')->with(['success' => 'Data Admin Berhasil Ditambahkan']);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email:dns|unique:users',
        ]);

        $admin = Admin::find($id);
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->save();

        return redirect('/adminshow')->with(['success' => 'Data Admin Berhasil Diupdate']);
    }

    public function delete(Request $request)
    {
        Admin::destroy($request->id);
        return redirect()->back()
            ->with(['delete' => 'Data Admin Berhasil Dihapus']);
    }
}
