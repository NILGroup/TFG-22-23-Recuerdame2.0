<?php

namespace App;

use Carbon\Carbon;
use Codedge\Fpdf\Fpdf\Fpdf;
use File;
use DateTime;

global $fecha;

class PDFEvaluacion extends FPDF{

    // Page header
    function Header()
    {
        $this->Image('../public/img/Marca_recuerdame-nobg.png',150,8,50);
        // Arial bold 15
        $this->SetFont('Arial','B',18);
        // Move to the right
        //$this->Cell(80);
        // Title
        $f = Carbon::create($GLOBALS['fecha']);
        $this->Cell(190,11,'Informe de Seguimiento '.$f->format("d-m-Y"),0,1);
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
        $pagina = utf8_decode("Página ");
        $this->Cell(0,10,$pagina.$this->PageNo().'/{nb}',0,0,'C');
    }

    function writeTest($pdf, $informeSeguimiento){
        $pdf->SetFont('Times','B',12);
        $pdf->SetFillColor(170);
        $pdf->Cell(0,7,'Test realizados al usuario',1,0,'C',true);
        $pdf->Ln();
        $pdf->SetFillColor(220);
        $pdf->Cell(50,7,'Nombre del test',1,0,'C',true);
        $pdf->Cell(70,7,'Fecha de test',1,0,'C',true);
        $pdf->Cell(70,7,'Resutado/valor',1,0,'C',true);
        $pdf->Ln();
        $pdf->SetFont('Times','',12);
        $pdf->Cell(50,7,'GDS ',1);
        $pdf->Cell(70,7,Carbon::parse($informeSeguimiento->gds_fecha)->format('d-m-Y'),1,0,'C');
        $pdf->Cell(70,7,$informeSeguimiento->gds,1,0,'C');
        $pdf->Ln();
        $pdf->Cell(50,7,'Test de Lobo ',1);
        $pdf->Cell(70,7,Carbon::parse($informeSeguimiento->mental_fecha)->format('d-m-Y'),1,0,'C');
        $pdf->Cell(70,7,$informeSeguimiento->mental,1,0,'C');
        $pdf->Ln();
        $pdf->Cell(50,7,'CDR ',1);
        $pdf->Cell(70,7,Carbon::parse($informeSeguimiento->cdr_fecha)->format('d-m-Y'),1,0,'C');
        $pdf->Cell(70,7,$informeSeguimiento->cdr,1,0,'C');
        $pdf->Ln();
        if($informeSeguimiento->nombre_escala != null){
            $pdf->Cell(50,7,utf8_decode($informeSeguimiento->nombre_escala),1);
            $pdf->Cell(70,7,Carbon::parse($informeSeguimiento->fecha_escala)->format('d-m-Y'),1,0,'C');
            $pdf->Cell(70,7,$informeSeguimiento->escala,1,0,'C');
            $pdf->Ln();
        }
        $pdf->Ln(5);
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
        $fecha_nacimiento = new DateTime ($paciente->fecha_nacimiento);
        $hoy = new DateTime();
        $edad = $hoy->diff($fecha_nacimiento);
        $pdf->Cell(160,7,' '.$edad->y,1);
        $pdf->Ln();
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(30,7,'Genero: ',1,0,'L',true);
        $pdf->SetFont('Times','',12);
        $pdf->Cell(160,7,' '. $paciente->genero->nombre,true);
        $pdf->Ln(12);
        
    }
    
    function pdfBody($pdf, $informeSeguimiento, $paciente){
        //$pdf->Cell(0,10,'Fecha del informe: '.$informeSeguimiento->getFecha(),0,1);
        // Colors, line width and bold font
        $pdf->SetFillColor(220);
    
        $pdf->SetFont('Times','B',15);
        $pdf->Cell(0,7,'Datos del usuario ');
        $pdf->Ln(9);
    
        $this->writePatient($pdf, $paciente);
        
        $pdf->SetFont('Times','B',15);
        $pdf->Cell(0,7,'Datos del Informe ');
        $pdf->Ln(9);
    
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(50,7,"Fecha del informe:",1,0,'L',true);
        $pdf->SetFont('Times','',12);

        $meses = array("Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre");
        $fecha_actual = Carbon::parse($informeSeguimiento->fecha);
        $mes = $meses[($fecha_actual->format('n')) - 1];
        $fecha = $fecha_actual->format('d') . ' de ' . $mes . ' de ' . $fecha_actual->format('Y');

        $pdf->Cell(140,7,$fecha,1,0,'C');
        $pdf->Ln(12);
    
        $this->writeTest($pdf, $informeSeguimiento);
    
        $pdf->SetFillColor(170);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(0,7,'Diagnostico',1,0,'L',true);
        $pdf->Ln();
        $pdf->SetFont('Times','',12);
        $pdf->MultiCell(0,7,utf8_decode($informeSeguimiento->diagnostico),1);
        $pdf->Ln();
    
        if($informeSeguimiento->observaciones != null){
            $pdf->SetFont('Times','B',12);
            $pdf->Cell(0,7,'Observaciones',1,0,'L',true);
            $pdf->Ln();
            $pdf->SetFont('Times','',12);
            $pdf->MultiCell(0,7,utf8_decode($informeSeguimiento->observaciones),1);
            $pdf->Ln();
        }
        
        $fecha = Carbon::now();
        $nombreArchivo = str_replace(" ", "_", "Seguimiento ".$paciente->nombre." ".$fecha->format("d-m-Y").".pdf");
        $pdf->Output( 'I', "Seguimiento ".$paciente->nombre." ".$fecha->format("d-m-Y").".pdf", true );
    }
}

