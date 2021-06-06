<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class timesheetModel extends Model {
	protected $table = 'tbltimesheet';
	public $timestamps = false;
	//
	static function getAll()
	{
		return DB::select('select * from tbltimesheet');
	}
	static function getById($id)
	{
		return DB::select('select * from tbltimesheet where timesheet_id=? limit 1',[$id]);
	}
	static function insertMajor($obj)
	{
		DB::insert('insert into tbltimesheet(major_name) values(?)',[$obj->major_name]);
	}
	static function deleteTimesheet($id)
	{
		DB::delete('delete from tbltimesheet where timesheet_id=?',[$id]);
	}
	static function updateMajor($obj)
	{
		DB::update('update tbltimesheet set major_name=? where timesheet_id=?',[$obj->timesheet_id]);
	}
}
