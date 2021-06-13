@extends('Staff.newmaster')
@section('content')
<section id="content">
    <div class="row">
        <h4 class="card-title">New Timesheet</h4>
        <div class="col-12" style="margin-bottom: 5%;margin-top: 5%">
            <form method="post" action="{{route('downloadTimesheet')}}" id="timesheet_form_download" enctype="multipart/form-data">
                @csrf
                <button type="submit">Download Sample File</button>
            </form>
        </div>
        <div class="col-12">
            <form method="post" action="{{route('importTimesheet')}}" id="timesheet_form" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <input type="file" name="timesheet" class="dropify" data-height="250px" data-show-remove="false">
                </div>
                <button type="submit" style="margin-top: 2%">Submit</button>
            </form>
        </div>
    </div>
</section>
@endsection
