<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\requestModel;

class requestController extends Controller
{
    //
    public function requestList()
    {
    	$requests = requestModel::all();
    	return view('Admin.Request.requestList',['requests' => $requests]);
    }

    public function approvedReqquest($request)
    {
        requestModel::where('request_id',$request->id)([
            'status' => '1'
        ]);
        $notification = array(
            'message' => trans('lang.success_approved_request'),
            'alert-type' => 'success'
        );
        return redirect()->route('requestList')->with($notification);
    }
    public function deleteReqquest($request)
    {
        requestModel::deleteRequest($request->id);
        $notification = array(
            'message' => trans('lang.success_delete_request'),
            'alert-type' => 'success'
        );
        return redirect()->route('requestList')->with($notification);
    }
}
