<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewsController extends Controller
{

    public function getNews()
    {
        $news = News::where("news_status",1)->get();
        return response()->json($news);
    }
    public function getNewsCategory()
    {
        $news = NewsCategory::where("news_status",1)->get();
        return response()->json($news);
    }

}