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
  <div class="row">
    <div class="col-md-12">
      <div class="card strpied-tabled-with-hover" id="card-master">
            <div class="card-header ">
                <h4 class="card-title">{{trans('lang.paysheet_list')}}</h4>
                <p class="card-category">{{trans('lang.paysheet_cate')}}</p>
                <button class="add-paysheet" style="position: absolute;margin-left: 83%;margin-top: -3%;border-radius: 50px;background-color: #00b9fffa;height: 35px;">
                    <a href="{{route('addPaysheet')}}" style="color: white !important;">New Paysheet</a>
                </button>
            </div>
          <div class="card-body table-full-width table-responsive">
              <table  id="mytable" align="center" class="table table-hover">
                  <thead>
                  <th>ID</th>
                  <th>Timesheet Id</th>
                  <th>Staff Id</th>
                  <th>Month</th>
                  <th>{{trans('lang.bank')}}</th>
                  <th>Social Insurance</th>
                  <th>Health Insurance</th>
                  <th>Total Paid</th>
                  <td></td>
                  </thead>
                  <tbody>
                  @foreach($paysheets as $paysheet)
                      <tr>
                          <td>{{$paysheet->paysheet_id}}</td>
                          <td>{{$paysheet->timesheet_id}}</td>
                          <td>{{$paysheet->staff_id}}</td>
                          <td>{{$paysheet->month}}</td>
                          <td>{{$paysheet->bank_account}}</td>
                          <td>{{$paysheet->social_insurance}}</td>
                          <td>{{$paysheet->health_insurance}}</td>
                          <td>{{number_format($paysheet->total_paid)}}</td>
                          <td>
                              <button class="add-staff" style="border-radius: 50px;background-color: #00b9fffa;">
                                  <a href="{{route('viewPaysheet', ['id' => $paysheet->paysheet_id])}}" style="color: white !important;">View</a>
                              </button>
                              <button class="delete-staff" style="border-radius: 50px;background-color: #ff1800fa;">
                                  <a href="{{route('deletePaysheet', ['id' => $paysheet->paysheet_id])}}" style="color: white !important;">Delete</a>
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
