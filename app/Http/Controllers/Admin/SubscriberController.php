<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSubscriberRequest;
use App\Http\Requests\UpdateSubscriberRequest;
use App\Models\User;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Yajra\DataTables\Facades\DataTables;

class SubscriberController extends Controller {

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * return subscriber view
     * @return Application|Factory|View|JsonResponse
     */
    public function index()
    {
        return view('dashboard.users.index');
    }

    /**
     * return data of all subscribers
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    public function data(Request $request)
    {
        $items = User::query()->select('users.*');
        return DataTables::eloquent($items)
            ->addColumn('action', function ($item) {
                return '<a class="edit btn btn-xs btn-dark" style="color:#fff"><i class="fas fa-pen"></i> Edit</a>
                        <a class="delete btn btn-xs btn-danger" style="color:#fff"><i class="fas fa-trash"></i> Delete</a>';
            })
            ->filter(function ($query) use ($request){
                if($request->has('adName') && $request->adName ){
                    $name = $request->adName;
                    $query->where('name',"LIKE","%$name%");
                }
                if($request->has('adUsername') && $request->adUsername ){
                    $username = $request->adUsername;
                    $query->where('username',"LIKE","%$username%");
                }
                if($request->has('adStatus') && $request->adStatus ){
                    $status = $request->adStatus;
                    $query->where('status',"LIKE","%$status%");
                }
            },true)
            ->make(true);
    }

    /**
     * Store a newly created resource in database.
     * @param StoreSubscriberRequest $request
     * @return JsonResponse
     */
    public function store(StoreSubscriberRequest $request)
    {
        User::create($request->validated());
        return response()->json(['status'=>201,'message'=>"Created Successfully"],201);
    }

    /**
     * Update the specified resource in database.
     * @param  UpdateSubscriberRequest $request
     * @param  int  $id
     * @return JsonResponse
     */
    public function update(UpdateSubscriberRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->validated());
        return response()->json(['status'=>200,'message'=>"Updated Successfully"],200);
    }

    /**
     * Update the specified resource in database.
     * @param int $id
     * @return void
     */
    public function show($id)
    {

    }

    /**
     * Remove the specified resource from database.
     * @param  int  $id
     * @return JsonResponse
     */
    public function destroy($id)
    {
        $model = User::findOrFail($id);
        $model->username = $model->username . now()->toString();
        $model->save();
        $model->delete();
        return response()->json(['status'=>200,'message' => 'Successfully Deleted!'],200);
    }
}
