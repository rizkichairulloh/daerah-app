<?php

namespace App\Http\Controllers\Excel;

use App\Http\Controllers\Controller;
use App\Imports\DesaImport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcelDesaController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $file = $request->file('upload-file');

        $nameFile = $file->getClientOriginalName();
        
        $file->move('DataDesa', $nameFile);

        Excel::import(new DesaImport, public_path('/DataDesa/' . $nameFile));

        return redirect()->route('desa.index');
    }
}
