<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar artikel berhasil diambil',
            'data' => $articles,
        ], 200);
    }

    public function show($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'success' => false,
                'message' => 'Artikel tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail artikel berhasil diambil',
            'data' => $article,
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|string|max:255',
        ]);

        $article = Article::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $request->image,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Artikel berhasil ditambahkan',
            'data' => $article,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'success' => false,
                'message' => 'Artikel tidak ditemukan',
            ], 404);
        }

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'content' => 'sometimes|required|string',
            'image' => 'nullable|string|max:255',
        ]);

        $article->update($request->only([
            'title',
            'content',
            'image',
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Artikel berhasil diperbarui',
            'data' => $article,
        ], 200);
    }

    public function destroy($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response()->json([
                'success' => false,
                'message' => 'Artikel tidak ditemukan',
            ], 404);
        }

        $article->delete();

        return response()->json([
            'success' => true,
            'message' => 'Artikel berhasil dihapus',
        ], 200);
    }
}