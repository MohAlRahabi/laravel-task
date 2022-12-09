<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubscriberRequest;
use App\Http\Requests\StoreUpdateBlogRequest;
use App\Http\Requests\UpdateSubscriberRequest;
use App\Models\Blog;
use App\Models\User;
use App\Traits\FileHandler;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class BlogController extends Controller {

    use FileHandler;

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * return blogs view
     * @return Application|Factory|View|JsonResponse
     */
    public function index()
    {
        return view('dashboard.blogs.index');
    }

    /**
     * return data of all blogs
     * @return JsonResponse
     * @throws Exception
     */
    public function data()
    {
        $items = Blog::query()->select('blogs.*');
        return DataTables::eloquent($items)
            ->addColumn('action', function ($item) {
                return '<a class="edit btn btn-xs btn-dark" style="color:#fff"><i class="fas fa-pen"></i> Edit</a>
                        <a class="delete btn btn-xs btn-danger" style="color:#fff"><i class="fas fa-trash"></i> Delete</a>';
            })
            ->make(true);
    }

    /**
     * Store a newly created resource in database.
     * @param StoreUpdateBlogRequest $request
     * @return JsonResponse
     */
    public function store(StoreUpdateBlogRequest $request)
    {
        $blog = Blog::create($request->only([
            'title',
            'content',
            'publish_date',
            'status',
        ]));
        if($request->has('image')){
            $blog->image = $this->storeFile($request->image,'blogs');
            $blog->save();
        }
        return response()->json(['status'=>201,'message'=>"Created Successfully"],201);
    }

    /**
     * Update the specified resource in database.
     * @param  StoreUpdateBlogRequest $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(StoreUpdateBlogRequest $request, $id)
    {
        $blog = Blog::findOrFail($id);
        $blog->update($request->only([
            'title',
            'content',
            'publish_date',
            'status',
        ]));
        if($request->has('image')){
            $blog->image = $this->updateFile($request->image,$blog->image,'blogs');
            $blog->save();
        }
        return response()->json(['status'=>200,'message'=>"Updated Successfully"],200);
    }

    /**
     * Remove the specified resource from database.
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        if($blog->image)
            $this->deleteFile(str_replace(asset('storage/'),'',$blog->image));
        $blog->delete();
        return response()->json(['status'=>200,'message' => 'Successfully Deleted!'],200);
    }

    public function deleteImage($id)
    {
        $model = Blog::findOrFail($id);
        if($this->deleteFile(str_replace(asset('storage/'),'',$model->image))) {
            $model->image = null;
            $model->save();
            return response()->json(['status'=>200,'message' => 'Successfully Deleted!'],200);
        }
        return response()->json(['message' => 'Delete Failed!']);
    }
}
