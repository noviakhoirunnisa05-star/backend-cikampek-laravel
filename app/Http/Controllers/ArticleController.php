<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::with('admin')->get();

        return response()->json([
            'message' => 'Data artikel berhasil diambil',
            'data' => $articles
        ]);
    }

    public function show($id)
    {
        $article = Article::with('admin')->findOrFail($id);

        return response()->json([
            'message' => 'Detail artikel berhasil diambil',
            'data' => $article
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'isi_artikel' => 'required|string',
            'gambar' => 'nullable|string',
        ]);

        $data['id_admin'] = $request->user()->id_user;

        $article = Article::create($data);

        return response()->json([
            'message' => 'Artikel berhasil ditambahkan',
            'data' => $article
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $article = Article::findOrFail($id);

        $data = $request->validate([
            'judul' => 'required|string|max:255',
            'isi_artikel' => 'required|string',
            'gambar' => 'nullable|string',
        ]);

        $article->update($data);

        return response()->json([
            'message' => 'Artikel berhasil diupdate',
            'data' => $article
        ]);
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);
        $article->delete();

        return response()->json([
            'message' => 'Artikel berhasil dihapus'
        ]);
    }
}