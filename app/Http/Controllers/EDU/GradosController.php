<?php

namespace App\Http\Controllers\EDU;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;


class GradosController extends Controller
{
    public function show(){
        $grados = DB::table('EDU.GRADOS')
        ->get();
        return Response::json( $grados);
    }
    public function store(){
        
    }
    public function delete(){
        
    }
    public function update(){
        
    }
}
