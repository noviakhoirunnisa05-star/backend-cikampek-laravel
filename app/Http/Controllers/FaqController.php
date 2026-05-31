<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar FAQ berhasil diambil',
            'data' => $faqs,
        ], 200);
    }

    public function show($id)
    {
        $faq = Faq::find($id);

        if (!$faq) {
            return response()->json([
                'success' => false,
                'message' => 'FAQ tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail FAQ berhasil diambil',
            'data' => $faq,
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'required|string',
        ]);

        $faq = Faq::create([
            'question' => $request->question,
            'answer' => $request->answer,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'FAQ berhasil ditambahkan',
            'data' => $faq,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $faq = Faq::find($id);

        if (!$faq) {
            return response()->json([
                'success' => false,
                'message' => 'FAQ tidak ditemukan',
            ], 404);
        }

        $request->validate([
            'question' => 'sometimes|required|string|max:255',
            'answer' => 'sometimes|required|string',
        ]);

        $faq->update($request->only([
            'question',
            'answer',
        ]));

        return response()->json([
            'success' => true,
            'message' => 'FAQ berhasil diperbarui',
            'data' => $faq,
        ], 200);
    }

    public function destroy($id)
    {
        $faq = Faq::find($id);

        if (!$faq) {
            return response()->json([
                'success' => false,
                'message' => 'FAQ tidak ditemukan',
            ], 404);
        }

        $faq->delete();

        return response()->json([
            'success' => true,
            'message' => 'FAQ berhasil dihapus',
        ], 200);
    }
}