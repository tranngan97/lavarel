@extends('Admin.master')

@section('title')
  Add Paysheet
@endsection

@section('css')
	<link rel="stylesheet" href="{{asset('css/dropify.min.css')}}" type="text/css">
@endsection

@section('content')

	<div class="col-md-12">
	    <div class="card">
	        <div class="card-header">
	            <h4 class="card-title">{{trans('lang.paysheet_add')}}</h4>
	        </div>
	        <div class="card-body">
	            <form method="post" action="addPaysheetProcess" id="addForm">
	            	@csrf
	                <div class="row">
	                    <div class="col-md-6 pr-1">
	                        <div class="form-group">
	                            <label>Staff Id</label>
                                <select class="form-control" name="txtStaffId" required>
                                    <option value="0">Select Staff</option>
                                    @foreach($staffs as $staff)
                                        <option value="{{$staff->staff_id}}">{{$staff->staff_name}}</option>
                                    @endforeach
                                </select>
	                        </div>
	                    </div>
                        <div class="col-md-6 pr-1">
                            <div class="form-group">
                                <label>Timesheet Id</label>
                                <select class="form-control" name="txtStaffId" required>
                                    <option value="0">Select Timesheet</option>
                                    @foreach($timesheets as $timesheet)
                                        <option value="{{$timesheet->timesheet_id}}">{{$timesheet->timesheet_id}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
	                </div>
	                <div class="row">
	                    <div class="col-md-6 pr-1">
	                        <div class="form-group">
                                <select class="form-control" name="txtMonth" required>
                                    <option value="0">Select Month</option>
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                    <option value="10">10</option>
                                    <option value="11">11</option>
                                    <option value="12">12</option>
                                </select>
	                        </div>
	                    </div>
	                </div>
	                <button type="submit" class="btn btn-info btn-fill pull-right">Add Paysheet</button>
	                <div class="clearfix"></div>
	            </form>
	        </div>
	    </div>
	</div>

@endsection

@section('js')
	<script type="text/javascript" src="{{asset('js/core/validate.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/dropify.min.js')}}"></script>
@endsection

@section('js2')
	<script>
		$(document).ready(function(){
			jQuery.validator.addMethod("noSpace", function(value, element) {
	          return value.indexOf(" ") < 0 && value != "";
	         });
			$('.dropify').dropify();
			$('#addForm').validate({
				rules: {
					txtEmail: {
						required: true,
						email: true,
						maxlength: 50,
						noSpace: true,
					},
					txtPass: {
						required: true,
						noSpace: true,
					},
					txtFirstName: {
						required: true,
						noSpace: true,
					},
					txtLastName: {
						required: true,
						noSpace: true,
					},
					txtPhone: {
						required: true,
						digits: true,
						noSpace: true,
						minlength: 9,
						maxlength: 15,
					},
				},
				messages: {
					txtEmail: {
						required: '{{trans('lang3.validate_no_empty')}}',
						email: '{{trans('lang3.validate_email')}}',
						maxlength: '{{trans('lang3.validate_maxlength_50')}}',
						noSpace: '{{trans('lang3.validate_no_space')}}',
					},
					txtPass: {
						required: '{{trans('lang3.validate_no_empty')}}',
						noSpace: '{{trans('lang3.validate_no_space')}}',
					},
					txtFirstName: {
						required: '{{trans('lang3.validate_no_empty')}}',
						noSpace: '{{trans('lang3.validate_no_space')}}',
					},
					txtLastName: {
						required: '{{trans('lang3.validate_no_empty')}}',
						noSpace: '{{trans('lang3.validate_no_space')}}',
					},
					txtPhone: {
						required: '{{trans('lang3.validate_no_empty')}}',
						noSpace: '{{trans('lang3.validate_no_space')}}',
						digits: '{{trans('lang3.validate_digits')}}',
						minlength: '{{trans('lang3.validate_minlength_9')}}',
						maxlength: '{{trans('lang3.validate_maxlength_15')}}',
					}
				},
				errorElement: 'em',
			});
		});
	</script>
@endsection
