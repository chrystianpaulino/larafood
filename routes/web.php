<?php

use Illuminate\Support\Facades\Route;

Route::prefix('admin')->namespace('Admin')->group(function (){

    /*
     * Routes Details Plans
     * */

    Route::delete('plans/{url}/details/{idDetail}'  , 'DetailPlanController@destroy')->name('details.plan.destroy');
    Route::get('plans/{url}/details/{idDetail}'     , 'DetailPlanController@show'   )->name('details.plan.show');
    Route::put('plans/{url}/details/{idDetail}'     , 'DetailPlanController@update' )->name('details.plan.update');
    Route::get('plans/{url}/details/{idDetail}/edit', 'DetailPlanController@edit'   )->name('details.plan.edit');
    Route::get('plans/{url}/details/create'         , 'DetailPlanController@create' )->name('details.plan.create');
    Route::post('plans/{url}/details'               , 'DetailPlanController@store'  )->name('details.plan.store');
    Route::get('plans/{url}/details'                , 'DetailPlanController@index'  )->name('details.plan.index');


    /*
     * Routes Plans
     * */

    Route::any('plans/search'           , 'PlanController@search'       )->name('plans.search'); // any para paginacao

    Route::get('plans'                  , 'PlanController@index'        )->name('plans.index');
    Route::get('plans/create'           , 'PlanController@create'       )->name('plans.create');
    Route::post('plans'                 , 'PlanController@store'        )->name('plans.store');
    Route::get('plans/{url}'            , 'PlanController@show'         )->name('plans.show');
    Route::delete('plans/{url}'         , 'PlanController@destroy'      )->name('plans.destroy');
    Route::get('plans/{url}/edit'       , 'PlanController@edit'         )->name('plans.edit');
    Route::put('plans/{url}'            , 'PlanController@update'       )->name('plans.update');

    Route::get('/'                      , 'Admin\PlanController@index'  )->name('admin.index');

});

Route::get('/', function () {
    return view('welcome');
});
