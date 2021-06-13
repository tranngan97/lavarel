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
        return view('Admin.dashboard',
            ['staffs' => $staffs, 'newstaffs' => $newStaffs, 'timesheets' => $pendingTimesheets, 'requests' => $pendingRequests]);
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
        paysheetModel::insertPaysheet([
            'timesheet_id' => $request->txtTimesheetId,
            'staff_id' => $request->txtStaffId,
            'month' => $request->txtMonth
        ]);
        return redirect()->route('paysheetList');
    }
}
