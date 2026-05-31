<?php

namespace App\Http\Controllers;

use App\Models\Scholarship;
use Illuminate\Http\Request;

class ScholarshipController extends Controller
{
    public function index(Request $request)
    {
        $query = Scholarship::query();

        if ($request->filled('search')) {
            $query->where('title', 'like', '%' . $request->search . '%')
                ->orWhere('description', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('jenjang')) {
            $query->where('jenjang', $request->jenjang);
        }

        if ($request->filled('semester')) {
            $query->where('semester', $request->semester);
        }

        if ($request->filled('id_major')) {
            $query->where('id_major', $request->id_major);
        }

        $scholarships = $query->latest()->get();

        return response()->json([
            'success' => true,
            'message' => 'Daftar beasiswa berhasil diambil',
            'data' => $scholarships,
        ], 200);
    }

    public function show($id)
    {
        $scholarship = Scholarship::find($id);

        if (!$scholarship) {
            return response()->json([
                'success' => false,
                'message' => 'Beasiswa tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail beasiswa berhasil diambil',
            'data' => $scholarship,
        ], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'provider' => 'nullable|string|max:255',
            'jenjang' => 'nullable|string|max:100',
            'semester' => 'nullable|integer',
            'id_major' => 'nullable|integer',
            'deadline' => 'nullable|date',
            'link' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
        ]);

        $scholarship = Scholarship::create($request->only([
            'title',
            'description',
            'provider',
            'jenjang',
            'semester',
            'id_major',
            'deadline',
            'link',
            'image',
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Beasiswa berhasil ditambahkan',
            'data' => $scholarship,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $scholarship = Scholarship::find($id);

        if (!$scholarship) {
            return response()->json([
                'success' => false,
                'message' => 'Beasiswa tidak ditemukan',
            ], 404);
        }

        $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'provider' => 'nullable|string|max:255',
            'jenjang' => 'nullable|string|max:100',
            'semester' => 'nullable|integer',
            'id_major' => 'nullable|integer',
            'deadline' => 'nullable|date',
            'link' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
        ]);

        $scholarship->update($request->only([
            'title',
            'description',
            'provider',
            'jenjang',
            'semester',
            'id_major',
            'deadline',
            'link',
            'image',
        ]));

        return response()->json([
            'success' => true,
            'message' => 'Beasiswa berhasil diperbarui',
            'data' => $scholarship,
        ], 200);
    }

    public function destroy($id)
    {
        $scholarship = Scholarship::find($id);

        if (!$scholarship) {
            return response()->json([
                'success' => false,
                'message' => 'Beasiswa tidak ditemukan',
            ], 404);
        }

        $scholarship->delete();

        return response()->json([
            'success' => true,
            'message' => 'Beasiswa berhasil dihapus',
        ], 200);
    }
}