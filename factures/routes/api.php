<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\ChatController;
use App\Http\Controllers\CompteurController;
use App\Http\Controllers\FactureController;
use App\Http\Controllers\LocalController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\RegionController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Events\Fact;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['prefix' => '/region'],function(){
    Route::get('/getAll',[RegionController::class,'GetRegion']);
    Route::post('/AddRegion',[RegionController::class,'store']);
    Route::get('/finById/{id}',[RegionController::class,'finById']);
    Route::put('/update/{id}',[RegionController::class,'update']);
    Route::delete('/destroy/{id}',[RegionController::class,'destroy']);
 });
 
 Route::group(['prefix' => '/notification'],function(){
     Route::get('/getAll',[NotificationController::class,'GetNotification']);
     Route::post('/AddNotification',[NotificationController::class,'store']);
     Route::get('/finById/{id}',[NotificationController::class,'finById']);
     Route::put('/update/{id}',[NotificationController::class,'update']);
     Route::delete('/destroy/{id}',[NotificationController::class,'destroy']);
  });
 
  Route::group(['prefix' => '/user'],function(){
     Route::get('/getAll',[UserController::class,'GetUser']);
     Route::post('/AddUser',[UserController::class,'store']);
     Route::get('/finById/{id}',[UserController::class,'finById']);
     Route::put('/update/{id}',[UserController::class,'update']);
     Route::delete('/destroy/{id}',[UserController::class,'destroy']);
     Route::get('/count',[UserController::class,'countUsers']);
  });
 
  Route::group(['prefix' => '/local'],function(){
     Route::get('/getAll',[LocalController::class,'GetLocal']);
     Route::post('/AddLocal',[LocalController::class,'store']);
     Route::get('/finById/{id}',[LocalController::class,'finById']);
     Route::put('/update/{id}',[LocalController::class,'update']);
     Route::delete('/destroy/{id}',[LocalController::class,'destroy']);
     Route::get('/count',[LocalController::class,'countLocals']);
     //Route::get('/filtrer/{region_id}',[LocalController::class,'filtrer']);
  });
 
  Route::group(['prefix' => '/categorie'],function(){
     Route::get('/getAll',[CategorieController::class,'GetCategorie']);
     Route::post('/AddCategorie',[CategorieController::class,'store']);
     Route::get('/finById/{id}',[CategorieController::class,'finById']);
     Route::put('/update/{id}',[CategorieController::class,'update']);
     Route::delete('/destroy/{id}',[CategorieController::class,'destroy']);
  });
 
  Route::group(['prefix' => '/facture'],function(){
     Route::get('/getAll',[FactureController::class,'GetFacture']);
     Route::post('/AddFacture',[FactureController::class,'store']);
     Route::get('/finById/{id}',[FactureController::class,'finById']);
     Route::put('/update/{id}',[FactureController::class,'update']);
     Route::put('/payer/{id}',[FactureController::class,'payer']);
     Route::delete('/destroy/{id}',[FactureController::class,'destroy']);
     Route::get('/countNonPaye',[FactureController::class,'countFactureNonPaye']);
     Route::get('/countPaye',[FactureController::class,'countFacturePaye']);
     Route::get('/count',[FactureController::class,'countFacture']);
  });
 
  Route::group(['prefix' => '/compteur'],function(){
     Route::get('/getAll',[CompteurController::class,'GetCompteur']);
     Route::post('/AddCompteur',[CompteurController::class,'store']);
     Route::get('/finById/{id}',[CompteurController::class,'finById']);
     Route::put('/update/{id}',[CompteurController::class,'update']);
     Route::delete('/destroy/{id}',[CompteurController::class,'destroy']);
     Route::get('/count',[CompteurController::class,'countCompteurs']);
     Route::get('/countConsommation/{month}/{type}', [CompteurController::class, 'getTotalConsommationByMonthAndType']);
     Route::get('/countByMonth', [CompteurController::class, 'getCountByMonth']);
     Route::get('/totalConsommation', [CompteurController::class, 'totalConsommation']);
     /*Route::get('/countByLocal/{id}',[CompteurController::class,'countCompteursByLocal']);
     Route::get('/getConsommationTotale',[CompteurController::class,'getConsommationTotale']);*/
  });

 Route::group(['prefix' => '/chat'],function(){
    Route::get('/getAll',[ChatController::class,'GetChat']);
    Route::post('/AddChat',[ChatController::class,'store']);
    Route::get('/finById/{id}',[ChatController::class,'finById']);
    Route::put('/update/{id}',[ChatController::class,'update']);
    Route::delete('/destroy/{id}',[ChatController::class,'destroy']);
 });
 
  Route::group(['prefix' => '/auth'],function(){
    Route::post('/login',[AuthController::class,'Login']);
 });

