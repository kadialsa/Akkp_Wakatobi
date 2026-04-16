<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{

    public function __construct()
    {
        $this->middleware('authadmin');

        $this->middleware(function ($request, $next) {

            if (Auth::user()->role != 'superadmin') {
                abort(403);
            }

            return $next($request);
        });
    }

    // ================= LIST ADMIN =================

    public function index()
    {
        $admins = User::where('role', 'admin')
            ->orderBy('id', 'desc')
            ->get();

        return view('Admin.Users.index', compact('admins'));
    }


    // ================= FORM TAMBAH ADMIN =================

    public function create()
    {
        return view('Admin.Users.create');
    }


    // ================= SIMPAN ADMIN =================

    public function store(Request $request)
    {

        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6'
        ]);


        User::create([

            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'admin'

        ]);


        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Admin berhasil dibuat');
    }


    // ================= DETAIL ADMIN =================

    public function show($id)
    {
        $admin = User::findOrFail($id);

        return view('Admin.Users.show', compact('admin'));
    }


    // ================= EDIT ADMIN =================

    public function edit($id)
    {
        $admin = User::findOrFail($id);

        return view('Admin.Users.edit', compact('admin'));
    }


    // ================= UPDATE ADMIN =================

    public function update(Request $request, $id)
    {

        $admin = User::findOrFail($id);


        $request->validate([
            'name' => 'required|max:100',
            'email' => 'required|email|unique:users,email,' . $admin->id
        ]);


        $admin->name = $request->name;
        $admin->email = $request->email;


        // jika password diisi
        if ($request->password) {
            $admin->password = Hash::make($request->password);
        }


        $admin->save();


        return redirect()
            ->route('admin.users.index')
            ->with('success', 'Admin berhasil diupdate');
    }


    // ================= HAPUS ADMIN =================

    public function destroy($id)
    {

        $admin = User::findOrFail($id);

        $admin->delete();

        return back()
            ->with('success', 'Admin berhasil dihapus');
    }
}
