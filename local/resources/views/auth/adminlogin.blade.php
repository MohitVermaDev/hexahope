<html class="loading" lang="en" data-textdirection="ltr">
  
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@if(isset($title)){{ $title }}@endif</title>

    <link href="{{asset('web-assets/icon.png')}}" rel="shortcut icon" type="image/png">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard-assets/vendors/vendors.min.css')}}">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard-assets/css/themes/vertical-modern-menu-template/materialize.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard-assets/css/themes/vertical-modern-menu-template/style.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard-assets/css/pages/login.css')}}">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard-assets/css/custom/custom.css')}}">
    <!-- END: Custom CSS-->
  </head>
  <!-- END: Head-->
  <body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 1-column login-bg   blank-page blank-page" data-open="click" data-menu="vertical-modern-menu" data-col="1-column">
    <div class="row">
      <div class="col s12">
        <div class="container"><div id="login-page" class="row">
  <div class="col s12 m6 l4 z-depth-4 card-panel border-radius-6 login-card bg-opacity-8">
    <form class="login-form" action="{{route('adminlogin.post')}}" method="POST">
        @csrf
      <div class="row">
        <div class="input-field col s12">
          <h5 class="ml-4">Sign in</h5>
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">person_outline</i>
          <input id="memberid" type="text" name="memberid">
          <label for="memberid" class="center-align">Username</label>
        </div>
      </div>
      <div class="row margin">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">lock_outline</i>
          <input id="password" type="password" name="password">
          <label for="password">Password</label>
        </div>
      </div>
      <div class="row">
        <div class="col s12 m12 l12 ml-2 mt-1">
          <p>
            <label>
              <input type="checkbox" />
              <span>Remember Me</span>
            </label>
          </p>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
        <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12">Login</button>
        </div>
      </div>
     
    </form>
  </div>
</div>
        </div>
        <div class="content-overlay"></div>
      </div>
    </div>

    
    <script src="{{asset('dashboard-assets/js/vendors.min.js')}}"></script>
   
    <script src="{{asset('dashboard-assets/js/plugins.min.js')}}"></script>
    <script src="{{asset('dashboard-assets/js/search.min.js')}}"></script>
    <script src="{{asset('dashboard-assets/js/custom/custom-script.min.js')}}"></script>
   
  </body>
</html>