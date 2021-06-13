<?php

use Illuminate\Support\Facades\Route;
use App\staffModel;
use App\Http\Controllers\adminController;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\paysheetController;
use App\Http\Controllers\languageController;
use App\Http\Controllers\timesheetController;
use App\Http\Controllers\interestController;
use App\Http\Controllers\staffController;
use App\Http\Controllers\requestController;
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

Route::get('/back', function () {
    return view('welcomeTest');
})->name('back');

Route::get('Admin/login.html',[adminController::class, 'login'])->name('adminLogin');
Route::post('Admin/loginProcess',[adminController::class, 'loginProcess'])->name('adminLoginProcess');
Route::get('Staff/login.html',[staffController::class, 'login'])->name('staffLogin');
Route::post('Staff/loginProcess',[staffController::class, 'loginProcess'])->name('staffLoginProcess');

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
				return view('Admin.Staff.addStaff');
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
			Route::get('approvedTimesheet',[timesheetController::class, 'approvedTimesheet'])->name('approvedTimesheet');
			Route::get('deleteTimesheet',[timesheetController::class, 'deleteTimesheet'])->name('deleteTimesheet');
		});
		Route::group(['prefix' => 'Paysheet'],function(){
			Route::get('/', function(){
				return redirect()->route('paysheetList');
			});
			Route::get('paysheetList.html',[paysheetController::class, 'paysheetList'])->name('paysheetList');
            Route::get('addPaysheet.html',[paysheetController::class, 'addPaysheet'])->name('addPaysheet');
		});
		Route::group(['prefix' => 'Request'],function(){
			Route::get('/', function(){
				return redirect()->route('requestList');
			});
			Route::get('requestList.html',[requestController::class, 'requestList'])->name('requestList');
            Route::get('approvedRequest',[requestController::class, 'approvedRequest'])->name('approvedRequest');
            Route::get('deleteRequest',[requestController::class, 'deleteRequest'])->name('deleteRequest');
		});
	});
});

Route::middleware([checkSessionSale::class])->group(function(){
	Route::group(['prefix' => 'Staff'], function(){
		Route::get('changeLanguage-{language}',[languageController::class, 'changeLanguage2']);
		Route::get('/',function(){
			return redirect()->route('dashboard');
		});
		Route::get('dashboard.html',[staffController::class, 'dashboard'])->name('dashboard');
		Route::get('profile.html',[staffController::class, 'profile'])->name('profile');
		Route::get('timesheet.html',[staffController::class, 'timesheet'])->name('timesheet');
        Route::get('addTimesheet.html',[staffController::class, 'addTimesheet'])->name('addTimesheet');
		Route::get('paysheet.html',[staffController::class, 'paysheet'])->name('paysheet');
		Route::post('submitTimesheet',[staffController::class, 'submitTimesheet'])->name('submitTimesheet');
		Route::get('request.html',[staffController::class, 'request'])->name('request');
		Route::get('addRequest.html',[staffController::class, 'addRequest'])->name('addRequest');
		Route::post('submitRequest',[staffController::class, 'submitRequest'])->name('submitRequest');
		Route::post('changePassword',[staffController::class, 'changePassword'])->name('changePassword');
		Route::post('changeAvatar',[staffController::class, 'changeAvatar'])->name('changeAvatar');
		Route::get('staffLogout',function(){
			Session::forget('staff_id');
			Session::forget('staff_email');
			Session::forget('staff_name');
			return redirect()->route('staffLogin');
		})->name('staffLogout');

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

