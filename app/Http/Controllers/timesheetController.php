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
        $statuses = [
            0 => 'Pending',
            1 => 'Approved',
            2 => 'Reject'
        ];
    	return view('Admin.Timesheet.timesheetList',['timesheets' => $timesheets,'statuses' => $statuses]);
    }

    public function staffTimesheetList()
    {
        $statuses = [
            0 => 'Pending',
            1 => 'Approved',
            2 => 'Reject'
        ];
        $timesheets = timesheetModel::getByStaffId(session()->get('staff_id'));
        return view('Staff.timesheet',['timesheets' => $timesheets, 'statuses' => $statuses]);
    }

    public function approvedTimesheet()
    {
        $request= Request::capture();
        timesheetModel::updateTimesheet([
            'timesheet_id'=> $request->id,
            'status' => '1'
        ]);
        $notification = array(
            'message' => trans('lang.success_approved_timesheet'),
            'alert-type' => 'success'
        );
        return redirect()->route('timesheetList')->with($notification);
    }
    public function deleteTimesheet(Request $request)
    {
        timesheetModel::deleteTimesheet($request->id);
        $notification = array(
            'message' => trans('lang.success_delete_timesheet'),
            'alert-type' => 'success'
        );
        return redirect()->route('timesheetList')->with($notification);
    }
}
