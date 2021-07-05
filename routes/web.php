<?php

use Illuminate\Support\Facades\Route;
use App\staffModel;
use App\Http\Controllers\adminController;
use App\Http\Controllers\paysheetController;
use App\Http\Controllers\languageController;
use App\Http\Controllers\timesheetController;
use App\Http\Controllers\staffController;
use App\Http\Controllers\requestController;
use App\Http\Middleware\checkSessionAdmin;
use App\Http\Middleware\checkSessionStaff;
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
            Route::post('addPaysheetProcess',[adminController::class, 'addPaysheetProcess'])->name('addPaysheetProcess');
            Route::get('viewPaysheet.html',[paysheetController::class, 'viewPaysheet'])->name('viewPaysheet');
            Route::get('deletePaysheet',[paysheetController::class, 'deletePaysheet'])->name('deletePaysheet');
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

Route::middleware([checkSessionStaff::class])->group(function(){
	Route::group(['prefix' => 'Staff'], function(){
		Route::get('changeLanguage-{language}',[languageController::class, 'changeLanguage2']);
		Route::get('/',function(){
			return redirect()->route('dashboard');
		});
		Route::get('dashboard.html',[staffController::class, 'dashboard'])->name('dashboard');
		Route::get('profile.html',[staffController::class, 'profile'])->name('profile');
        Route::get('changePassword.html',[staffController::class, 'changePassword'])->name('changePassword');
        Route::post('changePasswordProcess',[staffController::class, 'changePasswordProcess'])->name('changePasswordProcess');
		Route::get('timesheet.html',[staffController::class, 'timesheet'])->name('timesheet');
        Route::get('addTimesheet.html',[staffController::class, 'addTimesheet'])->name('addTimesheet');
		Route::get('paysheet.html',[staffController::class, 'paysheet'])->name('paysheet');
		Route::post('submitTimesheet',[staffController::class, 'submitTimesheet'])->name('submitTimesheet');
		Route::get('request.html',[staffController::class, 'request'])->name('request');
		Route::get('addRequest.html',[staffController::class, 'addRequest'])->name('addRequest');
		Route::get('deleteRequest',[staffController::class, 'deleteRequest'])->name('deleteRequest');
		Route::post('submitRequest',[staffController::class, 'submitRequest'])->name('submitRequest');
		Route::post('downloadTimesheet',[staffController::class, 'downloadTimesheet'])->name('downloadTimesheet');
		Route::post('changeAvatar',[staffController::class, 'changeAvatar'])->name('changeAvatar');
        Route::post('importTimesheet', [staffController::class, 'importTimesheet'])->name('importTimesheet');
        Route::get('viewPaysheetDetail.html',[paysheetController::class, 'viewPaysheetDetail'])->name('viewPaysheetDetail');
        Route::get('staffLogout',function(){
			Session::forget('staff_id');
			Session::forget('staff_email');
			Session::forget('staff_name');
			return redirect()->route('staffLogin');
		})->name('staffLogout');
	});
});

