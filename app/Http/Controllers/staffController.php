<?php

namespace App\Http\Controllers;

use App\paysheetModel;
use App\requestModel;
use App\timesheetModel;
use Illuminate\Http\Request;
use App\staffModel;
use App\timesheetImport;
use Illuminate\Support\Facades\Date;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
class staffController extends Controller
{
    //Sale Controller for Admin use
    public function staffList()
    {
        $staffs = staffModel::getAll();
    	return view('Admin.Staff.salesListtest',['staffs' => $staffs]);
    }
    public function addStaffProcess(Request $request)
    {
        $count = staffModel::where('staff_email',$request->txtEmail)->count();
        if($count == 0)
        {
            $filename = 'user.png';
            if($request->hasFile('avatar'))
            {
                $avatar = $request->file('avatar');
                $filename = time() . '.' . $avatar->getClientOriginalExtension();
                Image::make($avatar)->resize(300,300)->save( public_path('/images/' . $filename) );
            }
            $now = Date::now();
            staffModel::insert([
                'created_at' => $now,
                'staff_name' => $request->txtName,
                'staff_email' => $request->txtEmail,
                'staff_pass' => md5($request->txtPass),
                'staff_phone' => $request->txtPhone,
                'staff_avatar' => 'images/' . $filename,
                'staff_department' => $request->txtDepartment,
                'staff_level' => $request->txtLevel,
                'staff_cert' => $request->txtCert,
                'staff_dob' => $request->txtDob,
                'social_insurance' => $request->txtSocialIns,
                'health_insurance' => $request->txtHealthIns,
                'staff_gross' => $request->txtGross,
                'bank_account' => $request->txtBank,
            ]);
            $notification = array(
                    'message' => trans('lang.success_insert_sale'),
                    'alert-type' => 'success'
                );
            return redirect()->route('staffList')->with($notification);
        }else {
           $notification = array(
                    'message' => trans('lang.failed_insert_sale'),
                    'alert-type' => 'error'
                );
           return back()->with($notification);
        }
    }

    //Sale Controller for Sale use
    public function dashboard()
    {
        return view('Staff.dashboard');
    }
    public function login()
    {
        if(session()->has('staff_email'))
        {
            //
            return redirect()->route('dashboard');
        }
        return view('Staff.login');
    }
    public function loginProcess(Request $request)
    {
        $obj = new staffModel();
        $obj->staff_email = $request->txtEmail;
        $obj->staff_pass = md5($request->txtPass);
        $check = staffModel::checkRow($obj);
        if($check > 0)
        {
            $staff = staffModel::where('staff_email','=',$obj->staff_email)->first();
            session()->put([
            'staff_id' => $staff->staff_id,
            'staff_email' => $staff->staff_email,
            'staff_name' => $staff->staff_name,
        ]);
        $notification = array(
                'message' => 'Welcome to Staff Dashboard!',
                'alert-type' => 'success'
            );
           return redirect()->route('dashboard')->with($notification);
        }else
        {
            return redirect()->route('staffLogin')->with("err","Please, try again!");
        }
    }
    public function profile()
    {
        $profile = staffModel::where('staff_id',session('staff_id'))->first();
        $departments = [
            1 => 'IT Department',
            2 => 'Finance Department',
            3 => 'Customer Department'
        ];
        $levels = [
            1 => 'Fresher',
            2 => 'Junior',
            3 => 'Middle',
            4 => 'Senior'
        ];
        $certificates = [
            1 => 'University',
            2 => 'Collage',
            3 => 'Academy'
        ];
        return view('Staff.profile',['profile' => $profile,'departments'=>$departments, 'levels' =>$levels, 'certificates' =>$certificates]);
    }
    public function changePasswordProcess(Request $request)
    {
        $check = staffModel::where('staff_id',session()->get('staff_id'))->where('staff_pass',md5($request->password))->count();
        if($check == 0){
            $notification = $notification = array(
                'message' => trans('lang2.wrong_pass'),
                'alert-type' => 'error'
            );
        }else {
            staffModel::where('staff_id',session()->get('staff_id'))->update([
                'staff_pass' => md5($request->npassword),
            ]);
            $notification = $notification = array(
                'message' => trans('lang2.change_pass'),
                'alert-type' => 'success'
            );
        }
        return back()->with($notification);
    }
    public function changeAvatar(Request $request)
    {
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save( public_path('/images/' . $filename) );
            staffModel::where('staff_id',session('staff_id'))->update([
                'staff_avatar' => 'images/' . $filename,
            ]);
        }
        return back();
    }

    public function viewStaff($id)
    {
        $staff = staffModel::where('staff_id',$id)->first();
        $departments = [
            1 => 'IT Department',
            2 => 'Finance Department',
            3 => 'Customer Department'
        ];
        $levels = [
           1 => 'Fresher',
           2 => 'Junior',
           3 => 'Middle',
           4 => 'Senior'
        ];
        $certificates = [
            1 => 'University',
            2 => 'Collage',
            3 => 'Academy'
        ];
        return view('Admin.Staff.viewStaff',['staff' => $staff,'departments'=>$departments, 'levels' =>$levels, 'certificates' =>$certificates]);
    }

    public function editStaff(Request $request)
    {
        staffModel::where('staff_id',$request->txtId)->update([
            'staff_name' => $request->txtFirstName,
            'staff_dob' => $request->txtDob,
            'staff_phone' => $request->txtPhone,
            'staff_department' => $request->txtDepartment,
            'staff_level' => $request->txtLevel,
            'staff_cert' => $request->txtCert,
            'staff_gross' => $request->txtGross,
            'health_insurance' => $request->txtHealthIns,
            'social_insurance' => $request->txtSocialIns,
            'bank_account' => $request->txtBank,
        ]);
        if($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = time() . '.' . $avatar->getClientOriginalExtension();
            Image::make($avatar)->resize(300,300)->save( public_path('/images/' . $filename) );
            staffModel::where('staff_id',$request->txtId)->update([
                'staff_avatar' => 'images/' . $filename,
            ]);
        }
        $notification = array(
            'message' => trans('lang.success_edit_staff'),
            'alert-type' => 'success'
        );
        return redirect()->route('staffList')->with($notification);
    }

    public function deleteStaff(Request $request)
    {
        staffModel::deleteStaff($request->id);
        $notification = array(
            'message' => trans('lang.success_delete_staff'),
            'alert-type' => 'success'
        );
        return redirect()->route('staffList')->with($notification);
    }

    public function timesheet()
    {
        $timesheets = timesheetModel::getByStaffId(session()->get('staff_id'));
        $statuses = [
            0 => 'Pending',
            1 => 'Approved',
            2 => 'Reject'
        ];
        return view('Staff.timesheet',['timesheets' => $timesheets,'statuses' => $statuses]);
    }

    public function addTimesheet()
    {
        return view('Staff.addTimesheet');
    }

    public function importTimesheet(Request $request)
    {
        $file = $request->file('timesheet');
        Excel::import(new timesheetImport(), $file);
        $timesheets = timesheetModel::getByStaffId(session()->get('staff_id'));
        return view('Staff.timesheet',['timesheets' => $timesheets]);
    }

    public function request()
    {
        $requests = requestModel::getByStaffId(session()->get('staff_id'));
        return view('Staff.request',['requests' => $requests]);
    }

    public function addRequest(Request $request)
    {
        return view('Staff.addRequest');
    }
    public function submitRequest( Request $request)
    {
        requestModel::insert([
            'staff_id' => session()->get('staff_id'),
            'type' => $request->txtType,
            'note' => $request->txtNote,
            'month' => $request->txtMonth,
            'status' => 0
        ]);
        return redirect()->route('request');
    }

    public function deleteRequest(Request $request)
    {
        requestModel::deleteRequest($request->id);
        return redirect()->route('request');
    }

    public function paysheet()
    {
        $paysheets = paysheetModel::getByStaffId(session()->get('staff_id'));
        return view('Staff.paysheet',['paysheets' => $paysheets]);
    }

    public function addPaysheet()
    {
        return view('Staff.addPaysheet');
    }

    public function changePassword()
    {
        return view('Staff.changePassword');
    }

    public function downloadTimesheet()
    {
        $file = public_path("/file/sample.xlsx");
        $headers = array(
            'Content-Type: application/pdf'
        );
        return response()->download($file, 'timesheet_sample.xlsx', $headers);
    }
}
