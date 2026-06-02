<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use Illuminate\Http\Request;

class ScholarshipController extends Controller
{
    public function index(Request $request)
    {
        $query = Scholarship::with(['educationLevel', 'admin']);

        if ($request->search) {
            $query->where('nama_beasiswa', 'like', '%' . $request->search . '%')
                  ->orWhere('penyelenggara', 'like', '%' . $request->search . '%')
                  ->orWhere('deskripsi', 'like', '%' . $request->search . '%');
        }

        if ($request->semester) {
            $query->where('semester_min', '<=', $request->semester)
                  ->where('semester_max', '>=', $request->semester);
        }

        if ($request->id_level) {
            $query->where('id_level', $request->id_level);
        }

        return response()->json([
            'message' => 'Data beasiswa berhasil diambil',
            'data' => $query->get()
        ]);
    }

    public function show($id)
    {
        $scholarship = Scholarship::with(['educationLevel', 'admin'])
            ->findOrFail($id);

        return response()->json([
            'message' => 'Detail beasiswa berhasil diambil',
            'data' => $scholarship
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'id_level' => 'required|exists:education_levels,id_level',
            'nama_beasiswa' => 'required|string|max:255',
            'penyelenggara' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'persyaratan' => 'required|string',
            'semester_min' => 'required|integer',
            'semester_max' => 'required|integer',
            'deadline' => 'required|date',
            'link_pendaftaran' => 'required|string',
            'status' => 'required|string',
        ]);

        $data['id_admin'] = $request->user()->id_user;

        $scholarship = Scholarship::create($data);

        return response()->json([
            'message' => 'Beasiswa berhasil ditambahkan',
            'data' => $scholarship
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $scholarship = Scholarship::findOrFail($id);

        $data = $request->validate([
            'id_level' => 'required|exists:education_levels,id_level',
            'nama_beasiswa' => 'required|string|max:255',
            'penyelenggara' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'persyaratan' => 'required|string',
            'semester_min' => 'required|integer',
            'semester_max' => 'required|integer',
            'deadline' => 'required|date',
            'link_pendaftaran' => 'required|string',
            'status' => 'required|string',
        ]);

        $scholarship->update($data);

        return response()->json([
            'message' => 'Beasiswa berhasil diupdate',
            'data' => $scholarship
        ]);
    }

    public function destroy($id)
    {
        $scholarship = Scholarship::findOrFail($id);
        $scholarship->delete();

        return response()->json([
            'message' => 'Beasiswa berhasil dihapus'
        ]);
    }
}