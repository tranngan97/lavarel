@extends('Admin.master')

@section('title')
  {{trans('lang.staff_add_manage')}}
@endsection

@section('css')
	<link rel="stylesheet" href="{{asset('css/dropify.min.css')}}" type="text/css">
@endsection

@section('content')

	<div class="col-md-12">
	    <div class="card">
	        <div class="card-header">
	            <h4 class="card-title">{{trans('lang.staff_add')}}</h4>
	        </div>
	        <div class="card-body">
	            <form method="post" action="addStaffProcess" id="addForm">
	            	@csrf
	            	<div class="row">
	            		<input type="file" name="avatar" class="dropify" data-height="250px" data-default-file="{{asset('images/user.png')}}" data-show-remove="false">
	            	</div>
	                <div class="row">
	                    <div class="col-md-6 pr-1">
	                        <div class="form-group">
	                            <label>Email</label>
	                            <input type="email" class="form-control" name="txtEmail" placeholder="Email" required>
	                        </div>
	                    </div>
	                    <div class="col-md-6 pl-1">
	                        <div class="form-group">
	                            <label>{{trans('lang.password')}}</label>
	                            <input type="password" class="form-control" name="txtPass" placeholder="{{trans('lang.password')}}" required>
	                        </div>
	                    </div>
	                </div>
	                <div class="row">
	                    <div class="col-md-6 pr-1">
	                        <div class="form-group">
	                            <label>{{trans('lang.name')}}</label>
	                            <input type="text" class="form-control" name="txtName" placeholder="{{trans('lang.name')}}" required>
	                        </div>
	                    </div>
	                </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{trans('lang.dob')}}</label>
                                <input type="text" class="form-control" id='datetimepicker' name="txtDob"  placeholder="{{trans('lang.dob')}}" required>
                            </div>
                        </div>
                    </div>
	                <div class="row">
	                    <div class="col-md-12">
	                        <div class="form-group">
	                            <label>{{trans('lang.phone_number')}}</label>
	                            <input type="text" class="form-control" name="txtPhone"  placeholder="{{trans('lang.phone_number')}}" required>
	                        </div>
	                    </div>
	                </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{trans('lang.department')}}</label>
                                <select class="form-control" name="txtDepartment" required>
                                    <option value="0">Select Department</option>
                                    <option value="1">IT Department</option>
                                    <option value="2">Finance Department</option>
                                    <option value="3">Customer Department</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>Certificate</label>
                                <select class="form-control" name="txtCert" required>
                                    <option value="0">Select Certificate</option>
                                    <option value="1">University</option>
                                    <option value="2">Collage</option>
                                    <option value="3">Academy</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{trans('lang.social_ins')}}</label>
                                <input type="text" class="form-control" name="txtSocialIns"  placeholder="{{trans('lang.social_ins')}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{trans('lang.health_ins')}}</label>
                                <input type="text" class="form-control" name="txtHealthIns"  placeholder="{{trans('lang.health_ins')}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{trans('lang.gross')}}</label>
                                <input type="text" class="form-control" name="txtGross"  placeholder="{{trans('lang.gross')}}" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label>{{trans('lang.bank')}}</label>
                                <input type="text" class="form-control" name="txtBank"  placeholder="{{trans('lang.bank')}}" required>
                            </div>
                        </div>
                    </div>
	                <button type="submit" class="btn btn-info btn-fill pull-right">{{trans('lang.add_staff')}}</button>
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

            $("#datetimepicker").datetimepicker({
                format: 'DD-MMM-yyyy'
            });
		});
	</script>
@endsection
