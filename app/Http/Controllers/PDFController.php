<?php

namespace App\Http\Controllers;

use App\Models\Diagnostico;
use App\Models\Sesion;
use App\Models\Evaluacion;
use App\Models\Paciente;
use App\Models\Recuerdo;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\PDFSesion;
use App\PDFEvaluacion;
use App\PDFHistoria;
use App\PDFDiagnostico;

use function PHPUnit\Framework\isNull;

class PDFController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'role', 'asignarPaciente']);
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
        $GLOBALS['titulo'] = $sesion->titulo;
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
        $GLOBALS['fecha'] = $evaluacion->fecha;
        $pdf = new PDFEvaluacion( 'P', 'mm', 'A4' );
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times','',12);
    
        $pdf->pdfBody($pdf, $evaluacion, $paciente);
    
        $pdf->Output();
    }

        /***********************************************************
     * PDFs HISTORIA
    ************************************************************/
    public function generarPDFHistoria(Request $request){
        $paciente = Paciente::find($request->paciente_id);
        $listadoRecuerdos = Recuerdo::where('paciente_id', $request->paciente_id)->get();

        $idEtapa = $request->idEtapa;
        $idCategoria = $request->idCategoria;
        $idEtiqueta = $request->idEtiqueta;
        $fechaInicio = $request->fechaInicio;
        $fechaFin = $request->fechaFin;
        $imagen = $paciente->multimedia;
        $listafinal=collect();

        if(empty($imagen)){
            if($paciente->genero_id==1){ //hombre
                $imagen = "/img/avatar_hombre.png";
            }else{
                $imagen = "/img/avatar_mujer.png";
            }
        }else{
            $imagen = $paciente->multimedia->fichero;
        }
        
        if (!empty($idCategoria))
            $listadoRecuerdos = $listadoRecuerdos->where('categoria_id', $idCategoria);
        if (!empty($idEtapa))
            $listadoRecuerdos = $listadoRecuerdos->where('etapa_id', $idEtapa);
        if (!empty($idEtiqueta))
            $listadoRecuerdos = $listadoRecuerdos->where('etiqueta_id', $idEtiqueta);
        if (!empty($fechaInicio)){
            foreach ($listadoRecuerdos as $recuerdo) {
                if($recuerdo->fecha  >= $fechaInicio){
                    $listafinal= $listafinal->prepend($recuerdo);
                }
            }
            $listadoRecuerdos=  $listafinal->reverse();
            $listafinal=collect();
        }
        if (!empty($fechaFin)){
            foreach ($listadoRecuerdos as $recuerdo) {
                if($recuerdo->fecha  <= $fechaFin){
                    $listafinal= $listafinal->prepend($recuerdo);
                }
            }
            $listadoRecuerdos=  $listafinal->reverse();
            $listafinal=collect();
        }

        //return $listadoRecuerdos;
        $this->obtenerPDFHistoria($paciente, $listadoRecuerdos,$imagen);
    }

    public function obtenerPDFHistoria($paciente, $listadoRecuerdos,$imagen){
        $GLOBALS['numInforme'] = "1";
        $pdf = new PDFHistoria( 'P', 'mm', 'A4' );
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times','',12);
    
        $pdf->pdfBody($pdf, $paciente, $listadoRecuerdos, $imagen);
    
        $pdf->Output();
    }

     /**************
      * PDF DIAGNOSTICO
      */
    
      public function verInformeDiagnostico($idPaciente){
        $diagnostico = Diagnostico::find($idPaciente);
    
        $paciente = $diagnostico->paciente;
        $this->obtenerPDFDiagnostico($paciente, $diagnostico);
    }

    public function obtenerPDFDiagnostico($paciente, $diagnostico){
        $GLOBALS['fecha'] = $diagnostico->fecha;
        $pdf = new PDFDiagnostico( 'P', 'mm', 'A4' );
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times','',12);
    
        $pdf->pdfBody($pdf, $diagnostico, $paciente);
    
        $pdf->Output();
    }

}