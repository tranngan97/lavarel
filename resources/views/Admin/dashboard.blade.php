@extends('Admin.master')

@section('title')
    Admin Dashboard
@endsection

@section('css')
  <link href="{{asset('css/login/style.min.css')}}" type="text/css" rel="stylesheet" media="screen,projection">
    <link rel="stylesheet" href="{{asset('css/buttons.dataTables.min.css')}}">
    <style>
        #img {
            height: 100%;
        }
        #img img {
            width: 100%;
            height: 100%;
        }
        input {
            text-align: center;
        }
        ::-webkit-input-placeholder {
           text-align: center;
        }

        :-moz-placeholder { /* Firefox 18- */
           text-align: center;
        }

        ::-moz-placeholder {  /* Firefox 19+ */
           text-align: center;
        }

        :-ms-input-placeholder {
           text-align: center;
        }
        .ui-datepicker-calendar {
            display: none;
        }
        .form-control {
            width:auto;
            display:inline-block;
        }
        #body * {
            animation: fadeIn 0.5s forwards;
        }
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }
            100% {
                opacity: 100;
            }
        }
        table tbody td:hover{background:rgba(0,0,0,.08);}
        table.dataTable.no-footer {
          border-bottom: 0;
        }
    </style>
@endsection

@section('content')
<!-- Start Page Loading -->
  <div id="loader-wrapper">
      <div id="loader"></div>
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
<div class="row">
    <div class="col-md-12">
        <div class="card ">
            <div class="card-header ">
                <h4 class="card-title" align="center">{{trans('lang.detail_stats')}}</h4>
                <div class="form-group" align="center">
                    <label>{{trans('lang.month')}}</label>
                    <select class="form-control" id="month">
                        @for($i=1; $i <= 12; $i++)
                            <option value="{{$i}}">{{$i}}</option>
                        @endfor
                    </select>
                    <input class="yearselect form-control" id="year">
                    <label>{{trans('lang.year')}}</label>
                    <button type="button" class="btn btn-light" style="display:block;margin: 3px auto" id="viewstats">{{trans('lang.view_stats')}}</button>
                </div>
            </div>
            <div class="card-body " id="body">

            </div>
            <div class="card-footer ">

            </div>
        </div>
    </div>
</div>
<input type="hidden" name="_token" value="{{csrf_token()}}">
@endsection

@section('js')
  <script src="{{asset('js/year-select.js')}}"></script>
  <script src="{{asset('js/Chart.bundle.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/dataTables.buttons.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/jszip.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/buttons.html5.min.js')}}"></script>
  <script type="text/javascript" src="{{asset('js/buttons.print.min.js')}}"></script>
  <script src="{{asset('js/pageloader.js')}}"></script>
@endsection
