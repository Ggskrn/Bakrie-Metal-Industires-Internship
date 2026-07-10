<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Berita;
use App\Models\Stok;
use App\Models\WhatsAppMessage;
use App\Models\Announcement;
use App\Models\MinatData;
use App\Models\ProdukLayananKonten;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DashboardController extends Controller
{
    public function index()
    {
        $user          = auth()->user();
        $totalAnggota  = User::where('role', 'public')->count();
        $totalBerita   = Berita::count();
        $totalStok     = Stok::sum('qty');
        $messages      = WhatsAppMessage::latest()->take(10)->get();
        $anggota       = User::where('role', 'public')->latest()->take(5)->get();
        $stoks         = Stok::orderBy('product_name')->get();
        $beritas       = Berita::latest()->get();
        
        // Ambil catatan Kepala
        $announcements = Announcement::latest()->take(10)->get();

        // Cari tahu apakah ada catatan Kepala yang BELUM dibaca oleh Admin untuk memicu pop-up notifikasi login
        $unreadCountForAdmin = Announcement::where('is_read_by_admin', false)->count();

        // Tandai semua catatan kepala sebagai sudah dibaca oleh admin ketika admin membuka halaman dashboard ini
        Announcement::where('is_read_by_admin', false)->update(['is_read_by_admin' => true]);

        // Ambil Data Minat & Konten
        $minatData = MinatData::orderBy('year', 'desc')->orderBy('month', 'desc')->get();
        $kontens = ProdukLayananKonten::all()->keyBy('slug');

        // Pastikan 9 konten default terbuat jika kosong
        $categories = MinatData::categories();
        foreach ($categories as $slug => $meta) {
            if (!$kontens->has($slug)) {
                $konten = ProdukLayananKonten::create([
                    'slug' => $slug,
                    'title' => $meta['title'],
                    'description' => 'Deskripsi default untuk ' . $meta['title'],
                    'syarat' => 'Syarat default ' . $meta['title'],
                    'harga_info' => 'Info biaya / harga default',
                    'status' => 'approved'
                ]);
                $kontens->put($slug, $konten);
            }
        }

        return view('admin.dashboard', compact(
            'user', 'totalAnggota', 'totalBerita', 'totalStok',
            'messages', 'anggota', 'stoks', 'beritas', 'announcements', 'unreadCountForAdmin',
            'minatData', 'kontens'
        ));
    }

    /**
     * Membalas catatan revisi dari Kepala Koperasi.
     */
    public function replyAnnouncement(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string|max:1000',
        ]);

        $ann = Announcement::findOrFail($id);
        $ann->update([
            'reply'             => $request->reply,
            'replied_at'        => now(),
            'is_read_by_kepala' => false // agar memicu notifikasi baru di dashboard Kepala
        ]);

        return back()->with('success_reply_kepala', 'Balasan untuk Kepala Koperasi berhasil dikirim!');
    }

    /**
     * Update/edit minat (dimasukkan sebagai draft pending approval).
     */
    public function updateMinat(Request $request)
    {
        $request->validate([
            'category' => 'required|string',
            'year' => 'required|integer',
            'month' => 'required|integer|between:1,12',
            'anggota' => 'required|integer|min:0',
            'mitra' => 'required|integer|min:0',
        ]);

        // Temukan record minat yang bersangkutan, atau buat jika belum ada
        $minat = MinatData::where('category', $request->category)
            ->where('year', $request->year)
            ->where('month', $request->month)
            ->first();

        if ($minat) {
            $minat->update([
                'draft_anggota' => $request->anggota,
                'draft_mitra' => $request->mitra,
                'status' => 'pending'
            ]);
        } else {
            MinatData::create([
                'category' => $request->category,
                'year' => $request->year,
                'month' => $request->month,
                'anggota' => 0,
                'mitra' => 0,
                'draft_anggota' => $request->anggota,
                'draft_mitra' => $request->mitra,
                'status' => 'pending'
            ]);
        }

        return back()->with('success_stok', 'Draft perubahan data statistik minat diajukan ke Kepala Koperasi!');
    }

    /**
     * Update/edit konten produk/layanan (dimasukkan sebagai draft pending approval).
     */
    public function updateKonten(Request $request, $slug)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'syarat' => 'nullable|string',
            'harga_info' => 'nullable|string|max:255',
        ]);

        $konten = ProdukLayananKonten::where('slug', $slug)->firstOrFail();
        $konten->update([
            'draft_title' => $request->title,
            'draft_description' => $request->description,
            'draft_syarat' => $request->syarat,
            'draft_harga_info' => $request->harga_info,
            'status' => 'pending'
        ]);

        return back()->with('success_stok', 'Draft pembaruan konten "' . $request->title . '" berhasil diajukan ke Kepala Koperasi!');
    }

    /**
     * Balas pesan WhatsApp.
     */
    public function replyWhatsApp(Request $request, $id)
    {
        $request->validate([
            'reply' => 'required|string|max:1000',
        ]);

        $message = WhatsAppMessage::findOrFail($id);
        $message->update(['reply' => $request->reply, 'replied_at' => now()]);

        return back()->with('success', 'Balasan tersimpan.');
    }
}