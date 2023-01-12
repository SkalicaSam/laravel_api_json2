<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventResourceCollection;


class EventsController extends Controller
{
    // new rewiew2 for apiResource

    public function index()
    {
        $events = Event::get();   //->keyBy->id;
        //return EventResource::collection($events);
        return response()->json($events);
    }


    public function store(Request $request)
    // POST  // http://127.0.0.1:8000/api/events/
    {
        // If I use this commented lines, it..
        // throw error 302 in test_if_sendWrongDataToStore___Route_postApiEvents_ReturnAssetStatus200()
        //...if one of 2 parameters are not writen

        $validated = $request->validate([
            'city' => 'required',
            'city_postcode' => 'required',
        ]);

        // $city_postcode = $request->city_postcode;
        // $city = $request->city;
        // if (empty($city) or empty($city_postcode)) {
        //     return '$city or $city_postcode is either 0, empty, or not set at all';
        // }

        $event = Event::create($request->all());

        //return response()->json($event);
        return response()->noContent(Response::HTTP_CREATED);
    }


    public function show($event)
    {
        $event = Event::find($event);
        if ($event == null) {
            return 'Nothing to show. This Event does not exists';
        }
        $event = Event::find($event);
        //return new EventResource($event);
        return response()->json($event);
    }


    public function update(Request $request, Event $event)
    {
        // $city_postcode = $request->city_postcode;
        // $city = $request->city;
        // if (empty($city) or empty($city_postcode)) {
        //     return '$city or $city_postcode is either 0, empty, or not set at all';
        // }

        $validated = $request->validate([
            'city' => 'required',
            'city_postcode' => 'required',
        ]);

        $event->update($request->all());
        return response()->json($event);
    }


    public function destroy(Event $event)
    {
        $event->delete();
        return response()->noContent();
    }


    //end of //// new rewiew2 for apiResource


    // public function list()
    // { 
    //     return Response::json(Event::all());
    // }

    // public function showEventById($id)
    // {
    //     return Response::json(Event::find($id));
    // }

    // public function create(Request $request)
    // { 
    //     $validated = $request->validate([
    //         'city' => 'required',
    //         'city_postcode' => 'required',
    //     ]);

    //     $event = Event::create($request->all());

    //     return response()->json($event);
    // }

    // public function updateEventById($id,Request $request)
    // { 
    //     $validated = $request->validate([
    //         'city' => 'required',
    //         'city_postcode' => 'required',
    //     ]);

    //     $event = Event::find($id);
    //         if ($event){
    //             $event->update($request->all());

    //             return Response::json(Event::find($id)); 
    //         }
    //         return 'this Event does not exists';
    // }

    // public function dellEventById($id)
    // {
    //     $event = Event::find($id);
    //     if ($event){
    //         $event->delete();
    //         return Response::json(Event::all());
    //     }
    //     return 'Nothing deleted. This Event does not exists before deleting';
    // }

    // //******************************************
    // // udate and delete function as event as object //no routes for this //only copied from web  */

    // public function updateAutomat(Request $request, Event $event)
    // {
    //     $event->update($request->all());
    //     return response()->json($event);
    // }

    // public function delete(Event $event)
    // {
    //     $event->delete();
    //     return response()->json(null, 204);
    // }


    // //******************************************
    // // function for route-froups:

    //     public function index()
    //     { 
    //         //return Response::json(Event::all());

    //         $events = Event::get()->keyBy->id;
    //         //return new EventResourceCollection($events);
    //         return EventResource::collection($events);

    //     }

    //     // create is above //Route::get('events/create',


    // //******************************************  //******************************************
    //     //Route::get('events/{event}', [EventsController::class, 'show']);
    //     public function show($event)
    //     {
    //         //return Response::json(Event::find($event));

    //         $event = Event::find($event);
    //         return new EventResource($event);

    //     }


    //     //Route::put('events/{event}', [EventsController::class, 'update']);
    //     public function update($id,Request $request)
    //     { 
    //         $validated = $request->validate([
    //             'city' => 'required',
    //             'city_postcode' => 'required',
    //         ]);

    //         $event = Event::find($id);
    //         if ($event){
    //             $event->update($request->all());

    //             return Response::json(Event::find($id)); 
    //         }
    //         return 'this Event does not exists';

    //     }


    //     //Route::delete('events/{event}', [EventsController::class, 'destroy']);
    //     public function destroy(Event $event)
    //     {
    //         if ($event){
    //             $event->delete();
    //             response()->json(null, 204);
    //         }
    //         return 'this Event does not exists';

    //     }







}
