@extends('Admin.master')

@section('title')
  {{trans('lang.manage_timesheet')}}
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
    .btn.btn-info[disabled], .btn.btn-danger[disabled] {
        background-color: grey;
        border-color: grey;
    }
  </style>
@endsection

@section('content')
  <div class="row">
    <div class="col-md-12">
      <div class="card strpied-tabled-with-hover" id="card-master">
            <div class="card-header ">
                <h4 class="card-title">{{trans('lang.timesheet_list')}}</h4>
                <p class="card-category">{{trans('lang.timesheet_cate')}}</p>
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
                            <td>
                                @foreach($statuses as $value => $status)
                                    @if($value == $timesheet->status)
                                        {{$status}}
                                    @endif
                                @endforeach
                            </td>
                            <td>
                                @if($timesheet->status == 0)
                                <button class="add-staff" style="border-radius: 50px;background-color: #00b9fffa;">
                                    <a href="{{route('approvedTimesheet', ['id' => $timesheet->timesheet_id])}}" style="color: white !important;">Approved</a>
                                </button>
                                @endif
                                <button class="delete-staff" style="border-radius: 50px;background-color: #ff1800fa;">
                                    <a href="{{route('deleteTimesheet', ['id' => $timesheet->timesheet_id])}}" style="color: white !important;">Delete</a>
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


  <div class="fixed-action-btn">
    <a class="btn-floating" data-toggle="modal" data-target="#addMajor"><i class="nc-icon nc-simple-add"></i></a>
  </div>
  			<div class="modal fade" id="addMajor">
		        <div class="modal-dialog">
		          <div class="modal-content">

		            <!-- Modal Header -->
		            <div class="modal-header">
		              <h4 class="modal-title">{{trans('lang.major_add')}}</h4>
		              <button type="button" class="close" data-dismiss="modal">&times;</button>
		            </div>

		            <!-- Modal body -->
		            <div class="modal-body">
		              <form method="post" action="addMajorProcess" id="addForm">
		              	@csrf
		              	<div class="row">
		                    <div class="col-md-12">
		                        <div class="form-group">
		                            <label>{{trans('lang.major_add_name')}}</label>
		                            <input type="text" class="form-control" name="txtName" placeholder="{{trans('lang.major_placeholder')}}" required>
		                        </div>
		                    </div>
	                    </div>
		              </form>
		            </div>

		            <!-- Modal footer -->
		            <div class="modal-footer">
		              <button type="button" class="btn" data-dismiss="modal">{{trans('lang.close_btn')}}</button>
		              <button type="submit" class="btn btn-danger" onclick="checkAdd()">{{trans('lang.major_add_btn')}}</button>
		            </div>

		          </div>
		        </div>
 		    </div>
<input type="hidden" name="_token" value="{{csrf_token()}}">
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
      },
      columnDefs: [ {
            className: 'control',
            orderable: false,
            targets:   2,
        } ],
     });
  });
        function checkAdd()
        {
          $('#addForm').validate({
            rules: {
              txtName: {
                required: true,
                maxlength: 30,
              }
            },
            messages: {
              txtName: {
                 required: '{{trans('lang3.validate_no_empty')}}',
                 maxlength: '{{trans('lang3.validate_maxlength_30')}}',
              }
            },
            errorElement: 'em',
          });
          $('#addForm').submit();
        }

        function checkDelete(id)
        {
          // console.log(id);
          var token = $('input[name=_token]').val();
          var rt;
          $.ajax({
            async: false,
            url: '{{ url('Ajax/CheckDeleteMajor') }}',
            method: 'get',
            data: {
              id: id,
              _token: token
            },
            success: function(data){
              if(data > 0){
                toastr.error('{{trans('lang3.validate_delete_major')}}');
                rt = false;
              }else {
                rt = true;
              }
            }
          });
          return rt;
        }
  </script>
@endsection

