<?php

namespace App\Http\Controllers;

use App\Models\Campaigns;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CampaignsController extends Controller
{

    public function getCampaigns()
    {
        $campaings = Campaigns::get();
        return response()->json($campaings);
    }

}