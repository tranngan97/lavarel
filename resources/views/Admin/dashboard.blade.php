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
<div class="chart">
    <div class="chart-container">
        <div class="pie-chart-container">
            <canvas id="canvas" height="150" width="400"></canvas>
        </div>
    </div>
    <div class="col-md-12">
        <script>
            var month = <?php echo $months; ?>;
            var staffs = <?php echo $staffCount; ?>;
            var totalStaff = <?php echo $totalStaff; ?>;
            var barChartData = {
                labels: month,
                datasets: [
                    {
                        label: 'Total Staffs',
                        backgroundColor: "#23ef63",
                        data: totalStaff
                    },
                    {
                        label: 'New Staffs',
                        backgroundColor: "#23CCEF",
                        data: staffs
                    }
                ]
            };

            window.onload = function() {
                var ctx = document.getElementById("canvas").getContext("2d");
                window.myBar = new Chart(ctx, {
                    type: 'bar',
                    data: barChartData,
                    options: {
                        elements: {
                            rectangle: {
                                borderWidth: 2,
                                borderSkipped: 'bottom'
                            }
                        },
                        responsive: true,
                        title: {
                            display: true,
                            text: 'Staffs Statistic 2021'
                        }
                    }
                });
            };
        </script>
    </div>
</div>
<div id="time_sheet_tracker" class="row" style="margin-top: 10%">
    <div class="col-6">
        <div class="card strpied-tabled-with-hover" id="card-master">
            <div class="card-header ">
                <h4 class="card-title">Pending Timesheets</h4>
            </div>
            <div class="card-body table-full-width table-responsive">
                <table id="mytable" align="center" class="table table-hover">
                    <thead>
                    <th>ID</th>
                    <th>Details</th>
                    </thead>
                    <tbody>
                    @foreach($timesheets as $timesheet)
                        <tr>
                            <td>{{$timesheet->timesheet_id}}</td>
                            <td>
                                <a href="{{route('timesheetList')}}">Time Sheet on {{$timesheet->month}}/2021</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card strpied-tabled-with-hover" id="card-master">
            <div class="card-header ">
                <h4 class="card-title">Pending Request</h4>
            </div>
            <div class="card-body table-full-width table-responsive">
                <table id="mytable" align="center" class="table table-hover">
                    <thead>
                    <th>ID</th>
                    <th>Details</th>
                    </thead>
                    <tbody>
                    @foreach($requests as $request)
                        <tr>
                            <td>{{$request->request_id}}</td>
                            <td>
                                <a href="{{route('requestList')}}">Request on {{$request->month}}/2021</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
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
