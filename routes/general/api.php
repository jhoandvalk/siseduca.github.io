<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'general'], function () {

    Route::group(['prefix' => 'documento'], function () {

        Route::get('obtener-tipo-documento-id', 'GRL\GeneralController@obtenerTipDocIdent');
        Route::get('obtener-nacionalidad', 'GRL\GeneralController@obtenerNacionalidad');
        Route::get('obtener-pais', 'GRL\GeneralController@obtenerPais');
        Route::get('obtener-region', 'GRL\GeneralController@obtenerRegion');
        Route::get('obtener-distrito', 'GRL\GeneralController@obtenerProvincia');
        Route::get('obtener-provincia', 'GRL\GeneralController@obtenerDistrito');
        Route::get('obtener-tipo-estados-civiles', 'GRL\GeneralController@obtenerEstadoCivil');
        Route::get('obtener-tipo-sexos', 'GRL\GeneralController@obtenerSexo');

    
    
    });

    Route::group(['prefix' => 'personas'], function () {
        Route::get('obtener', 'GRL\PersonasController@show');
        Route::post('guardar', 'GRL\PersonasController@store');
        Route::delete('eliminar', 'GRL\PersonasController@destroy');
        Route::put('eliminar', 'GRL\PersonasController@update');

        //
        Route::get('obtener-usuarios', 'GRL\PersonasController@obtener_usuarios');
    });
});




Route::group(['prefix' => 'educacion'], function () {

    Route::group(['prefix' => 'apoderados'], function () {
       
    });

    Route::group(['prefix' => 'area-curricular'], function () {
        Route::get('obtener-area-curricular', 'EDU\AreaCurricularController@obtenerAreaCurricular');
        Route::get('MostrarEliminados', 'EDU\AreaCurricularController@showdestroy');
        Route::post('AreaCurricular', 'EDU\AreaCurricularController@AreaCurricular');
        Route::put('EditarAreaCurricular', 'EDU\AreaCurricularController@update');
        Route::put('EliminarAreaCurricular', 'EDU\AreaCurricularController@destroy');
       
        Route::get('obtener-area-curricular-competencias/{iAreaCurrId}', 'EDU\AreaCurricularCompetenciasController@obtenerAreaCurricularCompetencias');
        Route::post('AreaCurricularCompetencias', 'EDU\AreaCurricularCompetenciasController@AreaCurricularCompetencias');
        Route::put('EditarAreaCurricularCompetencias', 'EDU\AreaCurricularCompetenciasController@update');
        Route::put('EliminarAreaCurricularCompetencias', 'EDU\AreaCurricularCompetenciasController@destroy');
    
    });
    Route::group(['prefix' => 'area-geografica'], function () {
        Route::get('obtener', 'EDU\Controller@show');
        Route::post('guardar', 'EDU\Controller@store');
        Route::delete('eliminar', 'EDU\Controller@destroy');
        Route::put('eliminar', 'EDU\Controller@update');

    });
    Route::group(['prefix' => 'areas-curriculares-docente'], function () {
        Route::post('obtener', 'EDU\AreasCurricularesDocenteController@show');
        Route::post('obtener-areas-competencias', 'EDU\AreasCurricularesDocenteController@show_areas_competencias');
        //Route::get('obtener', 'EDU\AreasCurricularesDocenteController@show');
        Route::post('guardar', 'EDU\AreasCurricularesDocenteController@store');
        Route::delete('eliminar', 'EDU\AreasCurricularesDocenteController@destroy');
        Route::put('eliminar', 'EDU\AreasCurricularesDocenteController@update');
        Route::post('guardar_notas_detalle', 'EDU\AreasCurricularesDocenteController@guardar_notas_detalle');
    });
    Route::group(['prefix' => 'areas-curriculares-docente-detalles'], function () {
        Route::post('obtener', 'EDU\AreasCurricularesDocenteDetallesController@show');
        //Route::get('obtener-lista', 'EDU\AreasCurricularesDocenteDetallesController@showList');
        Route::post('guardar', 'EDU\AreasCurricularesDocenteDetallesController@store');
        Route::delete('eliminar', 'EDU\AreasCurricularesDocenteDetallesController@destroy');
        Route::put('eliminar', 'EDU\AreasCurricularesDocenteDetallesController@update');
    });
    Route::group(['prefix' => 'caracteristicas-iiee'], function () {
        Route::get('obtener', 'EDU\Controller@show');
        Route::post('guardar', 'EDU\Controller@store');
        Route::delete('eliminar', 'EDU\Controller@destroy');
        Route::put('eliminar', 'EDU\Controller@update');
    });
    Route::group(['prefix' => 'controles-academico'], function () {
        Route::get('obtener', 'EDU\ControlesAcademicosController@show');
        Route::post('guardar', 'EDU\ControlesAcademicosController@store');
        Route::delete('eliminar', 'EDU\ControlesAcademicosController@destroy');
        Route::put('eliminar', 'EDU\ControlesAcademicosController@update');
       
    });
    Route::group(['prefix' => 'docentes'], function () {
        Route::get('obtener', 'EDU\DocentesController@show');
        Route::post('guardar', 'EDU\DocentesController@store');
        Route::delete('eliminar', 'EDU\DocentesController@destroy');
        Route::put('eliminar', 'EDU\DocentesController@update');
    });
    Route::group(['prefix' => 'escala-calificaciones'], function () {
        Route::get('obtener', 'EDU\Controller@show');
        Route::post('guardar', 'EDU\Controller@store');
        Route::delete('eliminar', 'EDU\Controller@destroy');
        Route::put('eliminar', 'EDU\Controller@update');
    });
    Route::group(['prefix' => 'estudiantes'], function () {
        Route::get('obtener', 'EDU\EstudiantesController@show');
        Route::post('guardar', 'EDU\EstudiantesController@store');
        Route::delete('eliminar', 'EDU\EstudiantesController@destroy');
        Route::put('eliminar', 'EDU\EstudiantesController@update');
    });
    Route::group(['prefix' => 'etapa-sistema-educativo'], function () {
        Route::get('obtener', 'EDU\Controller@show');
        Route::post('guardar', 'EDU\Controller@store');
        Route::delete('eliminar', 'EDU\Controller@destroy');
        Route::put('eliminar', 'EDU\Controller@update');
    });
    Route::group(['prefix' => 'genero-educativa'], function () {
        Route::get('obtener', 'EDU\Controller@show');
        Route::post('guardar', 'EDU\Controller@store');
        Route::delete('eliminar', 'EDU\Controller@destroy');
        Route::put('eliminar', 'EDU\Controller@update');
    });
    Route::group(['prefix' => 'gerencia'], function () {
        Route::get('obtener', 'EDU\Controller@show');
        Route::post('guardar', 'EDU\Controller@store');
        Route::delete('eliminar', 'EDU\Controller@destroy');
        Route::put('eliminar', 'EDU\Controller@update');
    });
    Route::group(['prefix' => 'grados'], function () {
        Route::get('obtener', 'EDU\GradosController@show');
        Route::post('guardar', 'EDU\GradosController@store');
        Route::delete('eliminar', 'EDU\GradosController@destroy');
        Route::put('eliminar', 'EDU\GradosController@update');
    });
    Route::group(['prefix' => 'instancias-gestion'], function () {
        Route::get('obtener', 'EDU\Controller@show');
        Route::post('guardar', 'EDU\Controller@store');
        Route::delete('eliminar', 'EDU\Controller@destroy');
        Route::put('eliminar', 'EDU\Controller@update');
    });
    Route::group(['prefix' => 'instituciones-educativa'], function () {
        Route::get('obtener', 'EDU\Controller@show');
        Route::post('guardar', 'EDU\Controller@store');
        Route::delete('eliminar', 'EDU\Controller@destroy');
        Route::put('eliminar', 'EDU\Controller@update');
    });
    Route::group(['prefix' => 'niveles'], function () {
        Route::get('obtener', 'EDU\Controller@show');
        Route::post('guardar', 'EDU\Controller@store');
        Route::delete('eliminar', 'EDU\Controller@destroy');
        Route::put('eliminar', 'EDU\Controller@update');
    });
    Route::group(['prefix' => 'secciones'], function () {
        Route::get('obtener', 'EDU\SeccionesController@show');
        Route::post('guardar', 'EDU\SeccionesController@store');
        Route::delete('eliminar', 'EDU\SeccionesController@destroy');
        Route::put('eliminar', 'EDU\SeccionesController@update');
    });
    Route::group(['prefix' => 'tipo-calificaciones'], function () {
        Route::get('obtener', 'EDU\Controller@show');
        Route::post('guardar', 'EDU\Controller@store');
        Route::delete('eliminar', 'EDU\Controller@destroy');
        Route::put('eliminar', 'EDU\Controller@update');
    });
    Route::group(['prefix' => 'turnos-educativa'], function () {
        Route::get('obtener', 'EDU\Controller@show');
        Route::post('guardar', 'EDU\Controller@store');
        Route::delete('eliminar', 'EDU\Controller@destroy');
        Route::put('eliminar', 'EDU\Controller@update');
    });
    Route::group(['prefix' => 'ugel'], function () {
        Route::get('obtener', 'EDU\Controller@show');
        Route::post('guardar', 'EDU\Controller@store');
        Route::delete('eliminar', 'EDU\Controller@destroy');
        Route::put('eliminar', 'EDU\Controller@update');
    });
});
