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
        $faq->update($request->all());

        return response()->json([
            'message' => 'FAQ berhasil diperbarui',
            'data' => $faq
        ]);
    }

    public function destroy($id)
    {
        Faq::findOrFail($id)->delete();

        return response()->json([
            'message' => 'FAQ berhasil dihapus'
        ]);
    }
}