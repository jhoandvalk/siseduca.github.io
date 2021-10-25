<?php

namespace App\Http\Controllers\GRL;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\EDU\DocentesController;
use App\Http\Controllers\EDU\EstudiantesController;


class PersonasController extends Controller
{

    public function show(Request $request)
    {
    }
    public function store(Request $request)
    {
        $parametros = [
            $request->opcion,
            $request->valorBusqueda ?? '',
            $request->iTipoPersId ?? 1,
            $request->iTipoIdenId ?? 1,
            $request->iTipoEstaCiviId ?? 1,
            $request->iTipoSexoId ?? 2,

            $request->iNacionId ?? 193,
            $request->iPaisId ?? 1,
            $request->iRegiId ?? 1,
            $request->iPrvnId ?? 1,
            $request->iDsttId ?? 1,


            $request->cPersDocumento,
            $request->cPersPaterno,
            $request->cPersMaterno,
            $request->cPersNombre,
            $request->dPersNacimiento,
            $request->cPersFotografia ?? 'prueba',

            $request->cPersDomicilio ?? '-',
            $request->dtPersActualizadoProv ?? date('Y-m-d'),
            $request->iPersPide ?? 1,


            $request->iEstado ?? 1,
            $request->iHabilitado ?? 1,

            $request->iCredDepeId ?? 1,
            $request->iSessId ?? 1,
            $request->cPersKey ?? '-',

            $request->cEquipoSis ?? 'equipo',
            $request->cMacNicSis ?? 'mac',
            $request->server->get('REMOTE_ADDR'),

            $request->iCredId ?? '',
        ];


        try {

            $data = DB::select('exec [GRL].[Sp_GRL_CRUD_PERSONAS] ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?', $parametros);
            if ($data[0]->iPersId > 0) {

                if ($request->tipopersona == 1) {
                    //DOCENTE
                    $request->iPersId = $data[0]->iPersId;
                    $Docente = new DocentesController();
                    $doc = $Docente->store($request);
                    if ($doc[0]->iDoceId > 0) {
                        $response = ['validated' => true, 'mensaje' => 'Se guardó la información exitosamente.'];
                        $codeResponse = 200;
                    } else {
                        $response = ['validated' => true, 'mensaje' => 'No se ha podido guardar la información.'];
                        $codeResponse = 500;
                    }
                    
                } 
                
                if ($request->tipopersona == 2) {
                    $request->iPersId = $data[0]->iPersId;
                    $Estudiante = new EstudiantesController();
                    $est = $Estudiante->store($request);
                    if ($est[0]->iEstuId > 0) {
                        $response = ['validated' => true, 'mensaje' => 'Se guardó la información exitosamente.'];
                        $codeResponse = 200;
                    } else {
                        $response = ['validated' => true, 'mensaje' => 'No se ha podido guardar la información.'];
                        $codeResponse = 500;
                    }
                }

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

    public function obtener_usuarios(Request $request)
    {
        $parametros = [
            $request->opcion ?? 'CONSULTAR-USUARIOS',
            $request->valorBusqueda ?? '-',
            $request->iTipoPersId ?? 0,
            $request->iTipoIdenId ?? 0,
            $request->iTipoEstaCiviId ?? 0,
            $request->iTipoSexoId ?? 0,

            $request->iNacionId ?? 193,
            $request->iPaisId ?? 1,
            $request->iRegiId ?? 1,
            $request->iPrvnId ?? 1,
            $request->iDsttId ?? 1,


            $request->cPersDocumento ?? '0',
            $request->cPersPaterno ?? '0',
            $request->cPersMaterno ?? '0',
            $request->cPersNombre ?? '0',
            $request->dPersNacimiento ?? date('Y-m-d'),
            $request->cPersFotografia ?? '-',

            $request->cPersDomicilio ?? '-',
            $request->dtPersActualizadoProv ?? date('Y-m-d'),
            $request->iPersPide ?? 1,


            $request->iEstado ?? 1,
            $request->iHabilitado ?? 1,

            $request->iCredDepeId ?? 1,
            $request->iSessId ?? 1,
            $request->cPersKey ?? '-',

            $request->cEquipoSis ?? 'equipo',
            $request->cMacNicSis ?? 'mac',
            $request->server->get('REMOTE_ADDR'),

            $request->iCredId ?? ''
        ];

        try {
            $usuarios = DB::select('exec [GRL].[Sp_GRL_CRUD_PERSONAS] ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?', $parametros);
            $response = ['validated' => true, 'message' => 'se obtuvo la información', 'data' => $usuarios];
            $responseCode = 200;
        } catch (\Exception $e) {
            $response = ['validated' => false, 'message' => $e->getMessage(), 'data' => []];
            $responseCode = 500;
        }

        return response()->json($response, $responseCode);

    }
}
