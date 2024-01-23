<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DesaController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Desa::orderBy("name", "asc");
            return DataTables::of($data)
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('desa.index');
    }

    /**
     * Show the form for creating a new resource.
     */

    public function create()
    {
        return view('desa.create');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'name' => 'required',
            'koordinator' => 'required',
        ]);

        $existingRecord = Desa::where('name', $request->name)->first();

        if ($existingRecord) {
            // Handle the duplicate entry
            return back()->withError('nama desa sudah ada');
        } else {
            // Save or update the record
            //create post
            Desa::create([
                'name'   => $request->name,
                'koordinator'   => $request->koordinator,
            ]);
        }

        return redirect()->route('desa.index')->with('success', 'Item created successfully!');
    }

    /**
     * Display the specified resource.
     */

    public function show($id)
    {
    }

    /**
     * Show the form for editing the specified resource.
     */

    public function edit($id)
    {
        $desa = Desa::find($id);

        return view('desa.edit', compact('desa'));
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $id): RedirectResponse
    {
        //validate form
        $this->validate($request, [
            'name' => 'required',
            'koordinator' => 'required',
        ]);

        $desa = Desa::find($id);

        // $existingRecord = Desa::where('name', $request->name)->first();

        // if ($existingRecord) {
        //     // Handle the duplicate entry
        //     return back()->withError('nama desa sudah ada');
        // } else {
        //     // Save or update the record
        //     $desa->update([
        //             'name'   => $request->name
        //         ]
        //     );
        // }

        $desa->update(
            [
                'name'   => $request->name,
                'koordinator'   => $request->koordinator,
            ]
        );

        return redirect()->route('desa.index')->with('success', 'Item updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy($id)
    {
        $desa = Desa::find($id);

        if ($desa->delete()) {
            $response['success'] = 1;
            $response['msg'] = 'Delete successfully';
        } else {
            $response['success'] = 0;
            $response['msg'] = 'Invalid ID.' + $id;
        }

        return response()->json($response);
    }
}
