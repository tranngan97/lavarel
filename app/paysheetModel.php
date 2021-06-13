<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class paysheetModel extends Model {
	protected $table = 'tblpaysheet';
	public $timestamps = false;
	//
	static function getAll()
	{
		return DB::select('select * from tblpaysheet');
	}
	static function getById($id)
	{
		return DB::select('select * from tblpaysheet where paysheet_id=? limit 1',[$id]);
	}
	static function insertPaysheet($data)
	{
	    $staffModel = staffModel::getById($data['staff_id']);
	    foreach ($staffModel as $staff){
            $health_insurance = $staff->health_insurance;
            $social_insurance = $staff->social_insurance;
            $bank_account = $staff->bank_account;
            $gross = $staff->staff_gross;
        }
	    $timesheetModel = timesheetModel::getById($data['timesheet_id']);
	    foreach ($timesheetModel as $timesheet){
            $unpaid_leave = $timesheet->unpaid_leave;
            $paid_leave = $timesheet->paid_leave;
        }
	    $salary = $gross - ($gross /30) * (30 - $unpaid_leave);
	    $totalDecrease = $salary - 500 - 500;
		return DB::insert('insert into tblpaysheet(timesheet_id,staff_id,month,bank_account,health_insurance,social_insurance,total_paid) values(?,?,?,?,?,?,?)',[
		    $data['timesheet_id'],
            $data['staff_id'],
            $data['month'],
            $bank_account,
            $health_insurance,
            $social_insurance,
            $totalDecrease
        ]);
	}

	static function deletePaysheet($id)
    {
        return DB::delete('delete from tblpaysheet where paysheet_id=?',[$id]);
    }
}
