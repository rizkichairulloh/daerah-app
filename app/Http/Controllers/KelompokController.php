<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kelompok;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class KelompokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->has('search')) {
            $kelompoks = Kelompok::where('name', 'LIKE', '%' . $request->search . '%')->orderBy("desa_id", "asc")->with('desa')->paginate(7);
        } else {
            $kelompoks = Kelompok::orderBy("desa_id", "asc")->with('desa')->paginate(7);
        }

        // Access the first item of the paginated results
        $firstItem = $kelompoks->firstItem();

        return view('kelompok.index', compact('kelompoks', 'firstItem'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $desas = Desa::all();

        return view('kelompok.create', compact('desas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'desa_id' => 'required',
            'koordinator' => 'required',
        ]);

        $existing = Kelompok::where('name', $request->name)->first();

        if ($existing) {
            // Handle the duplicate entry
            return back()->withError('nama kelompok sudah ada');
        } else {
            // Save or update the record
            //create post
            Kelompok::create([
                'name'   => $request->name,
                'desa_id' => $request->desa_id,
                'koordinator'   => $request->koordinator,
            ]);
        }

        return redirect()->route('kelompok.index')->with('Success', ['Data berhasil ditambahkan!']);
    }

    /**
     * Display the specified resource.
     */
    public function show(Kelompok $kelompok)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kelompok = Kelompok::find($id);

        return view('kelompok.edit', compact('kelompok'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        $this->validate($request, [
            'name' => 'required',
            'desa_id' => 'required',
            'koordinator' => 'required',
        ]);

        $kelompok = Kelompok::find($id);

        $kelompok->update([
            'name' => $request->name,
            'desa_id' => $request->desa_id,
            'koordinator'   => $request->koordinator,
        ]);

        return redirect()->route('kelompok.index')->with('Success', ['Data berhasil diupdate']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id): RedirectResponse
    {
        $kelompok = Kelompok::find($id);

        $kelompok->delete();

        return redirect()->route('kelompok.index')->with('Success', ['Data berhasil dihapus']);
    }
}
