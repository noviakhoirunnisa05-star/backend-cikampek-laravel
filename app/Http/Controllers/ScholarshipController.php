<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use Illuminate\Http\Request;

class ScholarshipController extends Controller
{
    public function index(Request $request)
    {
        $query = Scholarship::with('educationLevel');

        if ($request->search) {
            $query->where('nama_beasiswa', 'like', '%' . $request->search . '%');
        }

        if ($request->semester) {
            $query->where('semester_min', '<=', $request->semester)
                  ->where('semester_max', '>=', $request->semester);
        }

        if ($request->level) {
            $query->whereHas('educationLevel', function ($q) use ($request) {
                $q->where('nama_level', $request->level);
            });
        }

        return response()->json($query->get());
    }

    public function show($id)
    {
        $scholarship = Scholarship::with('educationLevel')->findOrFail($id);

        return response()->json($scholarship);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_level' => 'required',
            'nama_beasiswa' => 'required',
            'penyelenggara' => 'required',
            'deskripsi' => 'required',
            'persyaratan' => 'required',
            'deadline' => 'required|date',
            'status' => 'required',
        ]);

        $data['id_admin'] = $request->user()->id_user;
        $data['semester_min'] = $request->semester_min;
        $data['semester_max'] = $request->semester_max;
        $data['link_pendaftaran'] = $request->link_pendaftaran;

        $scholarship = Scholarship::create($data);

        return response()->json([
            'message' => 'Beasiswa berhasil ditambahkan',
            'data' => $scholarship,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $scholarship = Scholarship::findOrFail($id);

        $scholarship->update($request->all());

        return response()->json([
            'message' => 'Beasiswa berhasil diperbarui',
            'data' => $scholarship,
        ]);
    }

    public function destroy($id)
    {
        $scholarship = Scholarship::findOrFail($id);
        $scholarship->delete();

        return response()->json([
            'message' => 'Beasiswa berhasil dihapus',
        ]);
    }
}