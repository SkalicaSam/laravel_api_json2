<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Models\User;
use App\Models\Event;
use App\Http\Controllers\EventsController;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
// });


// Route::get( 'events/', [EventsController::class, 'list' ]);
// Route::get('events/{id}', [EventsController::class, 'showEventById' ]);

// Route::post('events', [EventsController::class, 'create' ]);

// Route::put('events/{id}', [EventsController::class, 'updateEventById'] );
// Route::delete('events/{id}', [EventsController::class, 'dellEventById'] );

//Route::put('events/{event}', [EventsController::class, 'updateAutomat'] );
//Route::delete('events/{event}', [EventsController::class, 'delete'] );

/// work route-groups použi groupu:
//Route::resource('events', EventsController::class)->only(['create', 'index', 'show', 'update', 'destroy']);; 

Route::apiResource('events', EventsController::class);




