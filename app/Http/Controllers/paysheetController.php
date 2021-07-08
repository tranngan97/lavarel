<?php

namespace App\Http\Controllers;

use App\noticeModel;
use App\staffModel;
use App\timesheetModel;
use Illuminate\Http\Request;
use App\paysheetModel;
class paysheetController extends Controller
{
    //
    public function paysheetList()
    {
    	$paysheets = paysheetModel::getAll();
    	return view('Admin.Paysheet.paysheetList',['paysheets' => $paysheets]);
    }

    public function addPaysheet()
    {
        $timesheets = timesheetModel::getApprovedTimesheet();
        $staffs = staffModel::getAll();
        return view('Admin.Paysheet.addPaysheet',['timesheets' => $timesheets,'staffs'=>$staffs]);
    }

    public function viewPaysheet()
    {
        $request = Request::capture();
        $paysheet = paysheetModel::getById($request->id);
        foreach ($paysheet as $paysheet){
            $staff = staffModel::getAll();
            $timesheet = timesheetModel::getAll();
            return view('Admin.Paysheet.viewPaysheet',['paysheet' => $paysheet,'staffs' => $staff, 'timesheets' => $timesheet]);
        }
    }

    public function viewStaffPaysheetDetail()
    {
        $notifiers = noticeModel::getByStaffId(session()->get('staff_id'));
        $request = Request::capture();
        $paysheet = paysheetModel::getById($request->id);
        foreach ($paysheet as $paysheet){
            $staff = staffModel::getAll();
            $timesheet = timesheetModel::getAll();
            return view('Staff.viewPaysheet',['paysheet' => $paysheet,'staffs' => $staff, 'timesheets' => $timesheet,'notifiers' => $notifiers]);
        }
    }

    public function viewPaysheetDetail()
    {
        $request = Request::capture();
        $paysheet = paysheetModel::getById($request->id);
        foreach ($paysheet as $paysheet){
            $staff = staffModel::getAll();
            $timesheet = timesheetModel::getAll();
            return view('Admin.Paysheet.viewPaysheet',['paysheet' => $paysheet,'staffs' => $staff, 'timesheets' => $timesheet]);
        }
    }

    public function deletePaysheet()
    {
        $request = Request::capture();
        paysheetModel::deletePaysheet($request->id);
        $notification = array(
            'message' => trans('lang.success_delete_request'),
            'alert-type' => 'success'
        );
        return redirect()->route('paysheetList')->with($notification);
    }

    public function deleteStaffPaysheet()
    {
        $request = Request::capture();
        paysheetModel::deletePaysheet($request->id);
        $notification = array(
            'message' => trans('lang.success_delete_request'),
            'alert-type' => 'success'
        );
        return redirect()->route('paysheet')->with($notification);
    }
}
