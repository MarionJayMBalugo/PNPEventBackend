<?php

namespace App\Http\Controllers\API\Events;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;

use App\Http\Controllers\API\BaseController as BaseController;
use App\Http\Controllers\Controller;
use App\Models\Events\Events;
use App\Models\User;
use App\Http\Requests\Events\EventsRequest as EventsRequest;
use App\Http\Resources\Events\Events as EventsResource;

class EventsController extends BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $eventList = Events::getEventsList( Auth::user()->id);
        return $this->successResponse(EventsResource::collection( $eventList), 'Events retrieved successfully');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\Events\EventsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventsRequest $request)
    {      
        $event = Events::addEvents( $request->all(), Auth::user()->id);
        return $this->successResponse(new EventsResource( $event), 'Event created successfully');
    }

   
    /**
     * Update the specified resource in storage.
     *`
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Http\Requests\Events\EventsRequest  $request, int $id
     * @return \Illuminate\Http\Response
     */
    public function update(EventsRequest $request, $id)
    {
        $event=Events::updateEvent( $request->all(), Auth::user()->id, $id);
        return $this->successResponse(new EventsResource( $event), 'Event updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param App\Models\Events\Events $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Events $event)
    {
        $event->deleteEvent();  
        return $this->successResponse([],'Event successfully deleted');
    }
}
