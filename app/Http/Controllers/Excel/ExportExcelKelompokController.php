<?php

namespace App\Http\Controllers\Excel;

use App\Exports\KelompoksExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportExcelKelompokController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return Excel::download(new KelompoksExport, 'data-kelompok.xlsx');
    }
}
