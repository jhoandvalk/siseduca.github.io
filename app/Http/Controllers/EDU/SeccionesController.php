<?php

namespace App\Http\Controllers\EDU;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;


class SeccionesController extends Controller
{
    public function show(){
        $secciones = DB::table('EDU.SECCIONES')
        ->get();
        return Response::json( $secciones);
    }
    public function store(){
        
    }
    public function delete(){
        
    }
    public function update(){
        
    }
}
