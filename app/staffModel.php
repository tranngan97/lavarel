<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;

class staffModel extends Model {
	protected $table = 'tblstaff';
	public $timestamps = false;
	//
	static function getAll()
	{
		return DB::select('select * from tblstaff');
	}
	static function getById($id)
	{
		return DB::select('select * from tblstaff where staff_id=? limit 1',[$id]);
	}
	static function checkRow($obj)
    {
    	$arr=DB::select("select * from tblstaff where staff_email=? and staff_pass=? ",[$obj->staff_email,$obj->staff_pass]);
    	$check = count($arr);
    	return $check;
    }

    static function deleteStaff($id)
    {
        DB::delete('delete from tblstaff where staff_id=?',[$id]);
    }
}
