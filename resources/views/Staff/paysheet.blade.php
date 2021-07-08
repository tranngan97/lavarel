@extends('Staff.newmaster')
@section('content')
<section id="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover" id="card-master">
                <div class="card-header ">
                    <h4 class="card-title">Paysheet Manage</h4>
                </div>

                <div class="card-body table-full-width table-responsive">
                    <table  id="mytable" align="center" class="table table-hover">
                        <thead>
                        <th>ID</th>
                        <th>Timesheet Id</th>
                        <th>Month</th>
                        <th>Total Paid</th>
                        <th>{{trans('lang.action')}}</th>
                        </thead>
                        <tbody>
                        @foreach($paysheets as $paysheet)
                            <tr>
                                <td>{{$paysheet->paysheet_id}}</td>
                                <td>{{$paysheet->timesheet_id}}</td>
                                <td>{{$paysheet->month}}</td>
                                <td>{{number_format($paysheet->total_paid)}}</td>
                                <td>
                                    <button class="view-paysheet" style="border-radius: 50px;background-color: #00b9fffa;">
                                        <a href="{{route('viewStaffPaysheetDetail', ['id' => $paysheet->paysheet_id])}}" style="color: white !important;">View</a>
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
