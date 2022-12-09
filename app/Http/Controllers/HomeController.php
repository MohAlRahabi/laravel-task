<?php

namespace App\Http\Controllers;

use App\Http\Resources\BlogResource;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HomeController extends Controller
{

    public function generateUuid()
    {
        $uuid = Str::uuid()->toString();
        return response()->json(['uuid'=>$uuid]);
    }

    public function getBlogs()
    {
        $blogs = Blog::all();
        if(count($blogs) > 0)
            return response()->json(['data'=>BlogResource::collection($blogs)],200);
        return response()->json(['data'=>[]],200);
    }

    public function viewBlog($id)
    {
        $blog = Blog::find($id);
        if($blog)
            return response()->json(['data'=>new BlogResource($blog)],200);
        return response()->json(['data'=>null],200);
    }

    public function singleBlog()
    {
        return view('frontend.blogs.single');
    }
}
