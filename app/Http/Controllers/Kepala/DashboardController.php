<?php

namespace App\Http\Controllers\Kepala;

use App\Http\Controllers\Controller;
use App\Models\Announcement;
use App\Models\Berita;
use App\Models\Stok;
use App\Models\MinatData;
use App\Models\ProdukLayananKonten;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $activities = collect();
        
        // Ambil pengumuman yang dikirim oleh kepala ini
        $announcements = Announcement::where('user_id', auth()->id())->latest()->get();

        // Cari tahu apakah ada balasan dari Admin yang BELUM dibaca oleh Kepala
        $unreadRepliesCount = Announcement::where('user_id', auth()->id())
            ->whereNotNull('reply')
            ->where('is_read_by_kepala', false)
            ->count();

        // Tandai semua balasan admin sebagai sudah dibaca oleh kepala
        Announcement::where('user_id', auth()->id())
            ->whereNotNull('reply')
            ->where('is_read_by_kepala', false)
            ->update(['is_read_by_kepala' => true]);

        // Ambil stok dan berita dengan status pending untuk disetujui kepala
        $pendingStoks = Stok::where('status', 'pending')->get();
        $pendingBeritas = Berita::where('status', 'pending')->get();

        // Ambil minat dan konten dengan status pending
        $pendingMinats = MinatData::where('status', 'pending')->get();
        $pendingKontens = ProdukLayananKonten::where('status', 'pending')->get();

        // Data minat historis untuk visualisasi grafik di kepala
        $minatData = MinatData::orderBy('year', 'desc')->orderBy('month', 'desc')->get();
        $kontens = ProdukLayananKonten::all()->keyBy('slug');
        
        return view('kepala.dashboard', compact(
            'activities', 'announcements', 'unreadRepliesCount', 
            'pendingStoks', 'pendingBeritas', 'pendingMinats', 'pendingKontens',
            'minatData', 'kontens'
        ));
    }

    /**
     * Menyetujui draft stok.
     */
    public function approveStok($id)
    {
        $stok = Stok::findOrFail($id);

        $name = $stok->draft_product_name ?? $stok->product_name;
        if (str_contains($stok->product_name, ' (Draft Baru)')) {
            $name = str_replace(' (Draft Baru)', '', $stok->product_name);
        }

        $stok->update([
            'product_name'       => $name,
            'qty'                => $stok->draft_qty ?? $stok->qty,
            'price'              => $stok->draft_price ?? $stok->price,
            'status'             => 'approved',
            'draft_product_name' => null,
            'draft_qty'          => null,
            'draft_price'        => null,
        ]);

        return back()->with('success_approval', 'Perubahan produk "' . $name . '" berhasil disetujui!');
    }

    /**
     * Menolak draft stok.
     */
    public function rejectStok($id)
    {
        $stok = Stok::findOrFail($id);
        
        if (str_contains($stok->product_name, ' (Draft Baru)')) {
            $stok->delete();
        } else {
            $stok->update([
                'status'             => 'approved',
                'draft_qty'          => null,
                'draft_price'        => null,
                'draft_product_name' => null
            ]);
        }

        return back()->with('success_approval', 'Draft perubahan produk berhasil ditolak.');
    }

    /**
     * Menyetujui draft berita.
     */
    public function approveBerita($id)
    {
        $berita = Berita::findOrFail($id);

        $title = $berita->draft_title ?? $berita->title;
        if (str_contains($berita->title, ' (Draft Baru)')) {
            $title = str_replace(' (Draft Baru)', '', $berita->title);
        }

        $berita->update([
            'title'         => $title,
            'content'       => $berita->draft_content ?? $berita->content,
            'image'         => $berita->draft_image ?? $berita->image,
            'status'        => 'approved',
            'draft_title'   => null,
            'draft_content' => null,
            'draft_image'   => null,
        ]);

        return back()->with('success_approval', 'Berita "' . $title . '" disetujui!');
    }

    /**
     * Menolak draft berita.
     */
    public function rejectBerita($id)
    {
        $berita = Berita::findOrFail($id);

        if (str_contains($berita->title, ' (Draft Baru)')) {
            $berita->delete();
        } else {
            $berita->update([
                'status'        => 'approved',
                'draft_title'   => null,
                'draft_content' => null,
                'draft_image'   => null
            ]);
        }

        return back()->with('success_approval', 'Draft berita ditolak.');
    }

    /**
     * Menyetujui draft data minat anggota.
     */
    public function approveMinat($id)
    {
        $minat = MinatData::findOrFail($id);
        $minat->update([
            'anggota' => $minat->draft_anggota ?? $minat->anggota,
            'mitra' => $minat->draft_mitra ?? $minat->mitra,
            'status' => 'approved',
            'draft_anggota' => null,
            'draft_mitra' => null
        ]);

        $categories = MinatData::categories();
        $catTitle = $categories[$minat->category]['title'] ?? $minat->category;

        return back()->with('success_approval', 'Perubahan minat anggota/mitra untuk "' . $catTitle . '" (Bulan ' . $minat->month . '/' . $minat->year . ') disetujui!');
    }

    /**
     * Menolak draft data minat anggota.
     */
    public function rejectMinat($id)
    {
        $minat = MinatData::findOrFail($id);
        $minat->update([
            'status' => 'approved',
            'draft_anggota' => null,
            'draft_mitra' => null
        ]);

        return back()->with('success_approval', 'Draft perubahan statistik minat ditolak.');
    }

    /**
     * Menyetujui draft konten produk/layanan.
     */
    public function approveKonten($id)
    {
        $konten = ProdukLayananKonten::findOrFail($id);
        $konten->update([
            'title' => $konten->draft_title ?? $konten->title,
            'description' => $konten->draft_description ?? $konten->description,
            'syarat' => $konten->draft_syarat ?? $konten->syarat,
            'harga_info' => $konten->draft_harga_info ?? $konten->harga_info,
            'status' => 'approved',
            'draft_title' => null,
            'draft_description' => null,
            'draft_syarat' => null,
            'draft_harga_info' => null
        ]);

        return back()->with('success_approval', 'Pembaruan konten "' . $konten->title . '" berhasil disetujui dan dipublikasikan!');
    }

    /**
     * Menolak draft konten produk/layanan.
     */
    public function rejectKonten($id)
    {
        $konten = ProdukLayananKonten::findOrFail($id);
        $konten->update([
            'status' => 'approved',
            'draft_title' => null,
            'draft_description' => null,
            'draft_syarat' => null,
            'draft_harga_info' => null
        ]);

        return back()->with('success_approval', 'Draft perubahan konten ditolak.');
    }

    public function sendAnnouncement(Request $request)
    {
        $request->validate(['message' => 'required|string']);
        Announcement::create([
            'message' => $request->message,
            'user_id' => auth()->id(),
        ]);
        return back()->with('success', 'Pengumuman terkirim.');
    }
}