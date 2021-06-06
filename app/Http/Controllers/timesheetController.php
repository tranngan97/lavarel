<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\timesheetModel;

class timesheetController extends Controller
{
    //
    public function timesheetList()
    {
    	$timesheets = timesheetModel::all();
    	return view('Admin.Timesheet.timesheetList',['timesheets' => $timesheets]);
    }

    public function approvedTimesheet($request)
    {
        timesheetModel::where('timesheet_id',$request->id)([
            'status' => '1'
        ]);
        $notification = array(
            'message' => trans('lang.success_approved_timesheet'),
            'alert-type' => 'success'
        );
        return redirect()->route('timesheetList')->with($notification);
    }
    public function deleteTimesheet($request)
    {
        timesheetModel::deleteTimesheet($request->id);
        $notification = array(
            'message' => trans('lang.success_delete_timesheet'),
            'alert-type' => 'success'
        );
        return redirect()->route('timesheetList')->with($notification);
    }
}
