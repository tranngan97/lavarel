@extends('Staff.newmaster')

@section('title')
  {{trans('lang.paysheet_manage')}}
@endsection

@section('css')
  <link rel="stylesheet" type="text/css" href="{{asset('css/floatingbutton.css')}}">
  <style>
    table tbody td:hover{background:rgba(0,0,0,.08);}
    table.dataTable.no-footer {
      border-bottom: 0;
    }
    #card-master {
      padding:20px;
      animation: load 0.5s;
    }
    #card-master * {
      animation: loadcontent 0.6s;
    }

    @keyframes load {
      0% {
        height: 0%;
      }
      100% {
        height: 93%;
      }
    }
    @keyframes loadcontent {
      0%, 30% {
        opacity: 0;
      }
      100% {
        opacity: 100;
      }
    }
  </style>
@endsection

@section('content')
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Paysheet Detail</h4>
            </div>
            <div class="card-body">
                <form method="post" action="" id="addForm">
                    @csrf
                    <input type="hidden" class="form-control" name="txtId" placeholder="Paysheet Id" required value="{{$paysheet->paysheet_id}}">
                    <div class="row">
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Staff</label>
                                    <select value="{{$paysheet->staff_id}}">
                                        @foreach($staffs as $staff)
                                        <option value="{{$staff->staff_id}}">{{$staff->staff_name}}</option>
                                        @endforeach
                                    </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Timesheet</label>
                                <select>
                                    @foreach($timesheets as $timesheet)
                                        <option value="{{$timesheet->timesheet_id}}" @if($timesheet->timesheet_id == $paysheet->timesheet_id) selected @endif>{{ $timesheet->month }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Month</label>
                                <input type="text" class="form-control" name="txtMonth"  placeholder="Month" required value="{{$paysheet->month}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Health Insurance</label>
                                <input type="text" class="form-control" name="txtPhone"  placeholder="Health Insurance" required value="{{$paysheet->health_insurance}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Social Insurance</label>
                                <input type="text" class="form-control" name="txtSocialIns"  placeholder="Social Insurance" required value="{{$paysheet->social_insurance}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Bank Account</label>
                                <input type="text" class="form-control" name="txtHealthIns"  placeholder="Bank Account" required value="{{$paysheet->bank_account}}">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Total Salary</label>
                                <input type="text" class="form-control" name="txtGross"  placeholder="Total Salary" required value="{{$paysheet->total_paid}}">
                            </div>
                        </div>
                    </div>
                    <button type="button" class="btn btn-danger btn-fill">
                        <a href="{{route('paysheet')}}" style="color: white !important;">Close</a>
                    </button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('js')
  <script type="text/javascript" src="{{asset('js/core/validate.min.js')}}"></script>
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
