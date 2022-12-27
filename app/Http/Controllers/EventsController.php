<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;
use Response;

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
        //otazka, preco mi neprechadza tato validacia? 
        // $validated = $request->validate([
        //     'street' => 'required',
        //     'city_postcode' => 'required',
        // ]);
        
        $event = Event::find($id);
        $event->update($request->all());

        return Response::json(Event::find($id));    
    }

    public function dellEventById($id)
    {
        $event = Event::find($id);
        $event->delete();

        return Response::json(Event::all());
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
}
