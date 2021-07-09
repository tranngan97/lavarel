<?php

namespace App\Http\Controllers;

use App\paysheetModel;
use App\timesheetModel;
use Illuminate\Http\Request;
use App\adminModel;
use App\staffModel;
use App\requestModel;
//use Session;
class adminController extends Controller
{
    //
    public function mainPage()
    {
        $staffs = staffModel::getAll();
        $newStaffs = staffModel::getNewStaffs();
        $pendingTimesheets = timesheetModel::getPendingTimesheet();
        $pendingRequests = requestModel::getPendingRequest();
        $months = ['1','2','3','4','5','6','7'];
        $totalStaff = [];
        $staffsCount= [];
        foreach ($months as $month){
            $staffCount = 0;
            foreach (staffModel::getAll() as $staff){
                if (date('m', strtotime($staff->created_at)) == $month){
                    $staffCount = $staffCount + 1;
                }
            }
            $staffsCount[] = $staffCount;
            $totalStaff[] = count(staffModel::getAll());
        }
        return view('Admin.dashboard', [
            'staffs' => $staffs,
            'newstaffs' => $newStaffs,
            'timesheets' => $pendingTimesheets,
            'requests' => $pendingRequests,
            'months' => json_encode($months,JSON_NUMERIC_CHECK),
            'totalStaff' => json_encode($totalStaff,JSON_NUMERIC_CHECK),
            'staffCount' => json_encode($staffsCount,JSON_NUMERIC_CHECK)
        ]);
    }
    public function login()
    {
        if(session()->has('admin_email'))
        {
            return redirect()->route('Admindashboard');
        }
        return view('Admin.login');
    }
    public function loginProcess(Request $request)
    {
    	$obj = new adminModel();
    	$obj->admin_email = $request->txtEmail;
    	$obj->admin_pass = md5($request->txtPass);
    	$check = adminModel::checkRow($obj);
    	if($check > 0)
    	{
            $getName = adminModel::getById($obj->admin_email);
            $objName = $getName[0];
    		session()->put([
            'admin_email' => $obj->admin_email,
            'admin_name' => $objName->admin_name,
        ]);
    		return redirect()->route('Admindashboard');
    	}else
    	{
    		return redirect()->route('adminLogin')->with("err","Please, try again!");
    	}
    }

    public function addPaysheetProcess(Request $request)
    {
        $isValid = timesheetModel::getById($request->txtTimesheetId);
        foreach ($isValid as $valid){
            if ($valid->staff_id == $request->txtStaffId && $valid->month === $request->txtMonth){
                paysheetModel::insertPaysheet([
                    'timesheet_id' => $request->txtTimesheetId,
                    'staff_id' => $request->txtStaffId,
                    'month' => $request->txtMonth
                ]);
                $notification = array(
                    'message' => 'Paysheet added successfully for '.$valid->staff_name . ' on '.$request->txtMonth,
                    'alert-type' => 'success'
                );
                return redirect()->route('paysheetList')->with($notification);
            }
        }
        $notification = array(
            'message' => 'There no such timesheet for staff '.$valid->staff_name . ' on '.$request->txtMonth,
            'alert-type' => 'error'
        );
        return redirect()->route('paysheetList')->with($notification);
    }
}
