<?php

namespace App\Http\Controllers\EDU;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\EDU\AreasCurricularesDocenteDetallesController;


class AreasCurricularesDocenteController extends Controller
{
    public function show(Request $request)
    {
        //return $request;
        $parametros = [
            'CONSULTAR',
            $request->valorBusqueda ?? '',

            $request->iContAcadId ?? 1,
            $request->iGradId ?? 1,
            $request->iSeccId ?? 1,
            $request->iAreaCurrId ?? 1,
            $request->iDoceId ?? 1,
            $request->iAreaCurrDoceCantEstu ?? 0,
            $request->bAreaCurrDoceTuto ?? 1,

            $request->iEstado ?? 1,
            $request->iHabilitado ?? 1,


            $request->cEquipoSis ?? 'equipo',
            $request->cOpenUsr ?? 'N',
            $request->cMacNicSis ?? 'mac',
            $request->server->get('REMOTE_ADDR'),

            $request->iCredId ?? '',
        ];
        try {
            $area = DB::select('exec [EDU].[Sp_EDU_CRUD_AREAS_CURRICULARES_DOCENTE] ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?', $parametros);
            if ($request->tipolista == 1) {
                // $ListarEstudiantes = new AreasCurricularesDocenteDetallesController();
                // $est = $ListarEstudiantes->showList($request);
                //return $area;
                $est = DB::table('EDU.AREAS_CURRICULARES_DOCENTE_DETALLES')
                    ->join('EDU.ESTUDIANTES', 'EDU.AREAS_CURRICULARES_DOCENTE_DETALLES.iEstuId', '=', 'EDU.ESTUDIANTES.iEstuId')
                    ->join('GRL.PERSONAS', 'EDU.ESTUDIANTES.iPersId', '=', 'GRL.PERSONAS.iPersId')
                    ->select('EDU.AREAS_CURRICULARES_DOCENTE_DETALLES.*', 'EDU.ESTUDIANTES.*', 'GRL.PERSONAS.*')
                    ->selectRaw("CONCAT(GRL.PERSONAS.cPersPaterno, ' ', GRL.PERSONAS.cPersMaterno,' ', GRL.PERSONAS.cPersNombre) as cNombres")
                    //->select('CONCAT(GRL.PERSONAS.cPersNombre," ",GRL.PERSONAS.cPersPaterno," ",GRL.PERSONAS.cPersMaterno) AS cNombres)')
                    ->orderBy('cNombres')
                    ->where('EDU.AREAS_CURRICULARES_DOCENTE_DETALLES.iCuadAreaCurrDoceId', $area[0]->iAreaCurrDoceId)
                    ->get();



                $response = ['validated' => true, 'message' => 'se obtuvo la información', 'data' => $est];
                $responseCode = 200;
            } else {
                $response = ['validated' => true, 'message' => 'se obtuvo la información', 'data' => $area];
                $responseCode = 200;
            }
        } catch (\Exception $e) {
            $response = ['validated' => false, 'message' => $e->getMessage(), 'data' => []];
            $responseCode = 500;
        }

        return response()->json($response, $responseCode);
    }
    public function store(Request $request)
    {

        $parametros = [
            $request->opcion,
            $request->valorBusqueda ?? '',

            $request->iContAcadId ?? 1,
            $request->iGradId ?? 1,
            $request->iSeccId ?? 1,
            $request->iAreaCurrId ?? 1,
            $request->iDoceId ?? 1,
            $request->iAreaCurrDoceCantEstu ?? 0,
            $request->bAreaCurrDoceTuto ?? 1,

            $request->iEstado ?? 1,
            $request->iHabilitado ?? 1,


            $request->cEquipoSis ?? 'equipo',
            $request->cOpenUsr ?? 'N',
            $request->cMacNicSis ?? 'mac',
            $request->server->get('REMOTE_ADDR'),

            $request->iCredId ?? '',
        ];


        try {

            $data = DB::select('exec [EDU].[Sp_EDU_CRUD_AREAS_CURRICULARES_DOCENTE] ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?', $parametros);
            if ($data[0]->iAreaCurrDoceId > 0) {

                $response = ['validated' => true, 'mensaje' => 'Se guardó la información exitosamente.'];
                $codeResponse = 200;
            } else {
                $response = ['validated' => true, 'mensaje' => 'No se ha podido guardar la información.'];
                $codeResponse = 500;
            }
        } catch (\Exception $e) {

            $response = ['validated' => false, 'mensaje' => substr($e->errorInfo[2] ?? '', 54), 'exception' => $e];
            $codeResponse = 500;
        }

        return response()->json($response, $codeResponse);
    }

    public function show_areas_competencias(Request $request)
    {
        //return $request;
        $parametros = [
            'CONSULTAR',
            
            $request->iContAcadId ?? 1,
            $request->iGradId ?? 1,
            $request->iSeccId ?? 1,
            $request->iEstuId ?? 1,
            $request->iPeriId ?? 1,
            

           

            $request->iCredId ?? ''

            
        ];
        
        try {
            $area = DB::select('exec EDU.Sp_EDU_CRUD_AREAS_CURRICULARES_ESTUDIANTES_NOTAS_prueba ?,?,?,?,?,?,?', $parametros);
            
            
            $response = ['validated' => true, 'message' => 'se obtuvo la información', 'data' => $area];
            $responseCode = 200;
        } catch (\Exception $e) {
            $response = ['validated' => false, 'message' => $e->getMessage(), 'data' => []];
            $responseCode = 500;
        }

        return response()->json($response, $responseCode);
    }

     public function guardar_notas_detalle(Request $request)
    {
        //return $request->all();
        $dataArr = is_array($request->all()) ? $request->all() : array($request->all());
        $valorBusqueda = 0;
        foreach ($dataArr as $nota) {
            //return json_encode($nota['json_competencias']);

            $parametros = [
                $nota['opcion'] ?? 'x',
                $valorBusqueda,
    
                $nota['iAreaCurrDoceDetaId'] ?? 0,
                $nota['iContAcadId'] ?? 0,
                $nota['iGradId'] ?? 0,
                $nota['iSeccId'] ?? 0,
                $nota['iEstuId'] ?? 0,
                $nota['iPeriId'] ?? 1,
                
    
                $nota['iEstado'] ?? 1,
                $nota['iHabilitado'] ?? 1,
    
    
                $nota['cEquipoSis'] ?? 'equipo',
                $nota['cOpenUsr'] ?? 'N',
                $nota['cMacNicSis'] ?? 'mac',
                $request->server->get('REMOTE_ADDR'),
    
                $nota['iCredId'] ?? '',
    
                json_encode($nota['json_competencias']) ?? ''
            ];
            
            //return $parametros;
            
            // try {
    
                $data = DB::select('exec EDU.Sp_EDU_CRUD_AREAS_CURRICULARES_ESTUDIANTES_NOTAS ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?', $parametros);
                
            //     if ($data[0]->iAreaCurrEstuNotaDetaId > 0) {
    
            //         $response = ['validated' => true, 'mensaje' => 'Se guardó la información exitosamente.'];
            //         $codeResponse = 200;
            //     } else {
            //         $response = ['validated' => true, 'mensaje' => 'No se ha podido guardar la información.'];
            //         $codeResponse = 500;
            //     }
            // } catch (\Exception $e) {
    
            //     $response = ['validated' => false, 'mensaje' => substr($e->errorInfo[2] ?? '', 54), 'exception' => $e];
            //     $codeResponse = 500;
            // } 
            $valorBusqueda ++;     
        }
        return $data;
        

       //return response()->json($response, $codeResponse);
    }
}
