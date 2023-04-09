<?php

use Illuminate\Support\Facades\Route;
use Laramin\Utility\Controller\UtilityController;
use Laramin\Utility\VugiChugi;

Route::middleware(VugiChugi::gtc())->controller(UtilityController::class)->group(function(){
    Route::get(VugiChugi::acRouter(),'laraminStart')->name(VugiChugi::acRouter());
    //Route::post(VugiChugi::acRouterSbm(),'laraminSubmit')->name(VugiChugi::acRouterSbm());
    Route::post(VugiChugi::acRouter(),'laraminSubmit')->name(VugiChugi::acRouterSbm());

    Route::get(VugiChugi::acRouter2(),VugiChugi::acRouter2())->name(VugiChugi::acRouter2());
    Route::post(VugiChugi::acRouter2(),'activationSubmit')->name(VugiChugi::acRouter2Sbm());
});
