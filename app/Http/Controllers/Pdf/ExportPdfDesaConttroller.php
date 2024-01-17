<?php

namespace App\Http\Controllers\Pdf;

use App\Http\Controllers\Controller;
use App\Models\Desa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ExportPdfDesaConttroller extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request)
    {
        $desas = Desa::all();

        view()->share('desas', $desas);

        $pdf = Pdf::loadview('desa.desa-pdf');

        return $pdf->download('data-desa.pdf');
    }
}
