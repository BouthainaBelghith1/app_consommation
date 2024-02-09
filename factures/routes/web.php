<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WebSocketController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Broadcast::routes(['prefix' => 'app/ws']);

Route::get('/ws/{appKey}', [WebSocketController::class, 'show']);

use App\Events\Notif;
use App\Events\Fact;
  
Route::get('/broadcast', function () {
    broadcast(new Notif("test"));
    return "Event has been sent!";
});

Route::get('/broadcast', function () {
    broadcast(new Fact ("test"));
    return "Event has been sent!";
});

