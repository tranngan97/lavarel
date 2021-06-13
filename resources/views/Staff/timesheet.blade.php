@extends('Staff.newmaster')
@section('content')
<section id="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover" id="card-master">
                <div class="card-header ">
                    <h4 class="card-title">{{trans('lang.timesheet_list')}}</h4>
                    <p class="card-category">{{trans('lang.timesheet_cate')}}</p>
                    <button class="add-timesheet" style="position: absolute;margin-left: 83%;margin-top: -3%;border-radius: 50px;background-color: #00b9fffa;height: 35px;">
                        <a href="{{route('addTimesheet')}}" style="color: white !important;">New Timesheet</a>
                    </button>
                </div>

                <div class="card-body table-full-width table-responsive">
                    <table  id="mytable" align="center" class="table table-hover">
                        <thead>
                        <th>ID</th>
                        <th>{{trans('lang.staff_name')}}</th>
                        <th>Month</th>
                        <th>Status</th>
                        <th>{{trans('lang.action')}}</th>
                        </thead>
                        <tbody>
                        @foreach($timesheets as $timesheet)
                            <tr>
                                <td>{{$timesheet->timesheet_id}}</td>
                                <td>{{$timesheet->staff_name}}</td>
                                <td>{{$timesheet->month}}</td>
                                <td>{{$timesheet->status}}</td>
                                <td>
                                    <button class="add-staff" style="border-radius: 50px;background-color: #00b9fffa;">
                                        <a href="{{route('approvedTimesheet', ['id' => $timesheet->timesheet_id])}}" style="color: white !important;">Approved</a>
                                    </button>
                                    <button class="delete-staff" style="border-radius: 50px;background-color: #ff1800fa;">
                                        <a href="{{route('deleteTimesheet', ['id' => $timesheet->timesheet_id])}}" style="color: white !important;">Reject</a>
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <div id="settingModal" class="modal">
        <div class="modal-content">
            <div class="row">
                <h4>{{trans('lang2.db_changepass')}}</h4>
            </div>
            <form method="post" action="{{route('changePassword')}}" id="formChange">
                @csrf
                <div class="row">
                    <div class="input-field col s12">
                        <input id="password" type="password" name="password" required>
                        <label for="password">{{trans('lang2.db_pass')}}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="npassword" type="password" name="npassword" required>
                        <label for="npassword">{{trans('lang2.db_npass')}}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="cpassword" type="password" name="cpassword" required>
                        <label for="cpassword">{{trans('lang2.db_cpass')}}</label>
                    </div>
                </div>
                <div class="row center-align">
                    <button type="submit" class="btn blue waves-effect waves-light">{{trans('lang2.db_changepass')}}</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
