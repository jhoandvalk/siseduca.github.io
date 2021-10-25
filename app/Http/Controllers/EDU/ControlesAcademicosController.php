<?php

namespace App\Http\Controllers\EDU;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;


class ControlesAcademicosController extends Controller
{
    public function show(){
        $controles_academico = DB::table('EDU.CONTROLES_ACADEMICO')
        ->get();
        return Response::json( $controles_academico);
    }
    public function store(){
        
    }
    public function delete(){
        
    }
    public function update(){
        
    }
}
