<?php

namespace App\Http\Controllers;

use App\Models\Diagnostico;
use App\Models\Sesion;
use App\Models\InformeSesion;
use App\Models\Evaluacion;
use App\Models\Paciente;
use App\Models\Recuerdo;
use App\Models\Resumen;
use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\PDFSesion;
use App\PDFEvaluacion;
use App\PDFHistoria;
use App\PDFDiagnostico;
use App\PDFResumen;
use Carbon\Carbon;
use Illuminate\Support\Arr;

use function PHPUnit\Framework\isNan;
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
    public function generarPDFInformeSesion(Request $request)
    {

        $informe = InformeSesion::find($request->id);
        $sesion = $informe->sesion;
        $paciente = $informe->paciente;

        $usuario = $sesion->user;

        $this->obtenerPDFSesion($paciente, $sesion, $informe, $usuario);
    }

    public function verInformeSesion($idPaciente, $idInforme)
    {

        $informe = InformeSesion::find($idInforme);
        $sesion = $informe->sesion;
        $paciente = $sesion->paciente;

        $usuario = $sesion->user;

        $this->obtenerPDFSesion($paciente, $sesion, $informe, $usuario);
    }

    public function obtenerPDFSesion($paciente, $sesion, $informe, $usuario)
    {
        $GLOBALS['titulo'] = $sesion->titulo;
        $pdf = new PDFSesion('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times', '', 12);

        $pdf->pdfBody($pdf, $paciente, $sesion, $informe, $usuario);

        $pdf->Output();
    }

    /***********************************************************
     * PDFs INFORME DE SEGUIMIENTO
     ************************************************************/
    public function generarPDFInformeEvaluacion(Request $request)
    {

        $evaluacion = Evaluacion::find($request->id);

        $paciente = $evaluacion->paciente;

        $this->obtenerPDFEvaluacion($paciente, $evaluacion);
    }

    public function verInformeEvaluacion($idPaciente, $idEvaluacion)
    {
        $evaluacion = Evaluacion::find($idEvaluacion);

        $paciente = $evaluacion->paciente;
        $this->obtenerPDFEvaluacion($paciente, $evaluacion);
    }

    public function obtenerPDFEvaluacion($paciente, $evaluacion)
    {
        $GLOBALS['fecha'] = $evaluacion->fecha;
        $pdf = new PDFEvaluacion('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times', '', 12);

        $pdf->pdfBody($pdf, $evaluacion, $paciente);

        $pdf->Output();
    }

    /***********************************************************
     * PDFs HISTORIA
     ************************************************************/
    public function generarPDFHistoria(Request $request)
    {
        $paciente = Paciente::find($request->paciente_id);
        $listadoRecuerdos = Recuerdo::where('paciente_id', $request->paciente_id)->get();

        $idEtapa = $request->idEtapa;
        $idCategoria = $request->idCategoria;
        $idEtiqueta = $request->idEtiqueta;
        $fechaInicio = $request->fechaInicio;
        $fechaFin = $request->fechaFin;
        $imagen = $paciente->multimedia;
        $listafinal = collect();

        if (empty($imagen)) {
            if ($paciente->genero_id == 1) { //hombre
                $imagen = "/img/avatar_hombre.png";
            } else {
                $imagen = "/img/avatar_mujer.png";
            }
        } else {
            $imagen = $paciente->multimedia->fichero;
        }

        if (!empty($idCategoria))
            $listadoRecuerdos = $listadoRecuerdos->where('categoria_id', $idCategoria);
        if (!empty($idEtapa))
            $listadoRecuerdos = $listadoRecuerdos->where('etapa_id', $idEtapa);
        if (!empty($idEtiqueta))
            $listadoRecuerdos = $listadoRecuerdos->where('etiqueta_id', $idEtiqueta);
        if (!empty($fechaInicio)) {
            foreach ($listadoRecuerdos as $recuerdo) {
                if ($recuerdo->fecha  >= $fechaInicio) {
                    $listafinal = $listafinal->prepend($recuerdo);
                }
            }
            $listadoRecuerdos =  $listafinal->reverse();
            $listafinal = collect();
        }
        if (!empty($fechaFin)) {
            foreach ($listadoRecuerdos as $recuerdo) {
                if ($recuerdo->fecha  <= $fechaFin) {
                    $listafinal = $listafinal->prepend($recuerdo);
                }
            }
            $listadoRecuerdos =  $listafinal->reverse();
            $listafinal = collect();
        }

        //return $listadoRecuerdos;
        $this->obtenerPDFHistoria($paciente, $listadoRecuerdos, $imagen);
    }

    public function obtenerPDFHistoria($paciente, $listadoRecuerdos, $imagen)
    {
        $GLOBALS['numInforme'] = "1";
        $pdf = new PDFHistoria('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times', '', 12);

        $pdf->pdfBody($pdf, $paciente, $listadoRecuerdos, $imagen);

        $pdf->Output();
    }

    /**************
     * PDF DIAGNOSTICO
     */


    public function verInformeDiagnostico($idPaciente)
    {
        $paciente = Paciente::find($idPaciente);

        $diagnostico = $paciente->diagnostico;
        if (!is_null($diagnostico->gds) && !is_null($diagnostico->mental) && !is_null($diagnostico->cdr)) {

            $fechasNF = $paciente->evaluaciones()->pluck("fecha")->toarray();
            array_unshift($fechasNF, $diagnostico->fecha);

            //////GDS
            $fechasGDS = array();
            $gds = $paciente->evaluaciones()->pluck("gds")->toarray();
            array_unshift($gds, $diagnostico->gds);


            //////minimental
            $fechasMini = array();
            $mini = $paciente->evaluaciones()->pluck("mental")->toarray();
            array_unshift($mini, $diagnostico->mental);


            /////////CDR
            $fechasCDR = array();
            $cdr = $paciente->evaluaciones()->pluck("cdr")->toarray();
            array_unshift($cdr, $diagnostico->cdr);

        } else {
            $fechasGDS = array();
            $gds = array();
            $mini = array();
            $cdr = array();
        }

        $datos = array();

        for ($i = 0; $i < 3; $i++) {
            if ($i == 0) {
                $escala = "GDS";
                $array = $gds;
            } else if ($i == 1) {
                $escala = "Mini mental";
                $array = $mini;
            } else {
                $escala = "CDR";
                $array = $cdr;
            }

            for ($j = 0; $j < sizeof($fechasNF); $j++) {
                $fecha = Carbon::createFromFormat('Y-m-d', $fechasNF[$j])->format('d/m/Y');

                if ($array[$j] === null) {
                    $valor = $array[$j - 1];
                } else {
                    $valor = $array[$j];
                }
                $datos[$escala][$fecha] = $valor;
            }
        }

        $this->obtenerPDFDiagnostico($paciente, $diagnostico, $datos, $fechasMini, $fechasCDR);
    }

    public function obtenerPDFDiagnostico($paciente, $diagnostico, $gds, $mini, $cdr)
    {
        $GLOBALS['fecha'] = $diagnostico->fecha;
        $pdf = new PDFDiagnostico('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times', '', 12);

        $pdf->pdfBody($pdf, $diagnostico, $paciente, $gds, $mini, $cdr);

        $pdf->Output();
    }

    /***********************************************************
     * PDFs RESUMENES
     ************************************************************/
    /*public function generarPDFResumen(Request $request)
    {

        $resumen = Resumen::find($request->id);
        $paciente = $resumen->paciente_id;
        $imagen = $paciente->multimedia;

        if (empty($imagen)) {
            if ($paciente->genero_id == 1) { //hombre
                $imagen = "/img/avatar_hombre.png";
            } else {
                $imagen = "/img/avatar_mujer.png";
            }
        } else {
            $imagen = $paciente->multimedia->fichero;
        }

        $this->obtenerPDFResumen($paciente, $resumen, $imagen);
    }*/

    public function verPDFResumen($idPaciente, $idResumen)
    {
        
        $resumen = Resumen::find($idResumen);
        $paciente = Paciente::find($idPaciente);
        $imagen = $paciente->multimedia;

        if (empty($imagen)) {
            if ($paciente->genero_id == 1) { //hombre
                $imagen = "/img/avatar_hombre.png";
            } else {
                $imagen = "/img/avatar_mujer.png";
            }
        } else {
            $imagen = $paciente->multimedia->fichero;
        }

        $this->obtenerPDFResumen($paciente, $resumen, $imagen);
    }

    public function obtenerPDFResumen($paciente, $resumen, $imagen)
    {
        $GLOBALS['fecha'] = $resumen->fecha;
        $pdf = new PDFResumen('P', 'mm', 'A4');
        $pdf->AliasNbPages();
        $pdf->AddPage();
        $pdf->SetFont('Times', '', 12);

        $pdf->pdfBody($pdf, $paciente, $resumen, $imagen);

        $pdf->Output();
    }
}
