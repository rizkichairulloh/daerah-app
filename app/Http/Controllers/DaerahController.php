<?php

namespace App\Http\Controllers;

use App\Models\Daerah;
use App\Models\Desa;
use App\Models\Kelompok;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DaerahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $daerahs = Daerah::with('desa', 'kelompok')->get();

        return view('daerah.index', compact('daerahs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $desas = Desa::all();
        $kelompoks = Kelompok::all();

        return view('daerah.create', compact('desas', 'kelompoks'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'name' => 'required',
            'desa_id' => 'required',
            'kelompok_id' => 'required',
            'dapukan' => 'required',
        ]);

        Daerah::create([
            'name'   => $request->name,
            'desa_id'   => $request->desa_id,
            'kelompok_id'   => $request->kelompok_id,
            'dapukan'   => $request->dapukan,
        ]);

        return redirect()->route('daerah.index')->with(['Success' => 'Data Berhasil Disimpan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Daerah $daerah)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Daerah $daerah)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Daerah $daerah)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Daerah $daerah)
    {
        //
    }
}
