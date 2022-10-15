<?php

namespace App\Http\Controllers;
use App\Models\Sesion;
use App\Models\Evaluacion;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\PDFSesion;
use App\PDFEvaluacion;

class PDFController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role', 'isTerapeuta']);
    }
    /***********************************************************
     * PDFs INFORME DE SESIÓN
    ************************************************************/
    public function generarPDFInformeSesion(Request $request){
        
        $sesion = Sesion::find($request->id);
    
        $paciente = $sesion->paciente;
        
        $usuario = $sesion->user;
        
        $this->obtenerPDFSesion($paciente, $sesion, $usuario);
    }

    public function verInformeSesion($idPaciente, $idSesion){
        $sesion = Sesion::find($idSesion);
    
        $paciente = $sesion->paciente;
        
        $usuario = $sesion->user;

        $this->obtenerPDFSesion($paciente, $sesion, $usuario);
    }

    public function obtenerPDFSesion($paciente, $sesion, $usuario){
        $GLOBALS['numInforme'] = $sesion->id;
        $pdf = new PDFSesion( 'P', 'mm', 'A4' );
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times','',12);
    
        $pdf->pdfBody($pdf, $paciente, $sesion, $usuario);
    
        $pdf->Output();
    }
    
    /***********************************************************
     * PDFs INFORME DE SEGUIMIENTO
    ************************************************************/
    public function generarPDFInformeEvaluacion(Request $request){
        
        $evaluacion = Evaluacion::find($request->id);
    
        $paciente = $evaluacion->paciente;
        
        $this->obtenerPDFEvaluacion($paciente, $evaluacion);
    }

    public function verInformeEvaluacion($idPaciente, $idEvaluacion){
        $evaluacion = Evaluacion::find($idEvaluacion);
    
        $paciente = $evaluacion->paciente;
        $this->obtenerPDFEvaluacion($paciente, $evaluacion);
    }

    public function obtenerPDFEvaluacion($paciente, $evaluacion){
        $GLOBALS['numInforme'] = $evaluacion->id;
        $pdf = new PDFEvaluacion( 'P', 'mm', 'A4' );
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times','',12);
    
        $pdf->pdfBody($pdf, $evaluacion, $paciente);
    
        $pdf->Output();
    }
    
}