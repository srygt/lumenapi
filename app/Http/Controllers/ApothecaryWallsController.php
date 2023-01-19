<?php

namespace App\Http\Controllers;

use App\Models\ApothecaryWalls;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApothecaryWallsController extends Controller
{

    public function getWalls()
    {
        $walls = ApothecaryWalls::get();
        return response()->json($walls);
    }

}