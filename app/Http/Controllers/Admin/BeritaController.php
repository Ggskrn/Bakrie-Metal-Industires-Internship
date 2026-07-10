<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Berita;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    /**
     * Mengajukan berita baru sebagai DRAFT pending approval.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($request->title) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/news'), $filename);
            $imagePath = 'news/' . $filename;
        }

        // Simpan berita baru sebagai status pending draft
        Berita::create([
            'title'         => $request->title . ' (Draft Baru)',
            'content'       => 'Draft berita baru sedang menunggu persetujuan.',
            'image'         => null,
            'status'        => 'pending',
            'draft_title'   => $request->title,
            'draft_content' => $request->content,
            'draft_image'   => $imagePath,
        ]);

        return back()->with('success_berita', 'Draft berita berhasil diajukan! Menunggu persetujuan Kepala Koperasi.');
    }

    /**
     * Mengajukan edit berita sebagai DRAFT pending approval.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'image'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $berita = Berita::findOrFail($id);

        $imagePath = $berita->image;
        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $filename = time() . '_' . Str::slug($request->title) . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('images/news'), $filename);
            $imagePath = 'news/' . $filename;
        }

        // Ajukan revisi draft berita
        $berita->update([
            'status'        => 'pending',
            'draft_title'   => $request->title,
            'draft_content' => $request->content,
            'draft_image'   => $imagePath,
        ]);

        return back()->with('success_berita', 'Draft perubahan berita "' . $berita->title . '" berhasil diajukan! Menunggu persetujuan Kepala.');
    }

    /**
     * Menghapus berita secara langsung.
     */
    public function destroy($id)
    {
        $berita = Berita::findOrFail($id);
        
        if ($berita->image && file_exists(public_path('images/' . $berita->image))) {
            @unlink(public_path('images/' . $berita->image));
        }

        $title = $berita->title;
        $berita->delete();

        return back()->with('success_berita', 'Berita "' . $title . '" berhasil dihapus!');
    }
}
