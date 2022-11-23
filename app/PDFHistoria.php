<?php

namespace App;

use Carbon\Carbon;
use Codedge\Fpdf\Fpdf\Fpdf;
use File;
use DateTime;
use Symfony\Component\Console\Logger\ConsoleLogger;

global $numInforme;

class PDFHistoria extends FPDF{

    // Page header
    function Header()
    {
        $this->Image('../public/img/Marca_recuerdame-nobg.png',150,8,50);
        // Arial bold 15
        $this->SetFont('Arial','B',18);
        // Move to the right
        //$this->Cell(80);
        // Title
        $this->Cell(190,11,'Historia de vida',0,1);
        $this->Line(10,25,200,25);
        // Line break
        $this->Ln(10);
    }

    function writeRecuerdos($pdf, $listadoRecuerdos){
        $size = 7*8 +12; //size que ocupa los datos del paciente en primera página
  
        foreach($listadoRecuerdos as $row) {
            $pdf->SetFont('Times','B',12);
            $pdf->Cell(160,7,iconv('UTF-8', 'windows-1252',$row->nombre));
            $fechaFormat = $row->fecha;
            $newDate = date("d/m/Y", strtotime($fechaFormat));
            $pdf->Cell(160,7,$newDate);
            $pdf->Ln(7);
            $size+= 7*3;
            $pdf->SetFont('Times','',12);
            $pdf->MultiCell(0,7,iconv('UTF-8', 'windows-1252', $row->descripcion));
            $pdf->Ln(7);
            $size+= 7*2;
    
            $listaMultimedia = $row->multimedias;
            foreach ($listaMultimedia as $multimedia) {
                
                if($size+35+7 > 279) {
                    $pdf->addPage(); //297 es el alto de un A4, 18 ocupa el footer 287-18=279
                    $size=0;
                }
                $image = "../public/img/" . $multimedia->fichero;
                $pdf->MultiCell(0,35,$pdf->Image($image, $pdf->GetX(), $pdf->GetY(), 40));
                $pdf->Ln(12);
                $size+= 35+12;
            }
        }
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

        
    function writePatient($pdf, $paciente){
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(30,7,'Nombre: ',1,0,'L',true);
        $pdf->SetFont('Times','',12);
        $s = utf8_decode(' ' . $paciente->nombre . ' ' . $paciente->apellidos);
        $pdf->Cell(160,7, $s ,1);
        $pdf->Ln(7);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(30,7,'Edad: ',1,0,'L',true);
        $pdf->SetFont('Times','',12);
        $fecha_nacimiento = new DateTime ($paciente->fecha_nacimiento);
        $hoy = new DateTime();
        $edad = $hoy->diff($fecha_nacimiento);
        $pdf->Cell(160,7,' '.$edad->y,1);
        $pdf->Ln(7);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(30,7,'Genero: ',1,0,'L',true);
        $pdf->SetFont('Times','',12);
        $pdf->Cell(160,7,' '. $paciente->genero->nombre,true);
        $pdf->Ln(12);
    }
    
    function fechaHoy($pdf){ 
        
        $fecha_actual = (Carbon::now());
        $fecha = utf8_decode('Fecha de generación del documento: ' );
        $fecha .= $fecha_actual;
        $pdf->Cell(90,7,"");
        $pdf->SetTextColor( 128 , 128, 128);
        $pdf->Cell(160,7,$fecha);
        $pdf->SetTextColor( 0 , 0, 0);       
        $pdf->Ln(7);
    }

    function pdfBody($pdf,$paciente, $listadoRecuerdos){
        //$pdf->Cell(0,10,'Fecha del informe: '.$informeSeguimiento->getFecha(),0,1);
        // Colors, line width and bold font
        $pdf->SetFillColor(220);

        $this->fechaHoy($pdf);

        $pdf->SetFont('Times','B',15);
        $pdf->Cell(0,7,'Datos del usuario ');
        $pdf->Ln(9);
        
        $this->writePatient($pdf, $paciente);
        
        $pdf->SetFont('Times','B',15);
        $pdf->Cell(0,7,'Recuerdos ');
        $pdf->Ln(9);
       
        $this->writeRecuerdos($pdf, $listadoRecuerdos);
        
    }
}

