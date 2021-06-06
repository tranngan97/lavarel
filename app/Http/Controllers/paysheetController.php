<?php

namespace App\Http\Controllers;

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
        $timesheets = timesheetModel::getAll();
        $staffs = staffModel::getAll();
        return view('Admin.Paysheet.addPaysheet',['timesheets' => $timesheets,'staffs'=>$staffs]);
    }
    public function addCourseProcess(Request $request)
    {
        $count = paysheetModel::where('course_name',$request->txtName)->where('major_id',$request->ddlMajor)->count();
        if($count == 0)
        {
            paysheetModel::insert([
                'course_name' => $request->txtName,
                'major_id' => $request->ddlMajor,
            ]);
            $notification = array(
                    'message' => trans('lang.success_insert_course'),
                    'alert-type' => 'success'
                );
        }else
    	{
            $notification = array(
                    'message' => trans('lang.failed_insert_course'),
                    'alert-type' => 'error'
                );
        }
 		return redirect()->route('coursesList')->with($notification);
    }
    public function deleteCourse($id)
    {
    	paysheetModel::deleteCourse($id);
    	$notification = array(
                'message' => trans('lang.success_delete_course'),
                'alert-type' => 'success'
            );
    	return redirect()->route('coursesList')->with($notification);
    }
    public function editCourse(Request $request)
    {
        $old_name = paysheetModel::where('course_id',$request->txtId)->first();
        $old_name = $old_name->course_name;
        if($request->txtName !== $old_name)
        {
            $check = paysheetModel::where('course_name',$request->txtName)->count();
            if($check > 0 )
            {
                $notification = array(
                    'message' => trans('lang.failed_edit_course'),
                    'alert-type' => 'error'
                );
            }else {
                $classes = classModel::where('class_name','like',$old_name . ' %')->get();
                paysheetModel::where('course_id',$request->txtId)->update([
                    'course_name' => $request->txtName,
                    'major_id' => $request->ddlMajor,
                ]);
                for($i = 0 ; $i < count($classes) ; $i++)
                {
                    $new_name = paysheetModel::where('course_id',$classes[$i]->course_id)->first();
                    $new_name = $new_name->course_name;
                    $schedule = scheduleModel::where('schedule_id',$classes[$i]->schedule_id)->first();
                    classModel::where('class_id',$classes[$i]->class_id)->update([
                        'class_name' => $new_name . ' ' . $schedule->schedule_name,
                    ]);
                }
                $notification = array(
                    'message' => trans('lang.success_edit_course'),
                    'alert-type' => 'success'
                );
            }
        }else {
            paysheetModel::where('course_id',$request->txtId)->update([
                    'major_id' => $request->ddlMajor,
                ]);
            $notification = array(
                    'message' => trans('lang.success_edit_course'),
                    'alert-type' => 'success'
                );
        }

        return back()->with($notification);
    }
}
