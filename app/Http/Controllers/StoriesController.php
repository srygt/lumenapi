<?php

namespace App\Http\Controllers;

use App\Models\Stories;
use App\Models\StoriesViews;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StoriesController extends Controller
{
    public function getStories($userid=null)
    {
        return response()->json(Stories::with("storiesviews")->where("user_id",$userid)->get());

    }
    public function stroiesSave(Request $request)
    {
        if ($request->get('story_images')==null) {
            $data = new Stories([
                "user_id" => $request->get('user_id'),
                "story_name" => $request->get('story_name'),
                "story_images" => $request->get('story_images')
            ]);
            $data->save();
            return response()->json($data);
        } else if(!empty($request->get('story_images'))){

            if ($request->hasfile('story_images')) {
                foreach ($request->file('story_images') as $key => $file) {
                    $path = $file->store('uploads/story');
                    $name = rand(0, 999999) . $file->getClientOriginalName();
                    if ($file->move('uploads/story', $name)) {
                        $insert[$key]['user_id'] = $request->get('user_id');
                        $insert[$key]['story_name'] = $request->get('story_name');
                        $insert[$key]['story_images'] = env('APP_URL') . '/uploads/story/' . $name;
                    }
                }
            }
            return response()->json(Stories::insert($insert));
        }
    }
    public function stroiesViewSave(Request $request)
    {
        $data = new StoriesViews([
            "user_id"       => $request->get('user_id'),
            "story_id"      => $request->get('story_id'),
            "view_date"     => $request->get('view_date'),
            "view_status"   => $request->get('view_status')
        ]);
        $data->save();
        return response()->json($data);        
    }    
    public function delete($id)
    {
        $post = Stories::findOrFail($id)->delete();
        return response()->json("Post Silindi");
    }
}