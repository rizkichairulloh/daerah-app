<?php

namespace App\Http\Controllers;

use App\Models\Daerah;
use App\Models\Desa;
use App\Models\Kelompok;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DaerahController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Daerah::orderBy("desa_id", "asc")->with('desa', 'kelompok')->get();
            return DataTables::of($data)
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('daerah.index');
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

        return redirect()->route('daerah.index')->with('success', 'Item created successfully!');
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
    public function destroy($id)
    {
        $daerah = Daerah::find($id);

        if ($daerah->delete()) {
            $response['success'] = 1;
            $response['msg'] = 'Delete successfully';
        } else {
            $response['success'] = 0;
            $response['msg'] = 'Invalid ID.' + $id;
        }

        return response()->json($response);
    }
}
