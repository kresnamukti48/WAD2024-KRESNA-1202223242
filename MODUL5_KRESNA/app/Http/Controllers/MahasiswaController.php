<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mahasiswa;  
use App\Models\Dosen; 

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $mahasiswa = Mahasiswa::all();
        return view('mahasiswa.list', compact('mahasiswa'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $dosen = Dosen::all();
        return view('mahasiswa.create', compact('dosen'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nim' => 'required|numeric|unique:mahasiswas,nim',
            'nama_mahasiswa' => 'required|string|max:255',
            'email' => 'required|email|unique:mahasiswas,email',
            'jurusan' => 'required|string|max:255',
            'dosen_id' => 'required|exists:dosens,id',
        ]);
        Mahasiswa::create($validatedData);
        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $mahasiswa = Mahasiswa::findorFail($id);
        return view('mahasiswa.show', compact('mahasiswa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $mahasiswa = Mahasiswa::findorFail($id);
        return view('mahasiswa.edit', compact('mahasiswa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nim' => 'required|numeric',
            'nama_mahasiswa' => 'required|string|max:255',
            'email' => 'required|email',
            'jurusan' => 'required|string|max:255',
            'dosen_id' => 'required|exists:dosens,id',
        ]);

        $mahasiswa = Mahasiswa::findorFail($id);
        $mahasiswa->update($validatedData);

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $mahasiswa = Mahasiswa::findorFail($id);
        $mahasiswa->delete();

        return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa berhasil dihapus');
    }
}
