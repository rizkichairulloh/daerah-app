<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use App\Models\Kelompok;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class KelompokController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Kelompok::orderBy("desa_id", "asc")->with('desa')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('kelompok.index');
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

        return redirect()->route('kelompok.index')->with('success', 'Item created successfully!');
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

        return redirect()->route('kelompok.index')->with('success', 'Item updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kelompok = Kelompok::find($id);

        if ($kelompok->delete()) {
            $response['success'] = 1;
            $response['msg'] = 'Delete successfully';
        } else {
            $response['success'] = 0;
            $response['msg'] = 'Invalid ID.' + $id;
        }

        return response()->json($response);
    }
}
