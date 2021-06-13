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

    public function approvedRequest()
    {
        $request= Request::capture();
        requestModel::updateData($request->id,['status' => '1']);
        $notification = array(
            'message' => trans('lang.success_approved_request'),
            'alert-type' => 'success'
        );
        return redirect()->route('requestList')->with($notification);
    }
    public function deleteRequest()
    {
        $request= Request::capture();
        requestModel::deleteRequest($request->id);
        $notification = array(
            'message' => trans('lang.success_delete_request'),
            'alert-type' => 'success'
        );
        return redirect()->route('requestList')->with($notification);
    }
}
