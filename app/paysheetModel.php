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
	static function insertCourse($obj)
	{
		DB::insert('insert into tblpaysheet(course_name,major_id) values(?,?)',[$obj->course_name,$obj->major_id]);
	}
	static function deleteCourse($id)
	{
		DB::delete('delete from tblpaysheet where course_id=?',[$id]);
	}
	static function updateCourse($obj)
	{
		DB::update('update tblpaysheet set course_name=?,major_id=? where course_id=?',[$obj->course_name,$obj->major_id,$obj->course_id]);
	}
}
