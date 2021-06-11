<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
    <title>@yield('title')</title>
    <link rel="icon" href="{{asset('images/logoBk.png')}}" sizes="32x32">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="{{asset('css/materialize-dashboard.css')}}" type="text/css" rel="stylesheet">
    <link href="{{asset('css/materialize.style.css')}}" type="text/css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{asset('css/jquery.dataTables.min.css')}}">
    <link href="{{asset('css/perfect-scrollbar.css')}}" type="text/css" rel="stylesheet">
    <link href="{{asset('css/materialize/flag-icon.min.css')}}" type="text/css" rel="stylesheet">
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    @yield('css')
    <style>
        table tbody td:hover{background:rgba(0,0,0,.08);}
        table.dataTable tfoot th {
            border-top: 0;
        }
        table.dataTable.no-footer {
            border-bottom: 0;
        }
        .cover {
            object-fit: cover;
            width: 100%;
            height: 200px;
        }
        @media (max-width: 1024px) {
            .cover {
                object-fit: cover;
                width: 100%;
                height: 150px;
            }
        }
    </style>
</head>
<body>
<header id="header" class="page-topbar">
    <div class="navbar-fixed">
        <nav class="navbar-color gradient-45deg-purple-deep-orange gradient-shadow">
            <div class="nav-wrapper" id="nav-wrapper">

                <ul class="right hide-on-med-and-down">
                    <li>
                        <a href="javascript:void(0);" class="waves-effect waves-block waves-light translation-button" data-activates="translation-dropdown">
                            <span class="flag-icon" id="flagSelect"></span>
                        </a>
                    </li>
                </ul>
                <!-- translation-button -->
                <ul id="translation-dropdown" class="dropdown-content">
                    <li>
                        <a href="{{route('changeLanguage',['language' => 'en'])}}" class="grey-text text-darken-1">
                            <i class="flag-icon flag-icon-gb"></i> {{trans('lang.en-select')}}</a>
                    </li>
                    <li>
                        <a href="{{route('changeLanguage',['language' => 'vn'])}}" class="grey-text text-darken-1">
                            <i class="flag-icon flag-icon-vn"></i> {{trans('lang.vn-select')}}</a>
                    </li>
                </ul>
                <!-- profile-dropdown -->
                <ul id="profile-dropdown" class="dropdown-content">
                    <li>
                        <a class="grey-text text-darken-1" href="{{route('profile')}}">
                            <i class="material-icons">face</i> {{trans('lang2.db_profile')}}</a>
                    </li>
                    <li>
                        <a class="grey-text text-darken-1 modal-trigger" href="#settingModal">
                            <i class="material-icons">settings</i> {{trans('lang2.db_changepass')}}</a>
                    </li>
                    <li>
                        <a href="{{route('staffLogout')}}" class="grey-text text-darken-1">
                            <i class="material-icons">keyboard_tab</i> {{trans('lang.log-out')}}</a>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
</header>
<!-- END HEADER -->
<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- START MAIN -->
<div id="main">
    <!-- START WRAPPER -->
    <div class="wrapper">
        <!-- START LEFT SIDEBAR NAV-->
        <aside id="left-sidebar-nav" class="nav-collapsible nav-lock">
            <div class="brand-sidebar">
                <!-- Modal Trigger -->
                <h1 class="logo-wrapper">
                    <a href="{{route('dashboard')}}" class="brand-logo darken-1">
                        <img src="{{asset('images/logoBk.png')}}" alt="" width="25vw">
                        <span class="logo-text hide-on-med-and-down">HUST</span>
                    </a>
                    <a href="#" class="navbar-toggler">
                        <i class="material-icons">radio_button_checked</i>
                    </a>
                </h1>
            </div>
            <ul id="slide-out" class="side-nav fixed leftside-navigation">
                <li class="no-padding">
                    <ul class="collapsible" data-collapsible="accordion">
                        <li class="bold @if(Request::is('Staff/dashboard*')) active @endif">
                            <a href="{{route('dashboard')}}" class="waves-effect waves-cyan">
                                <i class="material-icons">dashboard</i>
                                <span class="nav-text">Dashboard</span>
                            </a>
                        </li>
                        <li class="bold @if(Request::is('Staff/Profile*')) active @endif">
                            <a href="{{route('profile')}}" class="waves-effect waves-cyan">
                                <i class="material-icons">Profile</i>
                                <span class="nav-text">Profile</span>
                            </a>
                        </li>
                        <li class="bold @if(Request::is('Staff/Timesheet*')) active @endif">
                            <a href="{{route('timesheet')}}" class="waves-effect waves-cyan">
                                <i class="material-icons">Timesheet</i>
                                <span class="nav-text">Timesheet</span>
                            </a>
                        </li>
                        <li class="bold @if(Request::is('Staff/Paysheet*')) active @endif">
                            <a href="{{route('paysheet')}}" class="waves-effect waves-cyan">
                                <i class="material-icons">Paysheet</i>
                                <span class="nav-text">Paysheet</span>
                            </a>
                        </li>
                        <li class="bold @if(Request::is('Staff/Request*')) active @endif">
                            <a href="{{route('request')}}" class="waves-effect waves-cyan">
                                <i class="material-icons">Request</i>
                                <span class="nav-text">Request</span>
                            </a>
                        </li>
                    </ul>
            </ul>
            <a href="#" data-activates="slide-out" class="sidebar-collapse btn-floating btn-medium waves-effect waves-light hide-on-large-only gradient-45deg-light-blue-cyan gradient-shadow">
                <i class="material-icons">menu</i>
            </a>
        </aside>
        <!-- END LEFT SIDEBAR NAV-->
        <!-- //////////////////////////////////////////////////////////////////////////// -->
        <!-- START CONTENT -->
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
    </div>
</div>
<!-- END MAIN -->
<!-- //////////////////////////////////////////////////////////////////////////// -->
<!-- jQuery Library -->
<script type="text/javascript" src="{{asset('js/core/materialize/jquery.3.2.1.min.js')}}"></script>
<!--materialize js-->
<script type="text/javascript" src="{{asset('js/core/materialize/materialize.min.js')}}"></script>

<script type="text/javascript" src="{{asset('js/jquery.dataTables.min.js')}}"></script>
<!--prism-->
<script type="text/javascript" src="{{asset('js/core/materialize/prism.js')}}"></script>
<!--scrollbar-->
<script type="text/javascript" src="{{asset('js/core/materialize/perfect-scrollbar.min.js')}}"></script>
<!-- chartjs -->
<script type="text/javascript" src="{{asset('js/core/materialize/chart.min.js')}}"></script>
<!--plugins.js - Some Specific JS codes for Plugin Settings-->
<script type="text/javascript" src="{{asset('js/core/materialize/plugins3.js')}}"></script>
<script type="text/javascript" src="{{asset('js/toastr.min.js')}}"></script>
<script type="text/javascript" src="{{asset('js/core/validate.min.js')}}"></script>

@yield('js')
@yield('js2')
<script>
    $(document).ready(function(){
        jQuery.validator.addMethod("noSpace", function(value, element) {
            return value.indexOf(" ") < 0 && value != "";
        });
        $('select').material_select();
        @if(Session::has('message'))
        var type="{{Session::get('alert-type','info')}}"

        switch(type){
            case 'info':
                toastr.info("{{ Session::get('message') }}");
                break;
            case 'success':
                toastr.success("{{ Session::get('message') }}");
                break;
            case 'warning':
                toastr.warning("{{ Session::get('message') }}");
                break;
            case 'error':
                toastr.error("{{ Session::get('message') }}");
                break;
        }
        @endif

        $('.modal').modal();
        $('#modal1').modal('open');
        @if(Session::get('locale') =='vn')
        $('#flagSelect').addClass('flag-icon-vn');
        @elseif(Session::get('locale')=='en')
        $('#flagSelect').addClass('flag-icon-gb');
        @endif
        $('#formChange').validate({
            rules: {
                password: {
                    required: true,
                    noSpace: true,
                },
                npassword: {
                    required: true,
                    noSpace: true,
                },
                cpassword: {
                    required: true,
                    noSpace: true,
                    equalTo: '#npassword',
                },
            },
            messages: {
                password: {
                    required: '{{trans('lang3.validate_no_empty')}}',
                    noSpace: '{{trans('lang3.validate_no_space')}}',
                },
                npassword: {
                    required: '{{trans('lang3.validate_no_empty')}}',
                    noSpace: '{{trans('lang3.validate_no_space')}}',
                },
                cpassword: {
                    required: '{{trans('lang3.validate_no_empty')}}',
                    noSpace: '{{trans('lang3.validate_no_space')}}',
                    equalTo: '{{trans('lang3.validate_confirm_pass')}}',
                }
            },
            errorElement: 'em',
        });
    });

</script>
</body>
</html>
