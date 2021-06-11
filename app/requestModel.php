<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class requestModel extends Model {
	protected $table = 'tblrequest';
	public $timestamps = false;
	//
	static function getAll()
	{
		return DB::select('select * from tblrequest');
	}
	static function getById($id)
	{
		return DB::select('select * from tblrequest where request_id=? limit 1',[$id]);
	}

//	static function insert($obj)
//    {
//        DB::insert('insert into tblrequest(staff_id,tyoe,note,status) values(?)',[$obj->staff_id,$obj->type,$obj->note,$obj->status]);
//    }
	static function deleteRequest($id)
	{
		DB::delete('delete from tblrequest where request_id=?',[$id]);
	}
}
