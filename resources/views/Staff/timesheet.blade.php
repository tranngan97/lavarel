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
                        @if($timesheets)
                        @foreach($timesheets as $timesheet)
                            <tr>
                                <td>{{$timesheet->timesheet_id}}</td>
                                <td>{{$timesheet->staff_name}}</td>
                                <td>{{$timesheet->month}}</td>
                                <td>
                                    @foreach($statuses as $value => $status)
                                        @if($value == $timesheet->status)
                                            {{$status}}
                                        @endif
                                    @endforeach
                                </td>
                                <td>
                                    <button class="delete-staff" style="border-radius: 50px;background-color: #00b9fffa;">
                                        <a href="{{route('viewStaffTimesheet', ['id' => $timesheet->timesheet_id])}}" style="color: white !important;">View</a>
                                    </button>
                                    @if($timesheet->status !== 1)
                                    <button class="delete-staff" style="border-radius: 50px;background-color: #ff1800fa;">
                                        <a href="{{route('deleteStaffTimesheet', ['id' => $timesheet->timesheet_id])}}" style="color: white !important;">Delete</a>
                                    </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
@section('js2')
    <script type="text/javascript">
        $(document).ready(function(){
            $('#mytable').DataTable({
                language: {
                    "decimal":        "",
                    "emptyTable":     "{{trans('lang.dttb_emptyTable')}}",
                    "info":           "{{trans('lang.dttb_info')}}",
                    "infoEmpty":      "{{trans('lang.dttb_infoEmpty')}}",
                    "infoFiltered":   "{{trans('lang.dttb_infoFiltered')}}",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "{{trans('lang.dttb_lengthMenu')}}",
                    "loadingRecords": "{{trans('lang.dttb_loadingRecords')}}",
                    "processing":     "{{trans('lang.dttb_processing')}}",
                    "search":         "{{trans('lang.dttb_search')}}",
                    "zeroRecords":    "{{trans('lang.dttb_zeroRecords')}}",
                    "paginate": {
                        "first":      "{{trans('lang.dttb_first')}}",
                        "last":       "{{trans('lang.dttb_last')}}",
                        "next":       "{{trans('lang.dttb_next')}}",
                        "previous":   "{{trans('lang.dttb_previous')}}"
                    }
                }
            });
        });
    </script>
@endsection
