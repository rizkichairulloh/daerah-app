<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Daerah;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ExportPdfDaerahConttroller extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $desas = Daerah::all();

        view()->share('daerahs', $desas);

        $pdf = Pdf::loadview('daerah.daerah-pdf');

        return $pdf->download('data-daerah.pdf');
    }
}
