<?php

namespace App\Http\Controllers\EDU;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;



class AreaCurricularController extends Controller
{
    //CONSULTAR
    public function obtenerAreaCurricular(Request $request)
    {

        $parametros = [
            "CONSULTAR",
            '',
            $request->iAreaCurrId ?? 1,
            $request->cAreaCurrDescripcion ?? '',
            $request->cAreaCurrAbreviatura ?? '',
            $request->iEstado ?? 1,
            $request->iHabilitado ?? 1,

            $request->cEquipoSis ?? 'equipo',
            $request->cOpenUsr ?? 'N',
            $request->cMacNicSis ?? 'mac',
            $request->server->get('REMOTE_ADDR'),

            $request->iCredDepenId ?? 1,
        ];

        try {
            $area = DB::select('EXEC [EDU].[Sp_EDU_CRUD_AREA_CURRICULAR] ?,?,?,?,?,?,?,?,?,?,?,?', $parametros);
            $response = ['validated' => true, 'message' => 'se obtuvo la información', 'data' => $area];
            $responseCode = 200;
        } catch (\Exception $e) {
            $response = ['validated' => false, 'message' => $e->getMessage(), 'data' => []];
            $responseCode = 500;
        }

        return response()->json($response, $responseCode);
    }

    //CONSULTAR
    public function showdestroy(Request $request)
    {

        $parametros = [
            "MOSTRAR",
            '',
            $request->iAreaCurrId ?? 1,
            $request->cAreaCurrDescripcion ?? '',
            $request->cAreaCurrAbreviatura ?? '',
            $request->iEstado ?? 1,
            $request->iHabilitado ?? 1,

            $request->cEquipoSis ?? 'equipo',
            $request->cOpenUsr ?? 'N',
            $request->cMacNicSis ?? 'mac',
            $request->server->get('REMOTE_ADDR'),

            $request->iCredDepenId ?? 1,
        ];

        try {
            $area = DB::select('EXEC [EDU].[Sp_EDU_CRUD_AREA_CURRICULAR] ?,?,?,?,?,?,?,?,?,?,?,?', $parametros);
            $response = ['validated' => true, 'message' => 'se obtuvo la información', 'data' => $area];
            $responseCode = 200;
        } catch (\Exception $e) {
            $response = ['validated' => false, 'message' => $e->getMessage(), 'data' => []];
            $responseCode = 500;
        }

        return response()->json($response, $responseCode);
    }

    //GUARDAR
    public function AreaCurricular(Request $request)
    {
        
        $this->validate(
            $request,
            [
                'opcion' => 'required',
            ],
            [
                'opcion.required' => 'Hubo un problema al obtener la acción',
            ]
        );

        $parametros = [
            $request->opcion,
            '',
            $request->iAreaCurrId ?? 1,
            $request->cAreaCurrDescripcion ?? '',
            $request->cAreaCurrAbreviatura ?? '',
            $request->iEstado ?? 1,
            $request->iHabilitado ?? 1,

            $request->cEquipoSis ?? 'equipo',
            $request->cOpenUsr ?? 'N',
            $request->cMacNicSis ?? 'mac',
            $request->server->get('REMOTE_ADDR'),

            $request->iCredDepenId ?? 1,
        ];

        try {
            $data = DB::select('EXEC [EDU].[Sp_EDU_CRUD_AREA_CURRICULAR] ?,?,?,?,?,?,?,?,?,?,?,?', $parametros);
            if ($data[0]->iAreaCurrId) {
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

    //EDITAR
    public function update(Request $request)
    {     
        $this->validate(
            $request,
            [
                'opcion' => 'required',
            ],
            [
                'opcion.required' => 'Hubo un problema al obtener la acción',
            ]
        );

        $parametros = [
            $request->opcion ?? 'EDITAR',
            '',
            $request->iAreaCurrId ?? 1,
            $request->cAreaCurrDescripcion ?? '',
            $request->cAreaCurrAbreviatura ?? '',
            $request->iEstado ?? 1,
            $request->iHabilitado ?? 1,

            $request->cEquipoSis ?? 'equipo',
            $request->cOpenUsr ?? 'N',
            $request->cMacNicSis ?? 'mac',
            $request->server->get('REMOTE_ADDR'),

            $request->iCredDepenId ?? 1,
        ];

        try {
            $data = DB::select('EXEC [EDU].[Sp_EDU_CRUD_AREA_CURRICULAR] ?,?,?,?,?,?,?,?,?,?,?,?', $parametros);
            //return $data;
            if ($data[0]->iAreaCurrId) {
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

    public function destroy(Request $request)
    {
        // $parametros = [
        //     $request->iAreaCurrId
        // ];
        // try {
        //     $data = DB::select('EXEC [EDU].[Sp_EDU_CRUD_AREA_CURRICULAR]  @_iAreaCurrId = ?', $parametros);
        //         $response = ['validated' => true, 'message' => 'Area Curricular se elimino correctamente', 'data' => $data];
        //         $responseCode = 200;
        // } catch (Exception $e) {
        //     $response = ['validated' => false, 'message' => substr($e->errorInfo[2] ?? '', 54), 'data' => [],
        //         'exception' => $e];
        //     $responseCode = 500;
        // }

        $parametros = [
            $request->opcion ?? 'ELIMINAR',
            '',
            $request->iAreaCurrId ?? 0,
            $request->cAreaCurrDescripcion ?? '',
            $request->cAreaCurrAbreviatura ?? '',
            $request->iEstado ?? 1,
            $request->iHabilitado ?? 1,

            $request->cEquipoSis ?? 'equipo',
            $request->cOpenUsr ?? 'N',
            $request->cMacNicSis ?? 'mac',
            $request->server->get('REMOTE_ADDR'),

            $request->iCredDepenId ?? 1,
        ];

        try {
            $data = DB::select('EXEC [EDU].[Sp_EDU_CRUD_AREA_CURRICULAR] ?,?,?,?,?,?,?,?,?,?,?,?', $parametros);
            //return $data;
            if ($data[0]->iAreaCurrId) {
                $response = ['validated' => true, 'mensaje' => 'Se eliminó la información exitosamente.'];
                $codeResponse = 200;
            } else {
                $response = ['validated' => true, 'mensaje' => 'No se ha podido eliminar la información.'];
                $codeResponse = 500;
            }
        } catch (\Exception $e) {

            $response = ['validated' => false, 'mensaje' => substr($e->errorInfo[2] ?? '', 54), 'exception' => $e];
            $codeResponse = 500;
        }

        return response()->json($response, $codeResponse);     
 
        
    }
/*
    public function eliminarPreinscripcionByID($id)
    {
        DB::beginTransaction();

        try {
            Db::table('acad.preinscripciones')
                ->where('iPreinscripcionId', '=', $id)
                ->delete();

            $response = ['validated' => true, 'data' => [], 'message' => 'Preinscripción eliminada correctamente'];
            $responseCode = 200;
        } catch (\Exception $e) {
            DB::rollBack();
            $response = ['validated' => false, 'data' => [], 'error' => $e->getMessage(), 'message' => 'No se pudo eliminar la preinscripcion'];
            $responseCode = 500;
        }

        DB::commit();

        return response()->json($response, $responseCode);
    }
*/
}
