@extends('Staff.newmaster')
@section('content')
<section id="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Change Password</h4>
                </div>
                <div class="card-body">
                    <form method="post" action="changePasswordProcess" id="addForm">
                        @csrf
                        <div class="form-group">
                            <label>Current Password</label>
                            <input type="text" class="form-control" name="txtOldPassword" placeholder="Current Password">
                        </div>
                        <div class="form-group">
                            <label>New Password</label>
                            <input type="text" class="form-control" name="txtNewPassword" placeholder="New Password">
                        </div>
                        <div class="form-group">
                            <label>Confirm Password</label>
                            <input type="text" class="form-control" name="txtConfirmPassword" placeholder="Confirm Password">
                        </div>
                        <button type="submit" class="btn btn-info btn-fill pull-right">Change Password</button>
                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
