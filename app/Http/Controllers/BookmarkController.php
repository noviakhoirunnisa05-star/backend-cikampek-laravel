<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function index(Request $request)
    {
        $bookmarks = Bookmark::with('scholarship')
            ->where('user_id', $request->user()->id)
            ->latest()
            ->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar bookmark berhasil diambil',
            'data' => $bookmarks,
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'scholarship_id' => 'required|exists:scholarships,id',
        ]);

        $bookmark = Bookmark::firstOrCreate([
            'user_id' => $request->user()->id,
            'scholarship_id' => $request->scholarship_id,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Beasiswa berhasil ditambahkan ke bookmark',
            'data' => $bookmark,
        ], 201);
    }

    public function destroy(Request $request, $id)
    {
        $bookmark = Bookmark::where('user_id', $request->user()->id)
            ->where('id', $id)
            ->first();

        if (!$bookmark) {
            return response()->json([
                'success' => false,
                'message' => 'Bookmark tidak ditemukan',
            ], 404);
        }

        $bookmark->delete();

        return response()->json([
            'success' => true,
            'message' => 'Bookmark berhasil dihapus',
        ], 200);
    }
}