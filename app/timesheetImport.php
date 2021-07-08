<?php namespace App;

use App\timesheetModel;
use Illuminate\Database\Eloquent\Model;
use DB;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\WithValidation;
class timesheetImport implements ToModel, WithValidation{

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

    public function rules():array
    {
        return [
            '0' => Rule::in([session()->get('staff_id')]),
            '1' => Rule::in([session()->get('staff_name')])
        ];
    }
}
