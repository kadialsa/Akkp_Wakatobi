<?php

namespace App\Http\Controllers;

require_once app_path('Helpers/helpers.php');

use App\Models\About;
use App\Models\Akreditasi;
use App\Models\Berita;
use App\Models\ContactMessage;
use App\Models\Cooperation;
use App\Models\HeaderSetting;
use App\Models\Leader;
use App\Models\Section;
use App\Models\Sejarah;
use Illuminate\Http\Request;
use App\Models\Sliders;
use App\Models\StrukturOrganisasi;
use App\Models\Tupoksi;
use App\Models\Video;
use App\Models\VisiMisi;
use App\Models\Visitor;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cooperations = Cooperation::where('is_active', 1)
            ->orderBy('position')
            ->get();

        $sliders = Sliders::where('is_active', 1)
            ->orderBy('position')
            ->get();

        $about = About::first();
        $akreditasi = Akreditasi::latest()->get();

        // ===============================
        // Bulan yang dipilih dari dropdown
        // ===============================
        $selectedMonth = (int) ($request->month ?? Carbon::now()->month);
        $selectedYear  = (int) ($request->year ?? Carbon::now()->year);

        // ===============================
        // Data pengunjung berdasarkan bulan
        // ===============================
        $visitorRaw = DB::table('visitors')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->whereMonth('created_at', $selectedMonth)
            ->whereYear('created_at', $selectedYear)
            ->groupBy('date')
            ->pluck('count', 'date');

        // Jumlah hari dalam bulan yang dipilih
        $daysInMonth = Carbon::create($selectedYear, $selectedMonth)->daysInMonth;

        $visitors = [];

        for ($i = 1; $i <= $daysInMonth; $i++) {

            $date =
                $selectedYear . '-' .
                str_pad($selectedMonth, 2, '0', STR_PAD_LEFT) . '-' .
                str_pad($i, 2, '0', STR_PAD_LEFT);

            $visitors[$i] = $visitorRaw[$date] ?? 0;
        }


        $visitorToday = Visitor::whereDate('created_at', Carbon::today())->count();

        $visitorMonth = Visitor::whereMonth('created_at', Carbon::now()->month)->count();

        $visitorCount = Visitor::count();

        $messageCount = ContactMessage::count();

        $newsCount = Berita::count();

        $latestNews = Berita::latest()->take(3)->get();

        // $visitorCount = DB::table('visitors')->count();

        $unreadMessages = DB::table('contact_messages')
            ->where('is_read', false)
            ->count();

        $messageCount = DB::table('contact_messages')->count();

        $newsCount = Berita::count();

        // ===============================
        // Grafik 7 hari terakhir
        // ===============================
        $visitorDataRaw = DB::table('visitors')
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'desc')
            ->take(7)
            ->get()
            ->reverse();

        $visitorData = [
            'dates' => $visitorDataRaw->pluck('date')->toArray(),
            'counts' => $visitorDataRaw->pluck('count')->toArray()
        ];

        return view('Admin.index', compact(
            'cooperations',
            'sliders',
            'about',
            'akreditasi',
            'daysInMonth',
            'visitors',
            'visitorRaw',
            'visitorCount',
            'messageCount',
            'unreadMessages',

            // dashboard admin
            'newsCount',
            'visitorData',
            'selectedMonth',

            'visitorToday',
            'visitorMonth',
            'visitorCount',
            'messageCount',
            'newsCount',
            'latestNews',
            'visitorRaw',
            'daysInMonth',
            'selectedMonth',
            'selectedYear'
        ));
    }

    public function aboutEdit()
    {
        $about = About::first(); // Ambil data pertama
        return view('Admin.About', compact('about'));
    }

    public function aboutUpdate(Request $request, $id)
    {
        $about = About::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'title' => 'required|string|max:255',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['name', 'title', 'description']);

        // 🔥 MODE NORMAL (PRODUCTION)
        if ($request->hasFile('image')) {

            $file = $request->file('image');

            if ($file->isValid()) {

                $imageName = uploadFile(
                    $file,
                    'about',
                    $about->image
                );

                if (!$imageName) {
                    return back()->with('error', 'Gagal upload gambar');
                }

                $data['image'] = $imageName;
            }
        }

        $about->update($data);

        return back()->with('success', 'Data berhasil diperbarui');
    }


    // Kerjasama
    public function coperation_index()
    {
        $items = Cooperation::orderBy('position')->get();
        return view('Admin.Cooperation', compact('items'));
    }

    // ========================
    // CREATE
    // ========================
    public function cooperation_create()
    {
        return view('Admin.Cooperation-add');
    }

    // ========================
    // STORE
    // ========================
    public function cooperation_store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $data = [
            'position' => $request->position ?? 0,
            'is_active' => $request->is_active ?? 1,
        ];

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            if ($file && $file->isValid()) {

                $imageName = uploadFile($file, 'cooperation');

                if (!$imageName) {
                    return back()->with('error', 'Gagal upload gambar');
                }

                $data['image'] = $imageName;
            } else {
                return back()->with('error', 'File tidak valid');
            }
        }

        Cooperation::create($data);

        return redirect()->route('admin.cooperation.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    // ========================
    // EDIT
    // ========================
    public function cooperation_edit($id)
    {
        $cooperation = Cooperation::findOrFail($id);

        return view('Admin.Cooperation-edit', compact('cooperation'));
    }

    // ========================
    // UPDATE
    // ========================
    public function cooperation_update(Request $request, $id)
    {
        $cooperation = Cooperation::findOrFail($id);

        $request->validate([
            'image' => 'nullable|image|mimes:png,jpg,jpeg|max:2048'
        ]);

        $data = [
            'position' => $request->position ?? 0,
            'is_active' => $request->is_active,
        ];

        if ($request->hasFile('image')) {

            $file = $request->file('image');

            if ($file && $file->isValid()) {

                $imageName = uploadFile(
                    $file,
                    'cooperation',
                    $cooperation->image
                );

                if (!$imageName) {
                    return back()->with('error', 'Gagal upload gambar');
                }

                $data['image'] = $imageName;
            }
        }

        $cooperation->update($data);

        return redirect()->route('admin.cooperation.index')
            ->with('success', 'Data berhasil diperbarui');
    }

    // ========================
    // DELETE
    // ========================
    public function cooperation_destroy(Cooperation $cooperation)
    {
        deleteFile($cooperation->image, 'cooperation');

        $cooperation->delete();

        return back()->with('success', 'Data berhasil dihapus');
    }

    // visi dan misi
    public function visiMisiEdit()
    {
        $visimisi = VisiMisi::firstOrCreate(
            [],
            [
                'visi' => '',
                'misi' => '',
            ]
        );

        return view('Admin.VisiMisi', compact('visimisi'));
    }

    public function visiMisiUpdate(Request $request)
    {
        $request->validate([
            'visi' => 'required',
            'misi' => 'required|array',
        ]);

        $visimisi = VisiMisi::firstOrFail();

        $misiText = implode("\n", $request->misi);

        $visimisi->update([
            'visi' => $request->visi,
            'misi' => $misiText,
        ]);

        return back()->with('success', 'Visi & Misi berhasil diperbarui!');
    }

    // sejarah
    public function sejarahEdit()
    {
        $sejarah = Sejarah::first();
        return view('Admin.Sejarah', compact('sejarah'));
    }
    public function sejarahUpdate(Request $request)
    {
        $sejarah = Sejarah::firstOrFail();

        // ✅ Validasi
        $request->validate([
            'sejarah' => 'required',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // ✅ Data awal
        $data = [
            'sejarah' => $request->sejarah,
        ];

        // 🔥 Upload gambar pakai helper
        if ($request->hasFile('foto')) {

            $imageName = uploadFile(
                $request->file('foto'),
                'sejarah',
                $sejarah->foto // otomatis hapus lama
            );

            // ❗ jika gagal upload
            if (!$imageName) {
                return back()->with('error', 'Gagal upload gambar');
            }

            $data['foto'] = $imageName;
        }

        // ✅ Update ke database
        $sejarah->update($data);

        return back()->with('success', 'Sejarah berhasil diperbarui');
    }

    // Tugas Pokok Dan Fungsi
    public function tupoksiEdit()
    {
        $tupoksi = Tupoksi::first();
        return view('Admin.Tupoksi', compact('tupoksi'));
    }

    public function tupoksiUpdate(Request $request)
    {
        $tupoksi = Tupoksi::firstOrFail();

        $request->validate([
            'tugas_pokok' => 'required',
            'fungsi' => 'required|array',
            'fungsi.*' => 'required|string',
        ]);

        $fungsiText = implode("\n", $request->fungsi);

        $tupoksi->update([
            'tugas_pokok' => $request->tugas_pokok,
            'fungsi' => $fungsiText,
        ]);

        return back()->with('success', 'Tugas Pokok & Fungsi berhasil diperbarui');
    }

    // StrukturOrganisasi
    public function strukturEdit()
    {
        $struktur = StrukturOrganisasi::first();
        return view('Admin.StrukturOrganisasi', compact('struktur'));
    }

    public function strukturUpdate(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        // ambil data pertama, jika tidak ada return error
        $struktur = StrukturOrganisasi::first();
        if (!$struktur) {
            return back()->with('error', 'Data struktur organisasi belum tersedia.');
            // atau bisa redirect ke halaman lain sesuai kebutuhan
        }

        if ($request->hasFile('image')) {

            // hapus gambar lama jika ada
            if ($struktur->image && file_exists(public_path('uploads/struktur/' . $struktur->image))) {
                unlink(public_path('uploads/struktur/' . $struktur->image));
            }

            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('uploads/struktur'), $imageName);

            $struktur->image = $imageName;
        }

        $struktur->save(); // update data

        return back()->with('success', 'Struktur organisasi berhasil diperbarui');
    }

    public function section_index()
    {
        $sections = Section::with('leaders')->get();
        return view('Admin.Sections.Index', compact('sections'));
    }

    public function section_create()
    {
        return view('Admin.Sections.Create');
    }

    public function section_store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        Section::create([
            'title' => $request->title
        ]);

        return redirect()->route('admin.section.index')
            ->with('success', 'Section berhasil ditambahkan');
    }


    public function section_edit(Section $section)
    {
        return view('Admin.Sections.Edit', compact('section'));
    }

    public function section_update(Request $request, Section $section)
    {
        $request->validate([
            'title' => 'required|string|max:255',
        ]);

        $section->update([
            'title' => $request->title
        ]);

        return redirect()->route('admin.section.index')
            ->with('success', 'Section berhasil diperbarui');
    }


    public function section_destroy(Section $section)
    {
        $section->delete();

        return redirect()->route('admin.section.index')
            ->with('success', 'Section berhasil dihapus');
    }

    // leader

    public function leader_create(Section $section)
    {
        return view('Admin.Sections.leader-create', compact('section'));
    }

    public function leader_Store(Request $request)
    {
        $request->validate([
            'section_id' => 'required|exists:sections,id',
            'position' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'degree' => 'nullable|string|max:255',
            'photo' => 'nullable|image|mimes:jpg,png,jpeg|max:2048'
        ]);

        $imageName = null;

        if ($request->hasFile('photo')) {
            $imageName = time() . '.' . $request->photo->extension();
            $request->photo->move(public_path('uploads/leaders'), $imageName);
        }


        Leader::create([
            'section_id' => $request->section_id,
            'position' => $request->position,
            'name' => $request->name,
            'degree' => $request->degree,
            'photo' => $imageName
        ]);

        return redirect()->route('admin.section.index')
            ->with('success', 'Data berhasil ditambahkan');
    }

    public function leader_edit(Leader $leader)
    {
        return view('Admin.Sections.leader-edit', compact('leader'));
    }


    public function leader_update(Request $request, Leader $leader)
    {
        // Validasi dasar dulu
        $request->validate([
            'position' => 'required|string|max:255',
            'name'     => 'required|string|max:255',
            'degree'   => 'nullable|string|max:255',
            'photo'    => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'position.required' => 'Jabatan wajib diisi.',
            'name.required'     => 'Nama wajib diisi.',
            'photo.image'       => 'File harus berupa gambar.',
            'photo.mimes'       => 'Format gambar harus JPG atau PNG.',
            'photo.max'         => 'Ukuran gambar maksimal 2MB.',
        ]);

        // Validasi tambahan untuk rasio & ukuran
        if ($request->hasFile('photo')) {

            $file = $request->file('photo');
            [$width, $height] = getimagesize($file);

            // Cek minimal ukuran
            if ($width < 400 || $height < 600) {
                return back()
                    ->withErrors(['photo' => 'Ukuran minimal gambar adalah 400x600 px.'])
                    ->withInput();
            }

            // Cek rasio 2:3 (cross multiply supaya stabil)
            if ($width * 3 !== $height * 2) {
                return back()
                    ->withErrors(['photo' => 'Rasio gambar harus 2:3 (contoh 400x600 atau 600x900).'])
                    ->withInput();
            }
        }

        // Update data teks
        $leader->position = $request->position;
        $leader->name     = $request->name;
        $leader->degree   = $request->degree;

        // Upload foto baru jika ada
        if ($request->hasFile('photo')) {

            // Hapus foto lama
            if ($leader->photo && File::exists(public_path('uploads/leaders/' . $leader->photo))) {
                File::delete(public_path('uploads/leaders/' . $leader->photo));
            }

            $file = $request->file('photo');
            $imageName = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/leaders'), $imageName);

            $leader->photo = $imageName;
        }

        $leader->save();

        return redirect()
            ->route('admin.section.index')
            ->with('success', 'Data pimpinan berhasil diperbarui.');
    }


    public function leader_destroy(Leader $leader)
    {
        // Hapus foto jika ada
        if ($leader->photo && File::exists(public_path('uploads/leaders/' . $leader->photo))) {
            File::delete(public_path('uploads/leaders/' . $leader->photo));
        }

        $leader->delete();

        return redirect()
            ->route('admin.section.index')
            ->with('success', 'Data pimpinan berhasil dihapus.');
    }


    // ===============================
    // LIST DATA
    // ===============================
    public function beritaIndex()
    {
        $beritas = Berita::latest()->paginate(9);
        return view('Admin.Berita.index', compact('beritas'));
    }

    // ===============================
    // FORM TAMBAH
    // ===============================
    public function beritaCreate()
    {
        return view('Admin.Berita.create');
    }

    // ===============================
    // SIMPAN DATA
    // ===============================
    public function beritaStore(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $data = $request->except('_token');

        // slug otomatis
        $data['slug'] = Str::slug($request->title);

        // ringkasan otomatis dari isi berita
        $data['excerpt'] = Str::limit(strip_tags($request->content), 150);

        // simpan user_id dari admin login
        $data['user_id'] = Auth::id();

        // upload gambar
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/beritas'), $filename);

            $data['image'] = 'uploads/beritas/' . $filename;
        }

        Berita::create($data);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil ditambahkan');
    }

    // ===============================
    // FORM EDIT
    // ===============================
    public function beritaEdit($id)
    {
        $berita = Berita::findOrFail($id);
        return view('Admin.Berita.edit', compact('berita'));
    }

    // ===============================
    // UPDATE DATA
    // ===============================
    public function beritaUpdate(Request $request, $id)
    {
        $berita = Berita::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'content' => 'required'
        ]);

        $data = $request->except(['_token', '_method', 'user_id']);

        // update slug
        $data['slug'] = Str::slug($request->title);

        // update excerpt otomatis
        $data['excerpt'] = Str::limit(strip_tags($request->content), 150);

        // upload gambar baru
        if ($request->hasFile('image')) {

            if ($berita->image && file_exists(public_path($berita->image))) {
                unlink(public_path($berita->image));
            }

            $file = $request->file('image');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads/beritas'), $filename);

            $data['image'] = 'uploads/beritas/' . $filename;
        }

        $berita->update($data);

        return redirect()->route('admin.berita.index')
            ->with('success', 'Berita berhasil diupdate');
    }

    public function beritaShow($id)
    {
        $berita = Berita::findOrFail($id);
        return view('Admin.Berita.show', compact('berita'));
    }

    public function beritaDestroy($id)
    {
        $berita = Berita::findOrFail($id);

        if ($berita->image && file_exists(public_path($berita->image))) {
            unlink(public_path($berita->image));
        }

        $berita->delete();

        return back()->with('success', 'Berita berhasil dihapus');
    }

    public function contact()
    {
        return view('Contact');
    }

    public function contactStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        DB::table('contact_messages')->insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return back()->with('success', 'Pesan berhasil dikirim');
    }

    // ================= VIDEO =================

    public function videoUser()
    {
        $videos = Video::where('is_active', 1)
            ->latest()
            ->get();

        return view('Videos', compact('videos'));
    }


    public function videoIndex()
    {
        $videos = Video::latest()->get();

        return view('Admin.Video.index', compact('videos'));
    }


    public function videoCreate()
    {
        return view('Admin.Video.create');
    }


    public function videoStore(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'youtube_link' => 'required'
        ]);

        Video::create([
            'title' => $request->title,
            'youtube_link' => $request->youtube_link,
            'is_active' => $request->is_active ?? 1
        ]);

        return redirect()->route('admin.video.index')
            ->with('success', 'Video berhasil ditambahkan');
    }


    public function videoEdit($id)
    {
        $video = Video::findOrFail($id);

        return view('Admin.Video.edit', compact('video'));
    }


    public function videoUpdate(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'youtube_link' => 'required'
        ]);

        $video = Video::findOrFail($id);

        $video->update([
            'title' => $request->title,
            'youtube_link' => $request->youtube_link,
            'is_active' => $request->is_active ?? 1
        ]);

        return redirect()->route('admin.video.index')
            ->with('success', 'Video berhasil diupdate');
    }


    public function videoDelete($id)
    {
        $video = Video::findOrFail($id);
        $video->delete();

        return redirect()->route('admin.video.index')
            ->with('success', 'Video berhasil dihapus');
    }
    // Header
    public function __construct()
    {
        // Share header ke semua view
        $header = HeaderSetting::first();
        view()->share('header', $header);
    }


    // Halaman Edit Header
    public function headerEdit()
    {
        $header = HeaderSetting::first();

        // Jika belum ada → buat 1 data saja
        if (!$header) {
            $header = HeaderSetting::create([
                'image' => null
            ]);
        }

        return view('Admin.Header', compact('header'));
    }


    // Update Header
    public function headerUpdate(Request $request)
    {
        $request->validate([
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        // Ambil header pertama saja (tidak buat baru)
        $header = HeaderSetting::firstOrFail();

        if ($request->hasFile('image')) {

            // Hapus gambar lama
            if ($header->image && file_exists(public_path('uploads/header/' . $header->image))) {
                unlink(public_path('uploads/header/' . $header->image));
            }

            $file = $request->file('image');

            $namaFile = time() . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('uploads/header'), $namaFile);

            $header->image = $namaFile;
        }

        $header->save();

        return back()->with('success', 'Header berhasil diperbarui');
    }
}
