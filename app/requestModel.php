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

    static function getByStaffId($id)
    {
        return DB::select('select * from tblrequest where staff_id=?',[$id]);
    }

	static function deleteRequest($id)
	{
		DB::delete('delete from tblrequest where request_id=?',[$id]);
	}

	static function getPendingRequest()
    {
        return DB::select('select * from tblrequest where status=?',[0]);
    }

    static function updateData($id,$data)
    {
        foreach ($data as $column => $value){
            DB::update('update tblrequest set '.$column.' = '.$value.' where request_id=?',[$id]);
        }
    }

    static function updateRequest($data)
    {
        return DB::update('update tblrequest set type=?, month=?, date =?,note=? where request_id=?',[$data['type'],$data['month'],$data['date'],$data['note'],$data['id']]);
    }
}
