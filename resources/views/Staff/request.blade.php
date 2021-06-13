@extends('Staff.newmaster')
@section('content')
<section id="content">
    <div class="row">
        <div class="col-md-12">
            <div class="card strpied-tabled-with-hover" id="card-master">
                <div class="card-header ">
                    <h4 class="card-title">Manage Request</h4>
                    <button class="add-timesheet" style="position: absolute;margin-left: 83%;border-radius: 50px;background-color: #00b9fffa;height: 35px;">
                        <a href="{{route('addRequest')}}" style="color: white !important;">New Request</a>
                    </button>
                </div>

                <div class="card-body table-full-width table-responsive">
                    <table  id="mytable" align="center" class="table table-hover">
                        <thead>
                        <th>ID</th>
                        <th>Type</th>
                        <th>Note</th>
                        </thead>
                        <tbody>
                        @foreach($requests as $request)
                            <tr>
                                <td>{{$request->request_id}}</td>
                                <td>{{$request->type}}</td>
                                <td>{{$request->note}}</td>
                                <td>
                                    <button class="delete-request" style="border-radius: 50px;background-color: #ff1800fa;">
                                        <a href="{{route('deleteRequest', ['id' => $request->request_id])}}" style="color: white !important;">Delete</a>
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
</section>
@endsection
