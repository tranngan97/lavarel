@extends('Staff.newmaster')

@section('title')
  Staff Dashboard
@endsection

@section('content')
<!-- Start Page Loading -->
    <div id="loader-wrapper">
      <div id="loader"></div>
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
    </div>
<body>
<div id="leave_tracker_chart" style="background-color: #ffd40026">
    <div class="chart-container">
        <div class="pie-chart-container">
            <canvas id="canvas" height="150" width="500"></canvas>
        </div>
    </div>
    <script>
        var month = <?= $months?>,
            leaveTotals = <?= $leaveTotals?>,
            paidLeaves = <?= $paidLeaves?>,
            unpaidLeaves = <?= $unpaidLeaves?>;
        var barChartData = {
            labels: month,
            datasets: [
                {
                    label: 'Leaves Total',
                    backgroundColor: "#23CCEF",
                    data: leaveTotals
                },
                {
                    label: 'Paid Leaves',
                    backgroundColor: "#23ef9a",
                    data: paidLeaves
                },
                {
                    label: 'Unpaid Leaves',
                    backgroundColor: "#ef3623",
                    data: unpaidLeaves
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
                        text: 'Leaves Tracker 2021'
                    }
                }
            });
        };
    </script>
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
                                <a href="{{route('viewStaffTimesheet',['id'=>$timesheet->timesheet_id])}}">Time Sheet on {{$timesheet->month}}/2021</a>
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
                <h4 class="card-title">Paysheet Details</h4>
            </div>
            <div class="card-body table-full-width table-responsive">
                <table id="mytable" align="center" class="table table-hover">
                    <thead>
                    <th>ID</th>
                    <th>Details</th>
                    </thead>
                    <tbody>
                    @foreach($paysheets as $paysheet)
                        <tr>
                            <td>{{$paysheet->paysheet_id}}</td>
                            <td>
                                <a href="{{route('viewStaffPaysheetDetail',['id'=>$paysheet->paysheet_id])}}">PaySheet on {{$paysheet->month}}/2021</a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
