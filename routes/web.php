<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Models\Event;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', [EventController::class, 'index']);
Route::get('add-event', [EventController::class, 'addEvent']);
Route::post('save-event', [EventController::class, 'saveEvent']);
Route::get('edit-event/{id}', [EventController::class, 'editEvent']);
Route::post('update-event', [EventController::class, 'updateEvent']);
Route::get('delete-event/{id}', [EventController::class, 'deleteEvent']);
