<?php

namespace App\Http\Controllers\Seguridad;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SegCredencialController extends Controller
{
    /**
     * Obtiene la información de seguridad del credencial.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function obtenerInfoCredencial()
    {
        $credencial = auth()->user();
        $credencial->dependencias = DB::table('seg.credenciales_dependencias')->where('iCredId', $credencial->iCredId)->get();


        return response()->json( $credencial );

    }

   
}
