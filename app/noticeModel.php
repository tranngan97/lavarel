<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class noticeModel extends Model {
	protected $table = 'tbnotices';
    protected $fillable = ['notice_id'];
	public $timestamps = false;
	//
	static function getAll()
	{
		return DB::select('select * from tbnotices');
	}

	static function addNewNoticeForStaff($id, $data)
	{
        DB::insert('insert into tbnotices(model_id,staff_id,action,model_type,status) values(?,?,?,?,?)',[
            $id,
            $data['staff_id'],
            $data['action'],
            $data['model_type'],
            0
        ]);
	}

    static function getByStaffId($id)
    {
        return DB::select('select * from tbnotices where staff_id=? limit 10',[$id]);
    }

    static function getById($id)
    {
        return DB::select('select * from tbnotices where notice_id=? limit 1',[$id]);
    }

    static function updateNotify($data)
    {
        return DB::update('update tbnotices set status=? where notice_id=?',[1,$data['id']]);
    }

    static function deleteNotify($data)
    {
        return DB::delete('delete from tbnotices where notice_id=?',[$data['id']]);
    }
}
