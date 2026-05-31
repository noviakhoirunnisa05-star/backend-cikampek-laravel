<<<<<<< HEAD
<?php

=======
>>>>>>> origin/main
namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        return response()->json(Faq::latest()->get());
    }

    public function store(Request $request)
    {
        $request->validate([
            'pertanyaan' => 'required',
            'jawaban' => 'required',
        ]);

        $faq = Faq::create([
            'id_admin' => $request->user()->id_user,
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
        ]);

        return response()->json([
            'message' => 'FAQ berhasil ditambahkan',
            'data' => $faq
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);
<<<<<<< HEAD

        $faq->update([
            'pertanyaan' => $request->pertanyaan,
            'jawaban' => $request->jawaban,
        ]);
=======
        $faq->update($request->all());
>>>>>>> origin/main

        return response()->json([
            'message' => 'FAQ berhasil diperbarui',
            'data' => $faq
        ]);
    }

    public function destroy($id)
    {
<<<<<<< HEAD
        $faq = Faq::findOrFail($id);
        $faq->delete();
=======
        Faq::findOrFail($id)->delete();
>>>>>>> origin/main

        return response()->json([
            'message' => 'FAQ berhasil dihapus'
        ]);
    }
}