<?php

namespace App\Http\Controllers;

use App\classModel;
use App\studentModel;
use Illuminate\Http\Request;
use App\staffModel;
use File;
use Image;
class staffController extends Controller
{
    //Sale Controller for Admin use
    public function staffList()
    {
        $staffs = staffModel::getAll();
    	return view('Admin.Sale.salesListtest',['staffs' => $staffs]);
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
            staffModel::insert([
                'staff_name' => $request->txtName,
                'staff_email' => $request->txtEmail,
                'staff_pass' => md5($request->txtPass),
                'staff_phone' => $request->txtPhone,
                'staff_avatar' => 'images/' . $filename,
                'staff_department' => $request->txtDepartment,
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
        return view('Sale.dashboard');
    }
    public function login()
    {
        if(session()->has('staff_email'))
        {
            //
            return redirect()->route('dashboard');
        }
        return view('Sale.login');
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
                'message' => 'Welcome to Sale Dashboard!',
                'alert-type' => 'success'
            );
           return redirect()->route('dashboard')->with($notification);
        }else
        {
            return redirect()->route('saleLogin')->with("err","Please, try again!");
        }
    }
    public function profile()
    {
        $profile = staffModel::where('staff_id',session('staff_id'))->first();
        return view('Sale.profile',['profile' => $profile]);
    }
    public function changePassword(Request $request)
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
        return view('Admin.Sale.viewStaff',['staff' => $staff]);
    }

    public function editStaff(Request $request)
    {
        staffModel::where('staff_id',$request->txtId)->update([
            'staff_name' => $request->txtFirstName,
            'staff_dob' => $request->txtDob,
            'staff_phone' => $request->txtPhone,
            'staff_department' => $request->txtDepartment,
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
}
