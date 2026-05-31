<<<<<<< HEAD
<?php

=======
>>>>>>> origin/main
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

        return response()->json($bookmarks);
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_scholarship' => 'required'
        ]);

        $bookmark = Bookmark::firstOrCreate([
            'id_user' => $request->user()->id_user,
            'id_scholarship' => $request->id_scholarship,
        ]);

        return response()->json([
            'message' => 'Beasiswa berhasil disimpan',
            'data' => $bookmark
        ], 201);
    }

    public function destroy(Request $request, $id)
    {
        Bookmark::where('id_bookmark', $id)
            ->where('id_user', $request->user()->id_user)
            ->delete();

        return response()->json([
            'message' => 'Bookmark berhasil dihapus'
        ]);
    }
}