<?php namespace App;

use App\timesheetModel;
use Illuminate\Database\Eloquent\Model;
use DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
class timesheetImport implements ToModel, WithHeadingRow{

    public function model(array $row)
    {
        timesheetModel::insert([
            'staff_id'     => $row['staff_id'],
            'staff_name'    => $row['staff_name'],
            'paid_leave'    => $row['paid_leave'],
            'unpaid_leave'    => $row['unpaid_leave'],
            'month'    => $row['month'],
            'status' => 0
        ]);
    }
}
