<?php

namespace App\Http\Controllers\EDU;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;



class EstudiantesController extends Controller
{
    public function show(Request $request)
    {
        $parametros = [
            "CONSULTAR",
            $request->valorBusqueda ?? '-',

            $request->iPersId ?? 1,
            $request->cEstuCodigo ?? '-',
            $request->cEstuCorreoInstitucional ?? '-',
            $request->cEstuClaveTemporal ?? '-',
            $request->cEstuClave ?? '-',

            $request->cEstuAnioIngreso ?? '-',
            $request->cEstuAnioEgreso ?? '-',

            $request->cEstuInvicto ?? '-',
            $request->cEstuMatricActiva ?? '-',

            $request->iEstado ?? 1,
            $request->iHabilitado ?? 1,

            $request->cEquipoSis ?? 'equipo',
            $request->cMacNicSis ?? 'mac',
            $request->server->get('REMOTE_ADDR'),

            $request->iCredDepenId ?? '',
        ];

        try {
            $docente = DB::select('EXEC [EDU].[Sp_EDU_CRUD_ESTUDIANTES] ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?', $parametros);
            $response = ['validated' => true, 'message' => 'se obtuvo la información', 'data' => $docente];
            $responseCode = 200;
        } catch (\Exception $e) {
            $response = ['validated' => false, 'message' => $e->getMessage(), 'data' => []];
            $responseCode = 500;
        }

        return response()->json($response, $responseCode);
    }

    public function store(Request $request)
    {
        $parametros = [
            "GUARDAR",
            $request->valorBusqueda ?? '-',

            $request->iPersId ?? 1,
            $request->cEstuCodigo ?? '-',
            $request->cEstuCorreoInstitucional ?? '-',
            $request->cEstuClaveTemporal ?? '-',
            $request->cEstuClave ?? '-',

            $request->cEstuAnioIngreso ?? '-',
            $request->cEstuAnioEgreso ?? '-',

            $request->cEstuInvicto ?? '-',
            $request->cEstuMatricActiva ?? '-',

            $request->iEstado ?? 1,
            $request->iHabilitado ?? 1,

            $request->cEquipoSis ?? 'equipo',
            $request->cMacNicSis ?? 'mac',
            $request->server->get('REMOTE_ADDR'),

            $request->iCredDepenId ?? '',
        ];

        try {
            $estudiantes = DB::select('EXEC [EDU].[Sp_EDU_CRUD_ESTUDIANTES] ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?', $parametros);
            $response = $estudiantes;
            $responseCode = 200;
        } catch (\Exception $e) {
            $response = [];
            $responseCode = 500;
        }

        return ($response);
    }
}
