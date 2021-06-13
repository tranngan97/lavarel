@extends('Staff.newmaster')
@section('content')
<section id="content">
    <div class="row">
        <div class="card-header ">
            <h4 class="card-title">New Timesheet</h4>
        </div>
        <div class="col-12">
            <form method="post" action="{{route('submitTimesheet')}}" id="timesheet_form">
                <div class="row">
                    <input type="file" name="timesheet" class="dropify" data-height="250px" data-show-remove="false">
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
</section>
@endsection
