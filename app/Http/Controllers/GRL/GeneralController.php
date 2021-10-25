<?php

namespace App\Http\Controllers\GRL;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;

class GeneralController extends Controller
{
   
  
    public function obtenerTipDocIdent()
    {
        $tipo_documento = DB::table('GRL.TIPO_IDENTIFICACIONES')
        ->get();
        return Response::json( $tipo_documento);
    }

    public function obtenerNacionalidad()
    {
        $tipo_documento = DB::table('GRL.NACIONALIDADES')
        ->get();
        return Response::json( $tipo_documento);
    }

    public function obtenerPais()
    {
        $tipo_documento = DB::table('GRL.PAISES')
        ->get();
        return Response::json( $tipo_documento);
    }

    public function obtenerRegion()
    {
        $tipo_documento = DB::table('GRL.REGIONES')
        ->get();
        return Response::json( $tipo_documento);
    }

    public function obtenerProvincia()
    {
        $tipo_documento = DB::table('GRL.PROVINCIAS')
        ->get();
        return Response::json( $tipo_documento);
    }

    public function obtenerDistrito()
    {
        $tipo_documento = DB::table('GRL.DISTRITOS')
        ->get();
        return Response::json( $tipo_documento);
    }

    public function obtenerEstadoCivil()
    {
        $tipo_documento = DB::table('GRL.TIPO_ESTADOS_CIVILES')
        ->get();
        return Response::json( $tipo_documento);
    }

    public function obtenerSexo()
    {
        $tipo_documento = DB::table('GRL.TIPO_SEXOS')
        ->get();
        return Response::json( $tipo_documento);
    }

   
}
