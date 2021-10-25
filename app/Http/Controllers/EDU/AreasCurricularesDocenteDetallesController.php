<?php

namespace App\Http\Controllers\EDU;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;



class AreasCurricularesDocenteDetallesController extends Controller
{
    public function show(Request $request)
    {
        $parametros = [
            'CONSULTAR',
            $request->valorBusqueda ?? '',

            $request->iAreaCurrDoceId ?? 1,
            $request->iEstuId ?? 1,
            

            $request->iEstado ?? 1,
            $request->iHabilitado ?? 1,


            $request->cEquipoSis ?? 'equipo',
            $request->cOpenUsr ?? 'N',
            $request->cMacNicSis ?? 'mac',
            $request->server->get('REMOTE_ADDR'),

            $request->iCredId ?? '',
        ];
        
        try {
            $area = DB::select('exec [EDU].[Sp_EDU_CRUD_AREAS_CURRICULARES_DOCENTE_DETALLE] ?,?,?,?,?,?,?,?,?,?,?', $parametros);
            $response = ['validated' => true, 'message' => 'se obtuvo la información', 'data' => $area];
            $responseCode = 200;
        } catch (\Exception $e) {
            $response = ['validated' => false, 'message' => $e->getMessage(), 'data' => []];
            $responseCode = 500;
        }

        return response()->json($response, $responseCode);
    }

    public function showList(Request $request)
    {
        $parametros = [
            'CONSULTAR-LISTA',
            $request->valorBusqueda ?? '',

            $request->iAreaCurrDoceId ?? 1,
            $request->iEstuId ?? 1,
            

            $request->iEstado ?? 1,
            $request->iHabilitado ?? 1,


            $request->cEquipoSis ?? 'equipo',
            $request->cOpenUsr ?? 'N',
            $request->cMacNicSis ?? 'mac',
            $request->server->get('REMOTE_ADDR'),

            $request->iCredId ?? '',
        ];

        try {
            $area = DB::select('exec [EDU].[Sp_EDU_CRUD_AREAS_CURRICULARES_DOCENTE_DETALLE] ?,?,?,?,?,?,?,?,?,?,?', $parametros);
            $response = $area;
            $responseCode = 200;
        } catch (\Exception $e) {
            $response = [];
            $responseCode = 500;
        }

        return ($response);
    }

    public function store(Request $request)
    {

        $parametros = [
            $request->opcion,
            $request->valorBusqueda ?? '',

            $request->iCuadAreaCurrDoceId ?? 1,
            $request->iEstuId ?? 1,
            

            $request->iEstado ?? 1,
            $request->iHabilitado ?? 1,


            $request->cEquipoSis ?? 'equipo',
            $request->cOpenUsr ?? 'N',
            $request->cMacNicSis ?? 'mac',
            $request->server->get('REMOTE_ADDR'),

            $request->iCredId ?? '',
        ];


        try {

            $data = DB::select('exec [EDU].[Sp_EDU_CRUD_AREAS_CURRICULARES_DOCENTE_DETALLE] ?,?,?,?,?,?,?,?,?,?,?', $parametros);
            if ($data[0]->iCuadAreaCurrDoceDetaId > 0) {

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
}
