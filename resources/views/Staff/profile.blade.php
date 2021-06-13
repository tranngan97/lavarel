@extends('Staff.newmaster')

@section('title')
	My Profile
@endsection

@section('css')
	<link rel="stylesheet" href="{{asset('css/dropify.min.css')}}" type="text/css">
@endsection

@section('content')
<div class="container">
	<div class="section"></div>
	<div class="card">
		<form enctype="multipart/form-data" action="{{route('changeAvatar')}}" method="post">
			@csrf
			<div class="row">
				<div class="col s12 m12 l12">
	                <input type="file" name="avatar" class="dropify" data-height="250px" data-default-file="{{asset($profile->staff_avatar)}}" data-show-remove="false">
	            </div>
			</div>
			<div class="row">
				<div class="col s12 center-align" style="text-align: center">
					<h4>Full name: {{$profile->staff_name}}</h4>
					<h6>Email: {{$profile->staff_email}}</h6>
                    <h6>DOB: {{$profile->staff_dob}}</h6>
					<h6>Phone: {{$profile->staff_phone}}</h6>
					<h6>Department: {{$profile->staff_department}}</h6>
                    <h6>Gross Salary: {{$profile->staff_gross}}</h6>
				</div>
			</div>
            <div class="row" style="display: flex; width: 35%;margin-left: 35%;margin-top: 5%;margin-bottom: 5%;">
                <div class="col s12 center-align">
                    <button class="btn waves-effect waves-light waves-cyan">Change avatar</button>
                </div>
                <div class="col s12 center-align">
                    <button class="btn waves-effect waves-light waves-cyan">Change Password</button>
                </div>
            </div>
		</form>
		<div class="section"></div>
	</div>
</div>
@endsection

@section('js')
	<script type="text/javascript" src="{{asset('js/dropify.min.js')}}"></script>
@endsection

@section('js2')
	<script>
		$(document).ready(function(){
			$('.dropify').dropify();
		});
	</script>
@endsection
