<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\PostImages;
use App\Models\PostSources;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PostController extends Controller
{

    public function save(Request $request)
    {
        $data = new Post([
            "user_id"       => $request->get('user_id'),
            "target_group"  => $request->get('target_group'),
            "type"          => $request->get('type'),
            "post_details"  => $request->get('post_details')            
        ]);
        $data->save();
        if (!empty($data->id)) {
            if ($request->get('sourceid')==1) {// Üye
                $datasource = new PostSources([
                    "post_id"       => $data->id,
                    "user_id"    => $request->get('user_id')
                ]);
            }else if($request->get('sourceid')==2){ // Sayfa
                $datasource = new PostSources([
                    "post_id" => $data->id,
                    "pages_id" => $request->get('pages_id')
                ]);
            }else if($request->get('sourceid')==3){
                $datasource = new PostSources([
                    "post_id"   => $data->id,
                    "group_id"  => $request->get('group_id')
                ]);                
            } else {
                $datasource = new PostSources([
                    "post_id"       => $data->id,
                    "user_id"    => $request->get('user_id')
                ]);                
            }
            $datasource->save();            
        }     
        return response()->json($data);
    }
    //Post
    public function imagestore(Request $request)
    {

        $data = new Post([
            "user_id"       => $request->get('user_id'),
            "target_group"  => $request->get('target_group'),
            "type"          => $request->get('type'),
            "post_details"  => $request->get('post_details')    
        ]);
        $data->save();
        if (!empty($data->id)) {
            $validateImageData = $request->validate([
                'images'    => 'required',
                'images.*'  => 'mimes:jpg,png,jpeg,gif,svg'
            ]);          
            if($request->hasfile('images'))
            {
                foreach($request->file('images') as $key => $file)
                {
                    $path = $file->store('uploads/post');
                    $name = rand(0,999999).$file->getClientOriginalName();
                    if($file->move('uploads/post', $name)) {
                        $insert[$key]['post_id']            = $data->id;
                        $insert[$key]['original_filename']  = $request->get('post_details');
                        $insert[$key]['filename_path']      = env('APP_URL').'/uploads/post/'.$name;
                    }
                }
            }
            PostImages::insert($insert);           

            if ($request->get('sourceid')==1) {// Üye
                $datasource = new PostSources([
                    "post_id"       => $data->id,
                    "user_id"    => auth()->user()->id
                ]);
            }else if($request->get('sourceid')==2){ // SAyfa
                $datasource = new PostSources([
                    "post_id" => $data->id,
                    "pages_id" => $request->get('pages_id')
                ]);
            }else if($request->get('sourceid')==3){ // SAyfa
                $datasource = new PostSources([
                    "post_id" => $data->id,
                    "group_id"  => $request->get('group_id')
                ]);
            } else {
                $datasource = new PostSources([
                    "post_id"       => $data->id,
                    "user_id"    => $request->get('user_id')
                ]);                
            }
            $datasource->save();            
        }
        return response()->json($data);
    }   
    public function update(Request $request,$id)
    {
        $post = Post::findOrFail($id);
        $post->update($request->all());
        return response()->json($post);
    }
    public function delete($id)
    {
        $post = Post::findOrFail($id)->delete();
        return response()->json("Post Silindi");
    }
}