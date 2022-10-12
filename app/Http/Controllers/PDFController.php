<?php

namespace App\Http\Controllers;
use App\Models\Sesion;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\PDF;

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
    
    public function generarPDFInformeSesion(Request $request){
        /*
        $pdf = new PDF( 'P', 'mm', 'A4' );
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(40,10,utf8_decode('¡Hola, Mundo!'));
        $pdf->Output();
        exit;
        */
        
        $sesion = Sesion::find($request->id);
    
        $paciente = $sesion->paciente;
        
        $usuario = $sesion->user;
    
        $pdf = new PDF( 'P', 'mm', 'A4' );
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times','',12);
    
        pdfBody($pdf, $paciente, $sesion, $usuario);
    
        $pdf->Output();
    }

    public function obtenerPDF($idPaciente, $idSesion){
        $request = ['id'=> $idPaciente];
        generarPDFInformeSesion($request);
    }

}

function pdfBody($pdf, $paciente, $sesion, $usuario){
    
    $pdf->SetFillColor(220);

    $pdf->SetFont('Times','B',15);
    $pdf->Cell(0,7,'Datos del usuario ');
    $pdf->Ln(9);

    writePatient($pdf, $paciente);

    $pdf->SetFont('Times','B',15);
    $pdf->Cell(0,7,utf8_decode('Datos de la sesión '));
    $pdf->Ln(9);

    writeTerapeuta($pdf,$usuario);

    writeSesion($pdf,$sesion);

    $pdf->SetFont('Times','B',15);
    $pdf->Cell(0,7,utf8_decode('Informe de la sesión '));
    $pdf->Ln(9);

    writeInformeSesion($pdf,$sesion);
}

function writePatient($pdf, $paciente){
    $pdf->SetFont('Times','B',12);
    $pdf->Cell(30,7,'Nombre: ',1,0,'L',true);
    $pdf->SetFont('Times','',12);
    $s = utf8_decode(' ' . $paciente->nombre . ' ' . $paciente->apellidos);
    $pdf->Cell(160,7, $s ,1);
    $pdf->Ln();
    $pdf->SetFont('Times','B',12);
    $pdf->Cell(30,7,'Edad: ',1,0,'L',true);
    $pdf->SetFont('Times','',12);
    $pdf->Cell(160,7,' 87',1);
    $pdf->Ln();
    $pdf->SetFont('Times','B',12);
    $pdf->Cell(30,7,utf8_decode('Género: '),1,0,'L',true);
    $pdf->SetFont('Times','',12);
    if($paciente->genero == 'H'){
        $pdf->Cell(160,7,' '. 'Hombre',1);
    }
    else{
        $pdf->Cell(160,7,' '. 'Mujer',1);
    }
    $pdf->Ln(12);
}

function writeTerapeuta($pdf, $usuario){
    $pdf->SetFont('Times','B',12);
    $pdf->Cell(50,7,"Terapeuta:",1,0,'L',true);
    $pdf->SetFont('Times','',12);
    $nombreCompleto = utf8_decode($usuario->nombre . " " . $usuario->apellidos);
    $pdf->Cell(140,7,  $nombreCompleto,1,0,'C');
    $pdf->Ln();
}

function writeSesion($pdf, $sesion){

    $pdf->SetFont('Times','B',12);
    $pdf->Cell(50,7,utf8_decode("Fecha de la sesión:"),1,0,'L',true);
    $pdf->SetFont('Times','',12);
    $pdf->Cell(140,7,$sesion->fecha,1,0,'C');
    $pdf->Ln(12);

    $pdf->SetFillColor(170);
    $pdf->SetFont('Times','B',12);
    $pdf->Cell(0,7,'Objetivo',1,0,'L',true);
    $pdf->Ln();
    $pdf->SetFont('Times','',12);
    $pdf->MultiCell(0,7,utf8_decode($sesion->objetivo),1);
    $pdf->Ln();

    $pdf->SetFillColor(170);
    $pdf->SetFont('Times','B',12);
    $pdf->Cell(0,7,utf8_decode('Descripción'),1,0,'L',true);
    $pdf->Ln();
    $pdf->SetFont('Times','',12);
    $pdf->MultiCell(0,7,utf8_decode($sesion->descripcion),1);
    $pdf->Ln();

    if($sesion->facilitadores != null){
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(0,7,'Facilitadores',1,0,'L',true);
        $pdf->Ln();
        $pdf->SetFont('Times','',12);
        $pdf->MultiCell(0,7,utf8_decode($sesion->facilitadores),1);
        $pdf->Ln();
    }

    if($sesion->barreras != null){
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(0,7,'Barreras',1,0,'L',true);
        $pdf->Ln();
        $pdf->SetFont('Times','',12);
        $pdf->MultiCell(0,7,utf8_decode($sesion->barreras),1);
        $pdf->Ln();
    }

}

function writeInformeSesion($pdf, $informeSesion){
    $pdf->SetFont('Times','B',12);
    $pdf->Cell(50,7,utf8_decode("Fecha de finalización:"),1,0,'L',true);
    $pdf->SetFont('Times','',12);
    $pdf->Cell(140,7,$informeSesion->fecha_finalizada,1,0,'C');
    $pdf->Ln(12);

    $pdf->SetFillColor(170);
    $pdf->SetFont('Times','B',12);
    $pdf->Cell(0,7,'Respuesta',1,0,'L',true);
    $pdf->Ln();
    $pdf->SetFont('Times','',12);
    $pdf->MultiCell(0,7,utf8_decode($informeSesion->respuesta),1);
    $pdf->Ln();
    
    if(!empty($informeSesion->observaciones)){
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(0,7,'Observaciones',1,0,'L',true);
        $pdf->Ln();
        $pdf->SetFont('Times','',12);
        $pdf->MultiCell(0,7,utf8_decode($informeSesion->observaciones),1);
        $pdf->Ln();
    }

}
