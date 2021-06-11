@extends('Admin.master')

@section('title')
    Admin Dashboard
@endsection

@section('css')
  <link href="{{asset('css/login/style.min.css')}}" type="text/css" rel="stylesheet" media="screen,projection">
    <link rel="stylesheet" href="{{asset('css/buttons.dataTables.min.css')}}">
    <style>
        #img {
            height: 100%;
        }
        #img img {
            width: 100%;
            height: 100%;
        }
        input {
            text-align: center;
        }
        ::-webkit-input-placeholder {
           text-align: center;
        }

        :-moz-placeholder { /* Firefox 18- */
           text-align: center;
        }

        ::-moz-placeholder {  /* Firefox 19+ */
           text-align: center;
        }

        :-ms-input-placeholder {
           text-align: center;
        }
        .ui-datepicker-calendar {
            display: none;
        }
        .form-control {
            width:auto;
            display:inline-block;
        }
        #body * {
            animation: fadeIn 0.5s forwards;
        }
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 100;
            }
        }
        table tbody td:hover{background:rgba(0,0,0,.08);}
        table.dataTable.no-footer {
          border-bottom: 0;
        }
    </style>
@endsection

@section('content')
<!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
<div class="row">
    <div class="col-md-12">
        <div class="card staff-static">
            <div class="card-header ">
                <h4 class="card-title" align="center">{{trans('lang.detail_staffs')}}</h4>
                <table>
                    <tbody>
                        <tr>
                            <th>TOTAL</th>
                        </tr>
                        <tr>
                            <td>{{count($staffs)}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-body " id="body">

            </div>
            <div class="card-footer ">

            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card staff-static">
            <div class="card-header ">
                <h4 class="card-title" align="center">{{trans('lang.pending_timesheets')}}</h4>
                <table>
                    <tbody>
                    <tr>
                        <th>ID</th>
                        <th>Staff Id</th>
                        <th>Month</th>
                    </tr>
                    <tr>
                        @foreach($timesheets as $timesheet)
                            <td>{{$timesheet->timesheet_id}}</td>
                            <td>{{$timesheet->staff_id}}</td>
                            <td>{{$timesheet->month}}</td>
                        @endforeach
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-body " id="body">

            </div>
            <div class="card-footer ">

            </div>
        </div>
    </div>
    <div class="col-md-12">
        <div class="card staff-static">
            <div class="card-header ">
                <h4 class="card-title" align="center">Pending Request</h4>
                <table>
                    <tbody>
                    <tr>
                        <th>STAFF ID</th>
                        <th>REQUEST TYPE</th>
                        <th>NOTE</th>
                    </tr>
                    <tr>
                        <td>1</td>
                        <td>2</td>
                        <td>4</td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="card-body " id="body">

            </div>
            <div class="card-footer ">

            </div>
        </div>
    </div>
</div>
<input type="hidden" name="_token" value="{{csrf_token()}}">
@endsection

@section('js')
  <script src="{{asset('js/year-select.js')}}"></script>
  <script src="{{asset('js/Chart.bundle.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/dataTables.buttons.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/jszip.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/buttons.html5.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/buttons.print.min.js')}}"></script>
  <script src="{{asset('js/pageloader.js')}}"></script>
@endsection
