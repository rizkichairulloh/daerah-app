<?php

namespace App\Http\Controllers;

use App\Models\Desa;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class DesaController extends Controller {
    /**
    * Display a listing of the resource.
    */

    public function index() {
        $desas = Desa::all();
        return view( 'desa.index', compact('desas') );
    }

    /**
    * Show the form for creating a new resource.
    */

    public function create() {
        return view( 'desa.create' );
    }

    /**
    * Store a newly created resource in storage.
    */

    public function store( Request $request ): RedirectResponse {
        //validate form
        $this->validate( $request, [
            'name' => 'required'
        ] );

        $existingRecord = Desa::where( 'name', $request->name )->first();

        if ( $existingRecord ) {
            // Handle the duplicate entry
            return back()->withError( 'nama desa sudah ada' );
        } else {
            // Save or update the record
            //create post
            Desa::create( [
                'name'   => $request->name
            ] );
        }

        return redirect()->route( 'desa.index' )->with( [ 'success' => 'Data Berhasil Disimpan!' ] );
    }

    /**
    * Display the specified resource.
    */

    public function show( Desa $desa ) {
        //
    }

    /**
    * Show the form for editing the specified resource.
    */

    public function edit( Desa $desa ) {
        //
    }

    /**
    * Update the specified resource in storage.
    */

    public function update( Request $request, Desa $desa ) {
        //
    }

    /**
    * Remove the specified resource from storage.
    */

    public function destroy( $id ): RedirectResponse {
        $desa = Desa::find($id);
        
        $desa->delete();

        return redirect()->route('desa.index')->with("success", ["Data berhasil dihapus"]);
    }
}