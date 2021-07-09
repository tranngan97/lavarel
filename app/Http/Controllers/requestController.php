<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\requestModel;
use App\noticeModel;

class requestController extends Controller
{
    //
    public function requestList()
    {
    	$requests = requestModel::all();
    	return view('Admin.Request.requestList',['requests' => $requests]);
    }

    public function viewRequest(Request $request)
    {
    	$request = requestModel::getById($request->id);
        $months = [
            1 => 'JAN',
            2 => 'FEB',
            3 => 'MAR',
            4 => 'APR',
            5 => 'MAY',
            6 => 'JUN',
            7 => 'JULY',
            8 => 'AUG',
            9 => 'SEP',
            10 => 'OCT',
            11 => 'NOV',
            12 => 'DEC'
        ];
    	$types = [
    	    'paid_leave' => 'Paid Leaves',
            'unpaid_leave' => 'Unpaid Leaves'
        ];
    	return view('Admin.Request.viewRequest',['request' => $request,'types' => $types, 'months' => $months]);
    }

    public function approvedRequest()
    {
        $request= Request::capture();
        requestModel::updateData($request->id,['status' => '1']);
        $notification = array(
            'message' => trans('lang.success_approved_request'),
            'alert-type' => 'success'
        );
        noticeModel::addNewNoticeForStaff($request->id, ['action' => 2, 'model_type' => 2, 'model_id' => $request->id, 'staff_id' => $request->staff_id]);
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
        noticeModel::addNewNoticeForStaff($request->id, ['action' => 2, 'model_type' => 2, 'model_id' => $request->id, 'staff_id' => $request->staff_id]);
        return redirect()->route('requestList')->with($notification);
    }

    public function deleteStaffRequest()
    {
        $request= Request::capture();
        requestModel::deleteRequest($request->id);
        $notification = array(
            'message' => trans('lang.success_delete_request'),
            'alert-type' => 'success'
        );
        noticeModel::addNewNoticeForStaff($request->id, ['action' => 1, 'model_type' => 2, 'model_id' => $request->id, 'staff_id' => $request->staff_id]);
        return redirect()->route('requestList')->with($notification);
    }
}
