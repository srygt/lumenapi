<?php

namespace App\Http\Controllers;

use App\Models\Campaigns;
use App\Models\Education;
use App\Models\EducationCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EducationController extends Controller
{

    public function getEducation()
    {
        $education = Education::where("education_status",1)->get();
        return response()->json($education);
    }
    public function getEducationCategory()
    {
        $education = EducationCategory::where("education_status",1)->get();
        return response()->json($education);
    }

}