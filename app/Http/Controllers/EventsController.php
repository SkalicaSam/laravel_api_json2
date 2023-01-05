<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Response;
use App\Http\Resources\EventResource;
use App\Http\Resources\EventResourceCollection;


class EventsController extends Controller
{
    public function list()
    { 
        return Response::json(Event::all());
    }

    public function showEventById($id)
    {
        return Response::json(Event::find($id));
    }

    public function create(Request $request)
    { 
        $validated = $request->validate([
            'city' => 'required',
            'city_postcode' => 'required',
        ]);

        $event = Event::create($request->all());

        return response()->json($event);
    }

    public function updateEventById($id,Request $request)
    { 
        $validated = $request->validate([
            'city' => 'required',
            'city_postcode' => 'required',
        ]);

        $event = Event::find($id);
            if ($event){
                $event->update($request->all());

                return Response::json(Event::find($id)); 
            }
            return 'this Event does not exists';
    }

    public function dellEventById($id)
    {
        $event = Event::find($id);
        if ($event){
            $event->delete();
            return Response::json(Event::all());
        }
        return 'Nothing deleted. This Event does not exists before deleting';
    }

    //******************************************
    // udate and delete function as event as object //no routes for this //only copied from web  */

    public function updateAutomat(Request $request, Event $event)
    {
        $event->update($request->all());
        return response()->json($event);
    }

    public function delete(Event $event)
    {
        $event->delete();
        return response()->json(null, 204);
    }


    //******************************************
    // function for route-froups:

        public function index()
        { 
            //return Response::json(Event::all());

            $events = Event::get()->keyBy->id;
            //return new EventResourceCollection($events);
            return EventResource::collection($events);
            
        }

        // create is above //Route::get('events/create',


    //******************************************  //******************************************
        //Route::get('events/{event}', [EventsController::class, 'show']);
        public function show($event)
        {
            //return Response::json(Event::find($event));

            $event = Event::find($event);
            return new EventResource($event);

        }


        //Route::put('events/{event}', [EventsController::class, 'update']);
        public function update($id,Request $request)
        { 
            $validated = $request->validate([
                'city' => 'required',
                'city_postcode' => 'required',
            ]);
          
            $event = Event::find($id);
            if ($event){
                $event->update($request->all());

                return Response::json(Event::find($id)); 
            }
            return 'this Event does not exists';
               
        }


        //Route::delete('events/{event}', [EventsController::class, 'destroy']);
        public function destroy(Event $event)
        {
            if ($event){
                $event->delete();
                response()->json(null, 204);
            }
            return 'this Event does not exists';

        }




    


}
