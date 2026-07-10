<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Stok;
use Illuminate\Http\Request;

class StokController extends Controller
{
    /**
     * Menyimpan produk stok baru ke database sebagai DRAFT (pending approval kepala).
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'qty'          => 'required|integer|min:0',
            'price'        => 'required|numeric|min:0',
        ]);

        // Tambah produk baru harus disetujui kepala sebelum muncul di katalog utama
        Stok::create([
            'product_name'       => $request->product_name . ' (Draft Baru)',
            'qty'                => 0, // 0 sampai diapprove
            'price'              => 0.00, // 0 sampai diapprove
            'status'             => 'pending',
            'draft_product_name' => $request->product_name,
            'draft_qty'          => $request->qty,
            'draft_price'        => $request->price,
        ]);

        return back()->with('success_stok', 'Draft produk sembako berhasil diajukan! Menunggu persetujuan Kepala Koperasi.');
    }

    /**
     * Mengajukan revisi stok/harga (sebagai draft pending approval).
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'qty'   => 'required|integer|min:0',
            'price' => 'required|numeric|min:0',
        ]);

        $stok = Stok::findOrFail($id);
        
        // Simpan sebagai draft perubahan
        $stok->update([
            'status'      => 'pending',
            'draft_qty'   => $request->qty,
            'draft_price' => $request->price,
        ]);

        return back()->with('success_stok', 'Draft perubahan stok/harga untuk "' . $stok->product_name . '" diajukan! Menunggu persetujuan Kepala.');
    }

    /**
     * Menghapus produk sembako langsung (atau via pending jika perlu, tapi kita buat langsung hapus agar praktis).
     */
    public function destroy($id)
    {
        $stok = Stok::findOrFail($id);
        $name = $stok->product_name;
        $stok->delete();

        return back()->with('success_stok', 'Produk "' . $name . '" berhasil dihapus dari daftar!');
    }
}
