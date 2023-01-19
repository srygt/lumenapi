<?php

namespace App\Http\Controllers;

use App\Models\Events;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EventsController extends Controller
{

    public function getEvents()
    {
        $events = Events::where("events_status",1)->get();
        return response()->json($events);
    }

}