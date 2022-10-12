<?php

namespace App\Http\Controllers;
use App\Models\Sesion;

use Illuminate\Http\Request;
use App\PDF;

class PDFController extends Controller
{
    public function generarPDFInformeSesion(Request $request){
        $sesion = Sesion::find($request->id);
    
        $paciente = $sesion->paciente;
        
        $usuario = $sesion->user_id;
    
        $pdf = new PDF();
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times','',12);
    
        pdfBody($pdf, $paciente, $sesion, $usuario);
    
        $pdf->Output();
    }
}
