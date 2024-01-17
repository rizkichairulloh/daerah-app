<?php

namespace App\Http\Controllers\Excel;

use App\Http\Controllers\Controller;
use App\Imports\DaerahImport;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ImportExcelDaerahController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): RedirectResponse
    {
        $file = $request->file('upload-file');

        $nameFile = $file->getClientOriginalName();
        
        $file->move('DataDaerah', $nameFile);

        Excel::import(new DaerahImport, public_path('/DataDaerah/' . $nameFile));

        return redirect()->route('daerah.index');
    }
}
