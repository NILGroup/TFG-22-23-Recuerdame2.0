<?php

namespace App;

use Codedge\Fpdf\Fpdf\Fpdf;
use File;
use DateTime;

global $fecha;

class PDFSesion extends FPDF{
    // Page header
    function Header()
    {
        $this->Image('../public/img/Marca_recuerdame-nobg.png',150,8,50);
        // Arial bold 15
        $this->SetFont('Arial','B',18);
        // Move to the right
        //$this->Cell(80);
        // Title
        $this->Cell(190,11,utf8_decode('Informe de Sesión'),0,1);
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
    
    function writePatient($pdf, $paciente){
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(50,7,'Nombre: ',1,0,'L',true);
        $pdf->SetFont('Times','',12);
        $s = utf8_decode(' ' . $paciente->nombre . ' ' . $paciente->apellidos);
        $pdf->Cell(140,7, $s,1,0);
        $pdf->Ln();
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(50,7,'Edad: ',1,0,'L',true);
        $pdf->SetFont('Times','',12);
        $fecha_nacimiento = new DateTime ($paciente->fecha_nacimiento);
        $hoy = new DateTime();
        $edad = $hoy->diff($fecha_nacimiento);
        $pdf->Cell(140,7,' ' .  $edad->y,1,0);
        $pdf->Ln();
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(50,7,utf8_decode('Género: '),1,0,'L',true);
        $pdf->SetFont('Times','',12);
        if($paciente->genero_id != 3)
            $pdf->Cell(160, 7, ' ' . utf8_decode($paciente->genero->nombre), true);
        else
            $pdf->Cell(160, 7, ' ' . utf8_decode($paciente->genero_custom), true);
        $pdf->Ln(12);
    }

    function writeTerapeuta($pdf, $usuario){
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(50,7,"Terapeuta:",1,0,'L',true);
        $pdf->SetFont('Times','',12);
        $nombreCompleto = utf8_decode($usuario->nombre . " " . $usuario->apellidos);
        $pdf->Cell(140,7, ' ' . $nombreCompleto,1,0);
        $pdf->Ln();
    }

    function writeSesion($pdf, $sesion){

        $pdf->SetFont('Times','B',12);
        $pdf->Cell(50,7,utf8_decode("Fecha de la sesión:"),1,0,'L',true);
        $pdf->SetFont('Times','',12);
        $pdf->Cell(140,7, ' ' .\Carbon\Carbon::parse($sesion->fecha)->format("d-m-Y h:i"),1,0);
        $pdf->Ln();
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(50,7,utf8_decode("Duración:"),1,0,'L',true);
        $pdf->SetFont('Times','',12);
        $pdf->Cell(140,7,' ' . $sesion->duracion,1,0);
        $pdf->Ln(12);

        $pdf->SetFillColor(170);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(0,7,utf8_decode('Título'),1,0,'L',true);
        $pdf->Ln();
        $pdf->SetFont('Times','',12);
        $pdf->MultiCell(0,7,' ' .utf8_decode($sesion->titulo),1);
        $pdf->Ln();

        $pdf->SetFillColor(170);
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(0,7,'Objetivo',1,0,'L',true);
        $pdf->Ln();
        $pdf->SetFont('Times','',12);
        $pdf->MultiCell(0,7,' ' .utf8_decode($sesion->objetivo),1);
        $pdf->Ln();

        if(!empty($sesion->descripcion)){
            $pdf->SetFillColor(170);
            $pdf->SetFont('Times','B',12);
            $pdf->Cell(0,7,utf8_decode('Descripción'),1,0,'L',true);
            $pdf->Ln();
            $pdf->SetFont('Times','',12);
            $pdf->MultiCell(0,7,' ' .utf8_decode($sesion->descripcion),1);
            $pdf->Ln();
        }

    }

    function writeInformeSesion($pdf, $informeSesion){
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(50,7,utf8_decode("Fecha de finalización:"),1,0,'L',true);
        $pdf->SetFont('Times','',12);
        $pdf->Cell(140,7,' ' . \Carbon\Carbon::parse($informeSesion->fecha_finalizada)->format("d-m-Y h:i"),1,0);
        $pdf->Ln();
        $pdf->SetFillColor(170);
        $pdf->SetFont('Times','B',12);
        
        if(!is_null($informeSesion->participacion)){
            $pdf->SetFont('Times','B',12);
            $pdf->Cell(50,7,utf8_decode("Nivel de participación:"),1,0,'L',true);
            $pdf->SetFont('Times','',12);
            $pdf->Cell(140,7,' ' . $informeSesion->participacion->nombre,1,0);
            $pdf->Ln();
        }

        if(!is_null($informeSesion->complejidad)){
            $pdf->SetFont('Times','B',12);
            $pdf->Cell(50,7,utf8_decode("Nivel de complejidad:"),1,0,'L',true);
            $pdf->SetFont('Times','',12);
            $pdf->Cell(140,7, ' ' .$informeSesion->complejidad->nombre,1,0);
            $pdf->Ln(12);
        }
        $pdf->SetFont('Times','B',12);
        $pdf->Cell(0,7,'Respuesta',1,0,'L',true);
        $pdf->Ln();
        $pdf->SetFont('Times','',12);
        $pdf->MultiCell(0,7,' ' .utf8_decode($informeSesion->respuesta),1);
        $pdf->Ln();

        if(!empty($informeSesion->observaciones)){
            $pdf->SetFont('Times','B',12);
            $pdf->Cell(0,7,'Observaciones',1,0,'L',true);
            $pdf->Ln();
            $pdf->SetFont('Times','',12);
            $pdf->MultiCell(0,7,' ' .utf8_decode($informeSesion->observaciones),1);
            $pdf->Ln();
        }

        if(!is_null($informeSesion->barreras)){
            $pdf->SetFont('Times','B',12);
            $pdf->Cell(0,7,'Barreras',1,0,'L',true);
            $pdf->Ln();
            $pdf->SetFont('Times','',12);
            $pdf->MultiCell(0,7,' ' .utf8_decode($informeSesion->barreras),1);
            $pdf->Ln();
        }

        if(!is_null($informeSesion->facilitadores)){
            $pdf->SetFont('Times','B',12);
            $pdf->Cell(0,7,'Facilitadores',1,0,'L',true);
            $pdf->Ln();
            $pdf->SetFont('Times','',12);
            $pdf->MultiCell(0,7,' ' .utf8_decode($informeSesion->facilitadores),1);
            $pdf->Ln();
        }

        if(!empty($informeSesion->propuestas)){
            $pdf->SetFont('Times','B',12);
            $pdf->Cell(0,7,'Propuestas de mejora',1,0,'L',true);
            $pdf->Ln();
            $pdf->SetFont('Times','',12);
            $pdf->MultiCell(0,7,' ' .utf8_decode($informeSesion->propuestas),1);
            $pdf->Ln();
        }
    }

    function writeSign($pdf){
        
        $H = $pdf->GetY();
        if($H > 260-10){
            $pdf->addPage(); //297 es el alto de un A4, 18 ocupa el footer 287-18=279
            $H = $pdf->GetY();
        }

        // Go to 1.5 cm from bottom
        $this->SetY(-60);

        $pdf->Cell(50,35,$pdf->Image("img/FDOWhite.png", $pdf->GetX(), $pdf->GetY(), 75,50),0,0,'C');
    }

    function pdfBody($pdf, $paciente, $sesion, $informe, $usuario){
        $pdf->SetFillColor(220);

        $pdf->SetFont('Times','B',15);
        $pdf->Cell(0,7,'Datos del usuario ');
        $pdf->Ln(9);

        $this->writePatient($pdf, $paciente);

        $pdf->SetFont('Times','B',15);
        $pdf->Cell(0,7,utf8_decode('Datos de la sesión '));
        $pdf->Ln(9);

        $this->writeTerapeuta($pdf,$usuario);
        $this->writeSesion($pdf,$sesion);

        $pdf->SetFont('Times','B',15);
        $pdf->Cell(0,7,utf8_decode('Informe de la sesión '));
        $pdf->Ln(9);

        $this->writeInformeSesion($pdf,$informe);
        $pdf->Ln(9);

        $this->writeSign($pdf);
        $nombreArchivo = str_replace(" ", "_",  "Sesion_".$paciente->nombre."_".$sesion->titulo.".pdf");
        $pdf->Output( 'I', $nombreArchivo, true );
    }

}