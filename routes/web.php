<?php

use Illuminate\Support\Facades\Route;
use App\staffModel;
use App\Http\Controllers\adminController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\classController;
use App\Http\Controllers\paysheetController;
use App\Http\Controllers\languageController;
use App\Http\Controllers\timesheetController;
use App\Http\Controllers\interestController;
use App\Http\Controllers\staffController;
use App\Http\Controllers\scheduleController;
use App\Http\Middleware\checkSessionAdmin;
use App\Http\Middleware\checkSessionSale;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return view('welcomeTest');
});

Route::get('Admin/login.html',[adminController::class, 'login'])->name('adminLogin');
Route::post('Admin/loginProcess',[adminController::class, 'loginProcess'])->name('adminLoginProcess');
Route::get('Sale/login.html',[staffController::class, 'login'])->name('saleLogin');
Route::post('Sale/loginProcess',[staffController::class, 'loginProcess'])->name('saleLoginProcess');

Route::get('changeLanguage-{language}',[languageController::class, 'changeLanguage'])->name('changeLanguage');

Route::middleware([checkSessionAdmin::class])->group(function(){
	Route::group(['prefix' => 'Admin'], function(){
		Route::get('/',function(){
			return redirect()->route('Admindashboard');
		});
		Route::get('dashboard.html',[adminController::class, 'mainPage'])->name('Admindashboard');

		Route::get('adminLogout',function(){
			Session::forget('admin_email');
			Session::forget('admin_name');
			return redirect()->route('adminLogin');
		})->name('adminLogout');
		Route::group(['prefix' => 'Staff'],function(){
			Route::get('/', function(){
				return redirect()->route('salesList');
			});
			Route::get('staffList.html',[staffController::class, 'staffList'])->name('staffList');
			Route::get('addStaff.html',function() {
				return view('Admin.Sale.addStaff');
			})->name('addStaff');
            Route::get('viewStaff-{id}.html',[staffController::class, 'viewStaff'])->name('viewStaff');
            Route::post('editStaff',[staffController::class, 'editStaff'])->name('editStaff');
            Route::get('deleteStaff',[staffController::class, 'deleteStaff'])->name('deleteStaff');
			Route::post('addStaffProcess',[staffController::class, 'addStaffProcess'])->name('addStaffProcess');
		});
		Route::group(['prefix' => 'TimeSheet'],function(){
			Route::get('/', function(){
				return redirect()->route('timesheetList');
			});
			Route::get('timesheet.html',[timesheetController::class, 'timesheetList'])->name('timesheetList');
			Route::post('approvedTimesheet',[timesheetController::class, 'approvedTimesheet'])->name('approvedTimesheet');
			Route::post('deleteTimesheet',[timesheetController::class, 'deleteTimesheet'])->name('deleteTimesheet');
		});
		Route::group(['prefix' => 'Paysheet'],function(){
			Route::get('/', function(){
				return redirect()->route('coursesList');
			});
			Route::get('paysheetList.html',[paysheetController::class, 'paysheetList'])->name('paysheetList');
            Route::get('addPaysheet.html',[paysheetController::class, 'addPaysheet'])->name('addPaysheet');
		});
		Route::group(['prefix' => 'Schedules'],function(){
			Route::get('/', function(){
				return redirect()->route('schedulesList');
			});
			Route::get('schedulesList.html',[scheduleController::class, 'schedulesList'])->name('schedulesList');
			Route::post('addScheduleProcess',[scheduleController::class, 'addScheduleProcess'])->name('addScheduleProcess');
			Route::get('deleteSchedule-{id}',[scheduleController::class, 'deleteSchedule'])->name('deleteSchedule');
		});
		Route::group(['prefix' => 'Classes'],function(){
			Route::get('/', function(){
				return redirect()->route('classesList');
			});
			Route::get('classesList.html',[classController::class, 'classesList'])->name('classesList');
			Route::get('classDetail-{id}.html',[classController::class, 'classDetail'])->name('classDetail');
			Route::post('addClassProcess',[classController::class, 'addClassProcess'])->name('addClassProcess');
			Route::get('deleteClass-{id}',[classController::class, 'deleteClass']);
			Route::get('OpenClass-{id}',[classController::class, 'OpenClass']);

		});
		Route::group(['prefix' => 'Interests'],function(){
			Route::get('interestsList.html',[interestController::class, 'interestsList'])->name('interestsList');
			Route::get('addClass-{id}',[interestController::class, 'addClass']);
			Route::get('interestDetail-{id}.html',[interestController::class, 'interestDetail'])->name('interestDetail');
		});
	});
});

Route::middleware([checkSessionSale::class])->group(function(){
	Route::group(['prefix' => 'Sale'], function(){
		Route::get('changeLanguage-{language}',[languageController::class, 'changeLanguage2']);
		Route::get('/',function(){
			return redirect()->route('dashboard');
		});
		Route::get('dashboard.html',[staffController::class, 'dashboard'])->name('dashboard');
		Route::get('myProfile.html',[staffController::class, 'profile'])->name('profile');
		Route::post('changePassword',[staffController::class, 'changePassword'])->name('changePassword');
		Route::post('changeAvatar',[staffController::class, 'changeAvatar'])->name('changeAvatar');
		Route::get('saleLogout',function(){
			Session::forget('sale_id');
			Session::forget('sale_email');
			Session::forget('sale_name');
			return redirect()->route('saleLogin');
		})->name('saleLogout');
		Route::get('deleteStudent-{id}',[staffController::class, 'deleteStudent']);
		Route::group(['prefix' => 'Student'],function(){
			Route::get('addStudent.html',[staffController::class, 'addStudent'])->name('addStudent');
			Route::post('addStudentProcess',[staffController::class, 'addStudentProcess'])->name('addStudentProcess');
			Route::get('Interest.html',[staffController::class, 'studentInterest'])->name('studentInterest');
			Route::post('addInterest',[staffController::class, 'addInterest'])->name('addInterest');
			Route::post('addInterestNew',[staffController::class, 'addInterestNew'])->name('addInterestNew');
		});
		Route::group(['prefix' => 'Class'],function(){
			Route::post('addStudentIntoClass',[staffController::class, 'addStudentIntoClass'])->name('addStudentIntoClass');
			Route::get('courseList-{id}.html',[staffController::class, 'courseList'])->name('courseList');
			Route::get('/{id}/classList-{id2}.html',[staffController::class, 'classList'])->name('classList');
			Route::get('/{id}/class_detail-{id2}.html',[staffController::class, 'class_detail'])->name('class_detail');
		});
	});
});

Route::group(['prefix' => 'Ajax'], function(){
	Route::get('SaleStat',[AjaxController::class, 'SaleStat']);
	Route::get('getCourses',[AjaxController::class, 'getCourses']);
	Route::get('getSchedules',[AjaxController::class, 'getSchedules']);
	Route::get('getCourses_classList',[AjaxController::class, 'getCourses_classList']);
	Route::get('getStudent',[AjaxController::class, 'getStudent']);
	Route::get('getStudentName',[AjaxController::class, 'getStudentName']);
	Route::get('ViewStats',[AjaxController::class, 'ViewStats']);
	Route::get('Notification',[AjaxController::class, 'Notification']);
	Route::get('Notification2',[AjaxController::class, 'Notification2']);
	Route::get('getMajor',[AjaxController::class, 'getMajor']);
	Route::get('CheckStudent',[AjaxController::class, 'CheckStudent']);
	Route::get('CheckClass',[AjaxController::class, 'CheckClass']);
	Route::get('CheckStudentSale',[AjaxController::class, 'CheckStudentSale']);
	Route::get('CheckOpenClass',[AjaxController::class, 'CheckOpenClass']);
	Route::get('getCourseInterest',[AjaxController::class, 'getCourseInterest']);
	Route::get('CheckInterest',[AjaxController::class, 'CheckInterest']);
	Route::get('CheckDeleteCourse',[AjaxController::class, 'CheckDeleteCourse']);
	Route::get('CheckDeleteMajor',[AjaxController::class, 'CheckDeleteMajor']);
	Route::get('CheckEditCourse',[AjaxController::class, 'CheckEditCourse']);
	Route::get('SearchCourse',[AjaxController::class, 'SearchCourse']);
	Route::get('SearchClass',[AjaxController::class, 'SearchClass']);
});



Route::get('testModel',function(){
	$majors = staffModel::getMajor();
    $courses = staffModel::getCourse();
	return view('test',['majors' => $majors,'courses' => $courses]);
});
Route::get('test',function()
{
	return view('Sale.newmaster');
});
Route::get('test2',function()
{
	return view('Sale.dashboard');
});

