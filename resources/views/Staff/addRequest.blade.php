@extends('Staff.newmaster')
@section('content')
<section id="content">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Add new request</h4>
            </div>
            <div class="card-body">
                <form method="post" action="submitRequest" id="addForm">
                    @csrf
                    <div class="form-group">
                        <label>Request Type</label>
                        <select class="form-control" name="txtType" required>
                            <option value="0">Select Type</option>
                            <option value="paid_leave">Paid Leave</option>
                            <option value="unpaid_leave">UnPaid Leave</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Request Note</label>
                        <textarea class="form-control" name="txtNote" placeholder="Request Note"></textarea>
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
                    <button type="submit" class="btn btn-info btn-fill pull-right">Add Request</button>
                    <div class="clearfix"></div>
                </form>
            </div>
        </div>
    </div>
    <div id="settingModal" class="modal">
        <div class="modal-content">
            <div class="row">
                <h4>{{trans('lang2.db_changepass')}}</h4>
            </div>
            <form method="post" action="{{route('changePassword')}}" id="formChange">
                @csrf
                <div class="row">
                    <div class="input-field col s12">
                        <input id="password" type="password" name="password" required>
                        <label for="password">{{trans('lang2.db_pass')}}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="npassword" type="password" name="npassword" required>
                        <label for="npassword">{{trans('lang2.db_npass')}}</label>
                    </div>
                </div>
                <div class="row">
                    <div class="input-field col s12">
                        <input id="cpassword" type="password" name="cpassword" required>
                        <label for="cpassword">{{trans('lang2.db_cpass')}}</label>
                    </div>
                </div>
                <div class="row center-align">
                    <button type="submit" class="btn blue waves-effect waves-light">{{trans('lang2.db_changepass')}}</button>
                </div>
            </form>
        </div>
    </div>
</section>
@endsection
