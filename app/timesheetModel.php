<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use DB;
class timesheetModel extends Model {
	protected $table = 'tbltimesheet';
    protected $fillable = ['staff_id'];
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

	static function deleteTimesheet($id)
	{
		DB::delete('delete from tbltimesheet where timesheet_id=?',[$id]);
	}

    static function getPendingTimesheet()
    {
        return DB::select('select * from tbltimesheet where status=?',[0]);
    }

    static function getByStaffId($id)
    {
        return DB::select('select * from tbltimesheet where staff_id=?',[$id]);
    }

    static function updateTimesheet($data)
    {
        return DB::update('update tbltimesheet set status=? where timesheet_id=?',[$data['status'],$data['timesheet_id']]);
    }
}
