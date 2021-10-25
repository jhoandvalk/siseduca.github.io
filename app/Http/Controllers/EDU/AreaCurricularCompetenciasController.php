<?php

namespace App\Http\Controllers\EDU;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;



class AreaCurricularCompetenciasController extends Controller
{
    //CONSULTAR
    public function obtenerAreaCurricularCompetencias($iAreaCurrId)
    {

        $parametros = [
            "CONSULTAR",
            '',
            1,
            $iAreaCurrId,
            '',
            1,
            1,

            'equipo',
            'N',
            'mac',
            '-',

            1,
        ];

        try {
            $area = DB::select('EXEC [EDU].[Sp_EDU_CRUD_AREA_CURRICULAR_COMPETENCIAS] ?,?,?,?,?,?,?,?,?,?,?,?', $parametros);
            $response = ['validated' => true, 'message' => 'se obtuvo la información', 'data' => $area];
            $responseCode = 200;
        } catch (\Exception $e) {
            $response = ['validated' => false, 'message' => $e->getMessage(), 'data' => []];
            $responseCode = 500;
        }

        return response()->json($response, $responseCode);
    }

    //GUARDAR
    public function AreaCurricularCompetencias(Request $request)
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
            $request->iAreaCurrCompId ?? 1,
            $request->iAreaCurrId ?? 1,
            $request->cAreaCurrCompDescripcion ?? '',
            $request->iEstado ?? 1,
            $request->iHabilitado ?? 1,

            $request->cEquipoSis ?? 'equipo',
            $request->cOpenUsr ?? 'N',
            $request->cMacNicSis ?? 'mac',
            $request->server->get('REMOTE_ADDR'),

            $request->iCredDepenId ?? 1,
        ];

        try {
            $data = DB::select('EXEC [EDU].[Sp_EDU_CRUD_AREA_CURRICULAR_COMPETENCIAS] ?,?,?,?,?,?,?,?,?,?,?,?', $parametros);
            if ($data[0]->iAreaCurrCompId) {
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
            $request->iAreaCurrCompId ?? 1,
            $request->iAreaCurrId ?? 1,
            $request->cAreaCurrCompDescripcion ?? '',
            $request->iEstado ?? 1,
            $request->iHabilitado ?? 1,

            $request->cEquipoSis ?? 'equipo',
            $request->cOpenUsr ?? 'N',
            $request->cMacNicSis ?? 'mac',
            $request->server->get('REMOTE_ADDR'),

            $request->iCredDepenId ?? 1,
        ];

        try {
            $data = DB::select('EXEC [EDU].[Sp_EDU_CRUD_AREA_CURRICULAR_COMPETENCIAS] ?,?,?,?,?,?,?,?,?,?,?,?', $parametros);
            if ($data[0]->iAreaCurrCompId) {
                $response = ['validated' => true, 'mensaje' => 'Se actualizó la información exitosamente.'];
                $codeResponse = 200;
            } else {
                $response = ['validated' => true, 'mensaje' => 'No se ha podido actualizar la información.'];
                $codeResponse = 500;
            }
        } catch (\Exception $e) {

            $response = ['validated' => false, 'mensaje' => substr($e->errorInfo[2] ?? '', 54), 'exception' => $e];
            $codeResponse = 500;
        }

        return response()->json($response, $codeResponse);
    }

    //ELIMINAR
    public function destroy(Request $request)
    {
        $parametros = [
            $request->opcion ?? 'ELIMINAR',
            '',
            $request->iAreaCurrCompId ?? 1,
            $request->iAreaCurrId ?? 1,
            $request->cAreaCurrCompDescripcion ?? '',
            $request->iEstado ?? 1,
            $request->iHabilitado ?? 1,

            $request->cEquipoSis ?? 'equipo',
            $request->cOpenUsr ?? 'N',
            $request->cMacNicSis ?? 'mac',
            $request->server->get('REMOTE_ADDR'),

            $request->iCredDepenId ?? 1,
        ];

        try {
            $data = DB::select('EXEC [EDU].[Sp_EDU_CRUD_AREA_CURRICULAR_COMPETENCIAS] ?,?,?,?,?,?,?,?,?,?,?,?', $parametros);
            if ($data[0]->iAreaCurrCompId) {
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
}
