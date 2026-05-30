namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        return response()->json(Article::latest()->get());
    }

    public function show($id)
    {
        return response()->json(Article::findOrFail($id));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi_artikel' => 'required',
        ]);

        $article = Article::create([
            'id_admin' => $request->user()->id_user,
            'judul' => $request->judul,
            'isi_artikel' => $request->isi_artikel,
            'gambar' => $request->gambar,
        ]);

        return response()->json([
            'message' => 'Artikel berhasil ditambahkan',
            'data' => $article
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);
        $article->update($request->all());

        return response()->json([
            'message' => 'Artikel berhasil diperbarui',
            'data' => $article
        ]);
    }

    public function destroy($id)
    {
        Article::findOrFail($id)->delete();

        return response()->json([
            'message' => 'Artikel berhasil dihapus'
        ]);
    }
}