@extends('Admin.master')

@section('title')
  {{trans('lang.staff_manage')}}
@endsection

@section('css')
  <link rel="stylesheet" type="text/css" href="{{asset('css/floatingbutton.css')}}">
  <style>
    table tbody td:hover{background:rgba(0,0,0,.08);}
    table.dataTable tfoot th {
      border-top: 0;
    }
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
      <div class="card" id="card-master">
            <div class="card-header">
                <h4 class="card-title">{{trans('lang.staff_list')}}</h4>
                <p class="card-category">{{trans('lang.staff_cate')}}</p>
                <button class="add-staff" style="position: absolute;margin-left: 83%;margin-top: -3%;border-radius: 50px;background-color: #00b9fffa;height: 35px;">
                    <a href="{{route('addStaff')}}" style="color: white !important;">New Staff</a>
                </button>
            </div>
            <div class="card-body table-full-width table-responsive">
                <table id="mytable" align="center" class="table table-hover">
                    <thead>
                      <tr>
                          <th></th>
                          <th>{{trans('lang.staff_id')}}</th>
                          <th>EMAIL</th>
                          <th>{{trans('lang.staff_name')}}</th>
                          <th>{{trans('lang.staff_phone')}}</th>
                          <th>Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        @foreach($staffs as $staff)
                        <tr>
                            <td><img src="{{asset($staff->staff_avatar)}}" style="width: 64px;height: 64px;border-radius: 50%"></td>
                            <td>{{$staff->staff_id}}</td>
                            <td>{{$staff->staff_email}}</td>
                            <td>{{$staff->staff_name}}</td>
                            <td>{{$staff->staff_phone}}</td>
                            <td>
                                <button class="add-staff" style="border-radius: 50px;background-color: #00b9fffa;">
                                    <a href="{{route('viewStaff', ['id' => $staff->staff_id])}}" style="color: white !important;">View</a>
                                </button>
                                <button class="delete-staff" style="border-radius: 50px;background-color: #ff1800fa;">
                                    <a href="{{route('deleteStaff', ['id' => $staff->staff_id])}}" style="color: white !important;">Delete</a>
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

@section('js2')
  <script type="text/javascript">
  $(document).ready(function(){
    $('#mytable').DataTable({
      order: [4, 'desc'],
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
      },
      columnDefs: [ {
            className: 'control',
            orderable: false,
            targets:   0,
        },
        {
            className: 'control',
            orderable: false,
            targets:   5,
        } ],
    });
  });

  </script>
@endsection

