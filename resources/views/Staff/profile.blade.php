@extends('Staff.newmaster')

@section('title')
	My Profile
@endsection

@section('css')
	<link rel="stylesheet" href="{{asset('css/dropify.min.css')}}" type="text/css">
@endsection

@section('content')
<div class="container" style="max-width: 100% !important;">
	<div class="card">
		<form enctype="multipart/form-data" action="{{route('changeAvatar')}}" method="post">
			@csrf
			<div class="row">
				<div class="col s12 m12 l12">
	                <input type="file" name="avatar" class="dropify" data-height="250px" data-default-file="{{asset($profile->staff_avatar)}}" data-show-remove="false">
	            </div>
			</div>
			<div class="row">
                <table  id="mytable" align="center" class="table table-hover" style="width: 95% !important;">
                    <thead>
                    <th>Staff ID</th>
                    <th>Full name</th>
                    <th>Email</th>
                    <th>DOB</th>
                    <th>Phone</th>
                    <th>Department</th>
                    <th>Level</th>
                    <th>Certificate</th>
                    <th>Gross Salary</th>
                    <th>Social Insurance</th>
                    <th>Health Insurance</th>
                    <th>Bank Account</th>
                    </thead>
                    <tbody>
                    <tr>
                        <td>{{$profile->staff_id}}</td>
                        <td>{{$profile->staff_name}}</td>
                        <td>{{$profile->staff_email}}</td>
                        <td>{{$profile->staff_dob}}</td>
                        <td>{{$profile->staff_phone}}</td>
                        <td>
                            @foreach($departments as $value => $department)
                                @if($value == $profile->staff_department)
                                    {{$department}}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($levels as $value => $level)
                                @if($value == $profile->staff_level)
                                    {{$level}}
                                @endif
                            @endforeach
                        </td>
                        <td>
                            @foreach($certificates as $value => $certificate)
                                @if($value == $profile->staff_cert)
                                    {{$certificate}}
                                @endif
                            @endforeach
                        </td>
                        <td>{{number_format($profile->staff_gross)}}</td>
                        <td>{{$profile->social_insurance}}</td>
                        <td>{{$profile->health_insurance}}</td>
                        <td>{{$profile->bank_account}}</td>
                    </tr>
                    </tbody>
                </table>
			</div>
            <div class="row" style="display: flex; width: 35%;margin-left: 35%;margin-top: 5%;margin-bottom: 5%;">
                <div class="col s12 center-align">
                    <button class="btn waves-effect waves-light waves-cyan">Change avatar</button>
                </div>
                <div class="col s12 center-align">
                    <button class="btn waves-effect waves-light waves-cyan">
                        <a href="{{route('changePassword')}}" style="color: white !important;">Change Password</a>
                    </button>
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
