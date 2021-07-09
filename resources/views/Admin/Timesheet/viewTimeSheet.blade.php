@extends('Admin.master')

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
                <h4 class="card-title">Timesheet Detail</h4>
            </div>
            <div class="card-body">
                @foreach($timesheets as $timesheet)
                    <form method="post" action="" id="addForm">
                        @csrf
                        <input type="hidden" class="form-control" name="txtId" placeholder="Paysheet Id" required value="{{$timesheet->timesheet_id}}">
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label>Staff ID</label>
                                    <input disabled type="text" value="{{$timesheet->staff_id}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Type</label>
                                    <select name="txtType">
                                        @foreach($statuses as $value => $status)
                                            <option value="{{$value}}" @if($value == $timesheet->status) selected @endif>{{ $status }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>Month</label>
                                    <select name="txtType">
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
                                    <input type="text" value="{{$timesheet->paid_leave}}">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 pr-1">
                                <div class="form-group">
                                    <label>Unpaid Leave</label>
                                    <input type="text" value="{{$timesheet->unpaid_leave}}">
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-danger btn-fill">
                            <a href="{{route('timesheetList')}}" style="color: white !important;">Close</a>
                        </button>
                        <div class="clearfix"></div>
                    </form>
                @endforeach
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
