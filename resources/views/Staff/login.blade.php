
<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="description" content="Materialize is a Material Design Admin Template,It's modern, responsive and based on Material Design by Google. ">
    <meta name="keywords" content="materialize, admin template, dashboard template, flat admin template, responsive admin template,">
    <title>Staff Login</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- CORE CSS-->
    <link href="{{asset('css/login/materialize.min.css')}}" type="text/css" rel="stylesheet" media="screen,projection">
    <link href="{{asset('css/login/loginstyle.min.css')}}" type="text/css" rel="stylesheet" media="screen,projection">
    <!-- Custome CSS-->
    <link href="{{asset('css/login/custom.min.css')}}" type="text/css" rel="stylesheet" media="screen,projection">

</head>

<body class="login-page-admin" style="background-image: url('../images/staff_login.jpg');background-repeat: no-repeat;background-size: cover;">

<!-- Start Page Loading -->
<div id="loader-wrapper">
    <div id="loader"></div>
    <div class="loader-section section-left"></div>
    <div class="loader-section section-right"></div>
</div>
<!-- End Page Loading -->
@if(session('err'))
    <h5 class="red-text text-darken-4 center-align">{{session('err')}}</h5>
@endif
<div class="section"></div>
<div id="login-page" style="width: 20%;margin-top: 10%;margin-left: 65%;">
    <h1 style="text-align: center">Staff Login</h1>
    <div class="row">
        <form method="post" action="{{route('staffLoginProcess')}}" accept-charset="UTF-8" class="login-form" style="width:100%;">
            @csrf
            <div class="row margin">
                <div class="input-field col s12">
                    <i class="material-icons prefix">person_outline</i>
                    <input id="email" name="txtEmail" type="email">
                    <label for="email" class="center-align">Email</label>
                </div>
            </div>
            <div class="row margin">
                <div class="input-field col s12">
                    <i class="material-icons prefix">lock_outline</i>
                    <input id="password" name="txtPass" type="password">
                    <label for="password">Password</label>
                </div>
            </div>

            <div class="row">
                <div class="input-field col s12">
                    <input class="btn waves-effect waves-light col s12" type="submit" value="Login" style="background-color: #4095ff !important;">
                </div>
            </div>
            <div class="row">
                <button class="btn waves-effect waves-light" style="margin-left: 30%;background-color: #4095ff !important;">
                    <a href="{{route('back')}}" style="color: white !important;">Not Staff?</a>
                </button>
            </div>
        </form>
    </div>
</div>



<!-- jQuery Library -->
<script type="text/javascript" src="{{asset('js/jquery.min.js')}}"></script>
<!--materialize js-->
<script type="text/javascript" src="{{asset('js/materialize.min.js')}}"></script>
<!--plugins.js - Some Specific JS codes for Plugin Settings-->
<script type="text/javascript" src="{{asset('js/pageloader.js')}}"></script>

</body>

</html>
