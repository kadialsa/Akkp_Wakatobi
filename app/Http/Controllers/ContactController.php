<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
{

    // public function index()
    // {
    //      return view('contact');
    // }

    // ============================
    // USER KIRIM PESAN
    // ============================
    public function send(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string',
        ]);

        DB::table('contact_messages')->insert([
            'name'       => $request->name,
            'email'      => $request->email,
            'subject'    => $request->subject,
            'message'    => $request->message,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Pesan berhasil dikirim');
    }


    // ============================
    // ADMIN LIST PESAN
    // ============================
    public function contactIndex()
    {
        $messages = DB::table('contact_messages')
            ->latest()
            ->paginate(10);

        return view('Admin.Contact.index', compact('messages'));
    }


    // ============================
    // ADMIN DETAIL PESAN
    // ============================
    public function contactShow($id)
    {
        // Tandai sebagai sudah dibaca
        DB::table('contact_messages')
            ->where('id', $id)
            ->update(['is_read' => true]);

        $message = DB::table('contact_messages')->find($id);

        return view('Admin.Contact.show', compact('message'));
    }


    // ============================
    // ADMIN HAPUS PESAN
    // ============================
    public function contactDelete($id)
    {
        DB::table('contact_messages')
            ->where('id', $id)
            ->delete();

        return redirect()
            ->route('admin.contact.index')
            ->with('success', 'Pesan berhasil dihapus');
    }
}
