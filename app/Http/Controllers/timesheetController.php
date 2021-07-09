<?php

namespace App\Http\Controllers;

use App\noticeModel;
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

    public function viewTimeSheet(Request $request)
    {
        $timesheets = timesheetModel::getById($request->id);
        $statuses = [
            0 => 'Pending',
            1 => 'Approved',
            2 => 'Reject'
        ];
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
    	return view('Admin.Timesheet.viewTimeSheet',['timesheets' => $timesheets,'statuses' => $statuses,'months' => $months]);
    }

    public function staffTimesheetList()
    {
        $notifiers = noticeModel::getByStaffId(session()->get('staff_id'));
        $statuses = [
            0 => 'Pending',
            1 => 'Approved',
            2 => 'Reject'
        ];
        $timesheets = timesheetModel::getByStaffId(session()->get('staff_id'));
        return view('Staff.timesheet',['timesheets' => $timesheets, 'statuses' => $statuses,'notifiers' => $notifiers]);
    }

    public function viewStaffTimesheet()
    {
        $notifiers = noticeModel::getByStaffId(session()->get('staff_id'));
        $statuses = [
            0 => 'Pending',
            1 => 'Approved',
            2 => 'Reject'
        ];
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
        $timesheets = timesheetModel::getByStaffId(session()->get('staff_id'));
        return view('Staff.viewStaffTimesheet',['timesheets' => $timesheets, 'statuses' => $statuses, 'months' => $months,'notifiers' => $notifiers]);
    }

    public function deleteStaffTimesheet(Request $request)
    {
        $notifiers = noticeModel::getByStaffId(session()->get('staff_id'));
        $statuses = [
            0 => 'Pending',
            1 => 'Approved',
            2 => 'Reject'
        ];
        timesheetModel::deleteTimesheet($request->id);
        $timesheets = timesheetModel::getByStaffId(session()->get('staff_id'));
        return view('Staff.timesheet',['timesheets' => $timesheets, 'statuses' => $statuses,'notifiers' => $notifiers]);
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
        noticeModel::addNewNoticeForStaff($request->id, ['action' => 2, 'model_type' => 1, 'model_id' => $request->id, 'staff_id' => $request->staff_id]);
        return redirect()->route('timesheetList')->with($notification);
    }
    public function deleteTimesheet(Request $request)
    {
        timesheetModel::deleteTimesheet($request->id);
        $notification = array(
            'message' => trans('lang.success_delete_timesheet'),
            'alert-type' => 'success'
        );
        noticeModel::addNewNoticeForStaff($request->id, ['action' => 1, 'model_type' => 1, 'model_id' => $request->id, 'staff_id' => $request->staff_id]);
        return redirect()->route('timesheetList')->with($notification);
    }
}
