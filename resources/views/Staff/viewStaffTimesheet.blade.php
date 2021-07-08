@extends('Staff.newmaster')
@section('content')
<section id="content">
    <h4 class="card-title">{{session()->get('staff_name')}}'s Timesheets</h4>
    <div class="row">
        @foreach($timesheets as $timesheet)
            <div class="card-body">
                <form method="post" action="editStaffTimesheet" id="addForm">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Staff ID</label>
                                <input type="text" class="form-control" name="txtStaffId" disabled placeholder="Staff ID" required value="{{$timesheet->staff_id}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Staff ID</label>
                                <input type="text" class="form-control" name="txtStaffName" disabled placeholder="Staff Name" required value="{{$timesheet->staff_name}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Month</label>
                                <select class="form-control" name="txtMonth" required>
                                    <option value="0">Select Month</option>
                                    @foreach($months as $value => $month)
                                        <option value="{{$value}}" @if($value == $timesheet->month) selected @endif>{{ $month }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Paid Leave</label>
                                <input type="text" class="form-control" name="txtPaidLeave" placeholder="Staff's Paid Leaves" required value="{{$timesheet->paid_leave}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Unpaid Leave</label>
                                <input type="text" class="form-control" name="txtUnpaidLeave" placeholder="Staff's Unpaid Leaves" required value="{{$timesheet->unpaid_leave}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Status</label>
                                <select class="form-control" name="txtStatus" required>
                                    @foreach($statuses as $value => $status)
                                        <option value="{{$value}}" @if($value == $timesheet->status) selected @endif>{{ $status }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger btn-fill">
                        <a href="{{route('timesheet')}}" style="color: white !important;">Close</a>
                    </button>
                    <div class="clearfix"></div>
                </form>
            </div>
        @endforeach
    </div>
</section>
@endsection
