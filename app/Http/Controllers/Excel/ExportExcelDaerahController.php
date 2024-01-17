<?php

namespace App\Http\Controllers\Excel;

use App\Exports\DaerahsExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ExportExcelDaerahController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        return Excel::download(new DaerahsExport, 'data-pengurus-klaten-utara.xlsx');
    }
}
