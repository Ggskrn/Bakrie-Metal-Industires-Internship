<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function store(Request $request)
    {
        $request->validate(['message' => 'required|string']);
        Announcement::create([
            'message'          => $request->message,
            'user_id'          => auth()->id(),
            'is_read_by_admin' => false,
        ]);
        return back()->with('success_kepala_pesan', 'Catatan koreksi berhasil dikirim ke Administrator!');
    }
}