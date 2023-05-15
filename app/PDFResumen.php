<?php

namespace App;

use Carbon\Carbon;
use Codedge\Fpdf\Fpdf\Fpdf;
use File;
use DateTime;
use Symfony\Component\Console\Logger\ConsoleLogger;

global $numInforme;

class PDFResumen extends FPDF
{

    // Page header
    function Header()
    {
        $this->Image('../public/img/Marca_recuerdame-nobg.png', 150, 8, 50);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 18);
        // Move to the right
        //$this->Cell(80);
        // Title
        $this->Cell(190, 11, 'Resumen de historia de vida', 0, 1);
        $this->Line(10, 25, 200, 25);
        // Line break
        $this->Ln(10);
    }

    function writeResumen($pdf, $resumen)
    {
        $pdf->SetFont('Times', '', 12);
        $pdf->MultiCell(0, 7, iconv('UTF-8', 'windows-1252', $resumen));
        $pdf->Ln(2);
        $H = $pdf->GetY();
    }

    // Page footer
    function Footer()
    {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number   
        $pagina = utf8_decode("Página ");
        $this->Cell(0, 10, $pagina . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }


    function writePatient($pdf, $paciente, $imagen)
    {
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(30, 7, 'Nombre: ', 1, 0, 'L', true);
        $pdf->SetFont('Times', '', 12);
        $s = utf8_decode(' ' . $paciente->nombre . ' ' . $paciente->apellidos);
        $pdf->Cell(160, 7, $s, 1);
        $pdf->Ln(7);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(30, 7, 'Edad: ', 1, 0, 'L', true);
        $pdf->SetFont('Times', '', 12);
        $fecha_nacimiento = new DateTime($paciente->fecha_nacimiento);
        $hoy = new DateTime();
        $edad = $hoy->diff($fecha_nacimiento);
        $pdf->Cell(160, 7, ' ' . $edad->y, 1);
        $pdf->Ln(7);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(30, 7, utf8_decode('Género: '), 1, 0, 'L', true);
        $pdf->SetFont('Times', '', 12);
        if($paciente->genero_id != 3)
            $pdf->Cell(160, 7, ' ' . utf8_decode($paciente->genero->nombre), true);
        else
            $pdf->Cell(160, 7, ' ' . utf8_decode($paciente->genero_custom), true);

        $pdf->Ln(7);
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(30, 50, utf8_decode('Fotografía: '), 1, 0, 'L', true);
        $image = "../public/" . $imagen;
        $pdf->Cell(160, 50, $pdf->Image($image, $pdf->GetX(), $pdf->GetY(), 50, 50), true);

        //+7+7+50

        $pdf->Ln(55);
    }

    function fechaHoy($pdf)
    {

        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");

        $fecha_actual = (Carbon::now());
        $mes = $meses[($fecha_actual->format('n')) - 1];
        $fecha = utf8_decode('Fecha de generación del documento: ');
        $fecha .= $fecha_actual->format('d') . ' de ' . $mes . ' de ' . $fecha_actual->format('Y');
        $pdf->Cell(90, 7, "");
        $pdf->SetTextColor(128, 128, 128);
        $pdf->Cell(160, 7, $fecha);
        $pdf->SetTextColor(0, 0, 0);
        $pdf->Ln(7);
    }

    function pdfBody($pdf, $paciente, $resumen, $imagen)
    {
        //$pdf->Cell(0,10,'Fecha del informe: '.$informeSeguimiento->getFecha(),0,1);
        // Colors, line width and bold font
        $pdf->SetFillColor(220);

        $this->fechaHoy($pdf);

        $pdf->SetFont('Times', 'B', 15);
        $pdf->Cell(0, 7, 'Datos del usuario ');
        $pdf->Ln(9);

        $this->writePatient($pdf, $paciente, $imagen);

        $pdf->SetFont('Times', 'B', 15);
        $pdf->Cell(0, 7, utf8_decode($resumen->titulo));
        $pdf->Ln(9);

        $this->writeResumen($pdf, $resumen->resumen);

        $fecha = Carbon::now();
        $nombreArchivo = str_replace(" ", "_", $paciente->nombre . "_" . $resumen->titulo . ".pdf");
        $nombreArchivo = str_replace("-", "", $nombreArchivo);
        $nombreArchivo = str_replace("__", "_", $nombreArchivo);
        $pdf->Output('I', $nombreArchivo, true);
    }
}
