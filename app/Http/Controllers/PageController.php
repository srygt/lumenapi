<?php

namespace App\Http\Controllers;

use App\Models\PagesCategory;
use App\Models\PagesDocumentsComments;
use App\Models\PagesDocumentsPoints;
use App\Models\Pagesfollowers;
use App\Models\PostComment;
use App\Models\PostSources;
use Illuminate\Http\Request;
use App\Models\Pages;
use Illuminate\Support\Facades\DB;

class PageController extends Controller
{
    public function index($userid=null)
    {
        $page = DB::table('pharma_pages')
            ->join('pharma_pages_categories','pharma_pages.category_id','=','pharma_pages_categories.id')
            ->leftJoin('pharma_pages_followers','pharma_pages_followers.pages_id','=','pharma_pages.id')
            ->select('pharma_pages.id',DB::raw('count(pharma_pages.id) as total'),'pharma_pages.pharma_pages_name','pharma_pages.pharma_pages_avatar',
            'pharma_pages.pharma_pages_details','pharma_pages.pharma_pages_name_url','pharma_pages.pharma_pages_timeline_image')
            ->where('pharma_pages.user_id',$userid)
            ->where('pharma_pages.pages_status',1)
            ->orderBy('pharma_pages.id','desc')
            ->groupBy('pharma_pages.id','pharma_pages.pharma_pages_timeline_image','pharma_pages.pharma_pages_name','pharma_pages.pharma_pages_avatar','pharma_pages.pharma_pages_name_url','pharma_pages.pharma_pages_details')
            ->get();
        return response()->json($page);
    }


    public function getPost()
    {
        return response()->json(PostSources::with("post",with("comments"),with("pages"),with("points"))->get());

    }

    // public function getFollow($postid=null)
    // {
    //     $getpost = DB::table('pharma_pages_documents_points')
    //     ->where('post_id',$postid)
    //     ->where('follow','>',0)
    //     ->count('follow');
    //     return response()->json($getpost);
    // }
    // public function getUnFollow($postid=null)
    // {
    //     $getpost = DB::table('pharma_pages_documents_points')
    //     ->where('post_id',$postid)
    //     ->where('unfollow','>',0)
    //     ->count('unfollow');
    //     return response()->json($getpost);
    // }
    public function getPostImages($url=null)
    {
        $getpost = DB::table('pharma_post_sources')
        ->join('pharma_posts','pharma_post_sources.post_id','=','pharma_posts.id')
        ->join('pharma_pages','pharma_post_sources.pages_id','=','pharma_pages.id')
        ->join('pharma_post_images','pharma_post_images.post_id','=','pharma_posts.id')
        ->select('pharma_post_images.*')
        ->where('pharma_pages.pharma_pages_name_url',$url)
        ->orderBy('pharma_post_images.id','desc')
        ->get();
        return response()->json($getpost);
    }


}
