<?php

namespace App;

use Carbon\Carbon;
use Codedge\Fpdf\Fpdf\Fpdf;
use File;
use DateTime;
use PDF_LineGraph;

global $fecha;


class PDFDiagnostico extends FPDF
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
        $f = Carbon::create($GLOBALS['fecha']);
        $this->Cell(190, 11, iconv('UTF-8', 'windows-1252', 'Informe de Diagnóstico '), 0, 1);
        $this->Line(10, 25, 200, 25);
        // Line break
        $this->Ln(10);
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

    function writeTest($pdf, $informeSeguimiento)
    {
        $pdf->SetFont('Times', 'B', 12);
        $pdf->SetFillColor(170);
        $pdf->Cell(0, 7, 'Test realizados al usuario', 1, 0, 'C', true);
        $pdf->Ln();
        $pdf->SetFillColor(220);
        $pdf->Cell(50, 7, 'Nombre del test', 1, 0, 'C', true);
        $pdf->Cell(70, 7, 'Fecha de test', 1, 0, 'C', true);
        $pdf->Cell(70, 7, 'Resutado/valor', 1, 0, 'C', true);
        $pdf->Ln();
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(50, 7, 'GDS ', 1);
        $pdf->Cell(70, 7, Carbon::parse($informeSeguimiento->gds_fecha)->format('d-m-Y'), 1, 0, 'C');
        $pdf->Cell(70, 7, $informeSeguimiento->gds, 1, 0, 'C');
        $pdf->Ln();
        $pdf->Cell(50, 7, 'Test de Lobo ', 1);
        $pdf->Cell(70, 7, Carbon::parse($informeSeguimiento->mental_fecha)->format('d-m-Y'), 1, 0, 'C');
        $pdf->Cell(70, 7, $informeSeguimiento->mental, 1, 0, 'C');
        $pdf->Ln();
        $pdf->Cell(50, 7, 'CDR ', 1);
        $pdf->Cell(70, 7, Carbon::parse($informeSeguimiento->cdr_fecha)->format('d-m-Y'), 1, 0, 'C');
        $pdf->Cell(70, 7, $informeSeguimiento->cdr, 1, 0, 'C');
        $pdf->Ln();
        if ($informeSeguimiento->nombre_escala != null) {
            $pdf->Cell(50, 7, utf8_decode($informeSeguimiento->nombre_escala), 1);
            $pdf->Cell(70, 7, Carbon::parse($informeSeguimiento->fecha_escala)->format('d-m-Y'), 1, 0, 'C');
            $pdf->Cell(70, 7, $informeSeguimiento->escala, 1, 0, 'C');
            $pdf->Ln();
        }
        $pdf->Ln(5);
    }

    function writePatient($pdf, $paciente)
    {
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(30, 7, 'Nombre: ', 1, 0, 'L', true);
        $pdf->SetFont('Times', '', 12);
        $s = utf8_decode(' ' . $paciente->nombre . ' ' . $paciente->apellidos);
        $pdf->Cell(160, 7, $s, 1);
        $pdf->Ln();
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(30, 7, 'Edad: ', 1, 0, 'L', true);
        $pdf->SetFont('Times', '', 12);
        $fecha_nacimiento = new DateTime($paciente->fecha_nacimiento);
        $hoy = new DateTime();
        $edad = $hoy->diff($fecha_nacimiento);
        $pdf->Cell(160, 7, ' ' . $edad->y, 1);
        $pdf->Ln();
        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(30, 7, utf8_decode('Género: '), 1, 0, 'L', true);
        $pdf->SetFont('Times', '', 12);
        if($paciente->genero_id != 3)
            $pdf->Cell(160, 7, ' ' . utf8_decode($paciente->genero->nombre), true);
        else
            $pdf->Cell(160, 7, ' ' . utf8_decode($paciente->genero_custom), true);
        $pdf->Ln(12);
    }

    function LineGraph($w, $h, $data, $options='', $colors=null, $maxVal=0, $nbDiv=4){
		/*******************************************
		Explain the variables:
		$w = the width of the diagram
		$h = the height of the diagram
		$data = the data for the diagram in the form of a multidimensional array
		$options = the possible formatting options which include:
			'V' = Print Vertical Divider lines
			'H' = Print Horizontal Divider Lines
			'kB' = Print bounding box around the Key (legend)
			'vB' = Print bounding box around the values under the graph
			'gB' = Print bounding box around the graph
			'dB' = Print bounding box around the entire diagram
		$colors = A multidimensional array containing RGB values
		$maxVal = The Maximum Value for the graph vertically
		$nbDiv = The number of vertical Divisions
		*******************************************/
		$this->SetDrawColor(0,0,0);
		$this->SetLineWidth(0.2);
		$keys = array_keys($data);
		$ordinateWidth = 10;
		$w -= $ordinateWidth;
		$valX = $this->getX()+$ordinateWidth;
		$valY = $this->getY();
		$margin = 1;
		$titleH = 8;
		$titleW = $w;
		$lineh = 5;
		$keyH = count($data)*$lineh;
		$keyW = $w/5;
		$graphValH = 5;
		$graphValW = $w-$keyW-3*$margin;
		$graphH = $h-(3*$margin)-$graphValH;
		$graphW = $w-(2*$margin)-($keyW+$margin);
		$graphX = $valX+$margin;
		$graphY = $valY+$margin;
		$graphValX = $valX+$margin;
		$graphValY = $valY+2*$margin+$graphH;
		$keyX = $valX+(2*$margin)+$graphW;
		$keyY = $valY+$margin+.5*($h-(2*$margin))-.5*($keyH);
		//draw graph frame border
		if(strstr($options,'gB')){
			$this->Rect($valX,$valY,$w,$h);
		}
		//draw graph diagram border
		if(strstr($options,'dB')){
			$this->Rect($valX+$margin,$valY+$margin,$graphW,$graphH);
		}
		//draw key legend border
		if(strstr($options,'kB')){
			$this->Rect($keyX,$keyY,$keyW,$keyH);
		}
		//draw graph value box
		if(strstr($options,'vB')){
			$this->Rect($graphValX,$graphValY,$graphValW,$graphValH);
		}
		//define colors
		if($colors===null){
			$safeColors = array(0,51,102,153,204,225);
			for($i=0;$i<count($data);$i++){
				$colors[$keys[$i]] = array($safeColors[array_rand($safeColors)],$safeColors[array_rand($safeColors)],$safeColors[array_rand($safeColors)]);
			}
		}
		//form an array with all data values from the multi-demensional $data array
		$ValArray = array();
		foreach($data as $key => $value){
			foreach($data[$key] as $val){
				$ValArray[]=$val;					
			}
		}

		//define max value
        if($maxVal<ceil(max($ValArray))){
            $maxVal = ceil(max($ValArray));
        }

		//draw horizontal lines
		$vertDivH = $graphH/$nbDiv;
		if(strstr($options,'H')){
			for($i=0;$i<=$nbDiv;$i++){
				if($i<$nbDiv){
					$this->Line($graphX,$graphY+$i*$vertDivH,$graphX+$graphW,$graphY+$i*$vertDivH);
				} else{
					$this->Line($graphX,$graphY+$graphH,$graphX+$graphW,$graphY+$graphH);
				}
			}
		}
		//draw vertical lines
        $horiDivW = floor($graphW/(count($data[$keys[0]])-1));
		if(strstr($options,'V')){
			for($i=0;$i<=(count($data[$keys[0]])-1);$i++){
				if($i<(count($data[$keys[0]])-1)){
					$this->Line($graphX+$i*$horiDivW,$graphY,$graphX+$i*$horiDivW,$graphY+$graphH);
				} else {
					$this->Line($graphX+$graphW,$graphY,$graphX+$graphW,$graphY+$graphH);
				}
			}
		}
		//draw graph lines
		foreach($data as $key => $value){
			$this->setDrawColor($colors[$key][0],$colors[$key][1],$colors[$key][2]);
			$this->SetLineWidth(0.8);
			$valueKeys = array_keys($value);
            
			for($i=0;$i<count($value);$i++){
                info($value[$valueKeys[$i]]);
				if($i==count($value)-2){
					$this->Line(
						$graphX+($i*$horiDivW),
						$graphY+$graphH-($value[$valueKeys[$i]]/$maxVal*$graphH),
						$graphX+$graphW,
						$graphY+$graphH-($value[$valueKeys[$i+1]]/$maxVal*$graphH)
					);
				} else if($i<(count($value)-1)) {
					$this->Line(
						$graphX+($i*$horiDivW),
						$graphY+$graphH-($value[$valueKeys[$i]]/$maxVal*$graphH),
						$graphX+($i+1)*$horiDivW,
						$graphY+$graphH-($value[$valueKeys[$i+1]]/$maxVal*$graphH)
					);
				}
			}
			//Set the Key (legend)
			$this->SetFont('Courier','',10);
			if(!isset($n))$n=0;
			$this->Line($keyX+1,$keyY+$lineh/2+$n*$lineh,$keyX+8,$keyY+$lineh/2+$n*$lineh);
			$this->SetXY($keyX+8,$keyY+$n*$lineh);
			$this->Cell($keyW,$lineh,$key,0,1,'L');
			$n++;
		}
		//print the abscissa values
		foreach($valueKeys as $key => $value){
			if($key==0){
				$this->SetXY($graphValX,$graphValY);
				$this->Cell(30,$lineh,$value,0,0,'L');
			} else if($key==count($valueKeys)-1){
				$this->SetXY($graphValX+$graphValW-30,$graphValY);
				$this->Cell(30,$lineh,$value,0,0,'R');
			} else {
				$this->SetXY($graphValX+$key*$horiDivW-15,$graphValY);
				$this->Cell(30,$lineh,$value,0,0,'C');
			}
		}
		//print the ordinate values
		for($i=0;$i<=$nbDiv;$i++){
			$this->SetXY($graphValX-10,$graphY+($nbDiv-$i)*$vertDivH-3);
			$this->Cell(8,6,sprintf('%.1f',$maxVal/$nbDiv*$i),0,0,'R');
		}
		$this->SetDrawColor(0,0,0);
		$this->SetLineWidth(0.2);
	}

    function writeEvolucion($pdf, $diagnostico, $gds, $mini, $cdr)
    {
        $pdf->SetFont('Times', 'B', 15);
        $pdf->Cell(0, 7, utf8_decode('Evolución'));
        $pdf->Ln(9);
             
        $data = $gds;
      
        $colors = array(
            'GDS' => array(255, 0, 0),
            'Mini mental' => array(0, 255, 0),
            'CDR' => array(0, 0, 255)
        );
        
       
        // Display options: all (horizontal and vertical lines, 4 bounding boxes)
        // Colors: fixed
        // Max ordinate: 6
        // Number of divisions: 3
        $pdf->LineGraph(190,100,$data,'VHkBvBgBdB',$colors);        
    }

    function pdfBody($pdf, $diagnostico, $paciente, $gds, $mini, $cdr)
    {
        //$pdf->Cell(0,10,'Fecha del informe: '.$informeSeguimiento->getFecha(),0,1);
        // Colors, line width and bold font
        $pdf->SetFillColor(220);

        $pdf->SetFont('Times', 'B', 15);
        $pdf->Cell(0, 7, 'Datos del usuario ');
        $pdf->Ln(9);

        $this->writePatient($pdf, $paciente);

        $pdf->SetFont('Times', 'B', 15);
        $pdf->Cell(0, 7, 'Datos del Informe ');
        $pdf->Ln(9);

        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(50, 7, "Fecha del informe:", 1, 0, 'L', true);
        $pdf->SetFont('Times', '', 12);
        $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
        $fecha_actual = Carbon::parse($diagnostico->fecha);
        $mes = $meses[($fecha_actual->format('n')) - 1];
        $fecha = $fecha_actual->format('d') . ' de ' . $mes . ' de ' . $fecha_actual->format('Y');
        $pdf->Cell(140, 7, $fecha, 1, 0, 'C');
        $pdf->Ln();

        $pdf->SetFont('Times', 'B', 12);
        $pdf->Cell(50, 7, "Enfermedad:", 1, 0, 'L', true);
        $pdf->SetFont('Times', '', 12);
        $pdf->Cell(140, 7, iconv('UTF-8', 'windows-1252', $diagnostico->enfermedad), 1, 0, 'C');
        $pdf->Ln(14);

        if ($diagnostico->antecedentes != null) {
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'Antecedentes', 1, 0, 'L', true);
            $pdf->Ln();
            $pdf->SetFont('Times', '', 12);
            $pdf->MultiCell(0, 7, utf8_decode($diagnostico->antecedentes), 1);
            $pdf->Ln();
        }
        if ($diagnostico->observaciones != null) {
            $pdf->SetFont('Times', 'B', 12);
            $pdf->Cell(0, 7, 'Observaciones', 1, 0, 'L', true);
            $pdf->Ln();
            $pdf->SetFont('Times', '', 12);
            $pdf->MultiCell(0, 7, utf8_decode($diagnostico->observaciones), 1);
            $pdf->Ln();
        }


        $this->writeTest($pdf, $diagnostico);

        $H = $pdf->GetY();

        if($H > 240-75){
            $pdf->addPage(); //297 es el alto de un A4, 18 ocupa el footer 287-18=279
            $H = $pdf->GetY();
        }
        $this->writeEvolucion($pdf, $diagnostico, $gds, $mini, $cdr);

        $fecha = Carbon::now();
        $nombreArchivo = str_replace(" ", "_", "Diagnostico " . $paciente->nombre . " " . $fecha->format("d/m/Y") . ".pdf");
        $pdf->Output('I', $nombreArchivo, true);
    }
}
