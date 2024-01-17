<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Kelompok;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ExportPdfKelompokConttroller extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $kelompoks = Kelompok::all();

        view()->share('kelompoks', $kelompoks);

        $pdf = Pdf::loadview('kelompok.kelompok-pdf');

        return $pdf->download('data-kelompok.pdf');
    }
}
