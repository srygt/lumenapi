<?php

namespace App\Http\Controllers;

use App\Models\BlogComment;
use App\Models\BlogPoints;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{

    public function getBlog()
    {
        return response()->json(Blog::with("comments",with("points"))->get());
    }

    public function save(Request $request)
    {
        $data = new BlogComment([
            "blog_id"                       => $request->get('blog_id'),
            "user_id"                       => $request->get('user_id'),
            "followers_ip"                  => request()->ip(),
            "pharma_blog_comments_details"  => $request->get('pharma_blog_comments_details')            
        ]);
        $data->save();   
        return response()->json($data);
    }    

    public function pointSave(Request $request)
    {
        $data = new BlogPoints([
            "blog_id"                       => $request->get('blog_id'),
            "user_id"                       => $request->get('user_id'),
            "follow"                        => $request->get('follow'),
            "unfollow"                      => $request->get('unfollow')          
        ]);
        $data->save();   
        return response()->json($data);
    }      
}
