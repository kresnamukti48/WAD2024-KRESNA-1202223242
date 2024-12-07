<?php

namespace App\Http\Controllers;
use App\Models\Dosen;

use Illuminate\Http\Request;

class DosenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dosen = Dosen::all();
        return view('dosen.list', compact('dosen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dosen.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'kode_dosen' => 'required|unique:dosens,kode_dosen|size:3',
            'nama_dosen' => 'required|string|max:255',
            'nip' => 'required|numeric|unique:dosens,nip',
            'email' => 'required|email|unique:dosens,email',
            'no_telepon' => 'required|numeric',
        ]);

        Dosen::create($validatedData);
        
    
        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $dosen = Dosen::findorFail($id);
        return view('dosen.show', compact('dosen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $dosen = Dosen::findorFail($id);
        return view('dosen.edit', compact('dosen'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'kode_dosen' => 'required|size:3',
            'nama_dosen' => 'required|string|max:255',
            'nip' => 'required|numeric|',
            'email' => 'required|email|',
            'no_telepon' => 'required|numeric',
        ]);

        $dosen = Dosen::findorFail($id);
        $dosen->update($validatedData);
        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $dosen = Dosen::findorFail($id);
        $dosen->delete();
        return redirect()->route('dosen.index')->with('success', 'Dosen berhasil dihapus');
    }
}
