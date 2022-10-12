<?php

namespace App;

use Codedge\Fpdf\Fpdf\Fpdf;
use File;

class PDF extends FPDF{
    private $numInforme;
/*
    function __construct($id) {
        $this->numInforme = $id;
    }
*/
    function LoadData($num){
        // Read file lines
        //$this->numInforme = $num;
    }

    // Page header
    function Header()
    {
        $this->Image('../public/img/Marca_recuerdame.png',150,8,50);
        // Arial bold 15
        $this->SetFont('Arial','B',18);
        // Move to the right
        //$this->Cell(80);
        // Title
        $this->Cell(190,11,utf8_decode('Informe de Sesión #'. $this->numInforme),0,1);
        $this->Line(10,25,200,25);
        // Line break
        $this->Ln(10);
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Page number
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }
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