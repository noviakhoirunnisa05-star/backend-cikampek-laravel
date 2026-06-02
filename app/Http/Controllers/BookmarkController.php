<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    public function index(Request $request)
    {
        $bookmarks = Bookmark::with('scholarship')
            ->where('id_user', $request->user()->id_user)
            ->get();

        return response()->json([
            'message' => 'Data bookmark berhasil diambil',
            'data' => $bookmarks
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_scholarship' => 'required|exists:scholarships,id_scholarship',
        ]);

        $bookmark = Bookmark::firstOrCreate([
            'id_user' => $request->user()->id_user,
            'id_scholarship' => $data['id_scholarship'],
        ]);

        return response()->json([
            'message' => 'Beasiswa berhasil disimpan',
            'data' => $bookmark
        ], 201);
    }

    public function destroy(Request $request, $id)
    {
        $bookmark = Bookmark::where('id_user', $request->user()->id_user)
            ->where('id_bookmark', $id)
            ->firstOrFail();

        $bookmark->delete();

        return response()->json([
            'message' => 'Bookmark berhasil dihapus'
        ]);
    }
}