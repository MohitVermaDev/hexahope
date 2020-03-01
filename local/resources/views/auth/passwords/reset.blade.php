<html class="loading" lang="en" data-textdirection="ltr">
  <!-- BEGIN: Head-->
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
  <body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 1-column forgot-bg   blank-page blank-page" data-open="click" data-menu="vertical-modern-menu" data-col="1-column">
    <div class="row">
      <div class="col s12">
        <div class="container"><div id="forgot-password" class="row">
  <div class="col s12 m6 l4 z-depth-4 offset-m4 card-panel border-radius-6 forgot-card bg-opacity-8">
    <form class="login-form" action="{{route('login')}}" method="POST">
        @csrf
      <div class="row">
        <div class="input-field col s12">
          <h5 class="ml-4">Forgot Password</h5>
          <p class="ml-4">You can reset your password</p>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">person_outline</i>
          <input id="email" type="text" class="@error('memberid') is-invalid @enderror" name="memberid" value="{{ $memberid ?? old('memberid') }}" required autocomplete="memberid" autofocus>
          <label for="memberid" class="center-align">Memberid</label>
          @error('memberid')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">person_outline</i>
          <input id="password" type="password" class="@error('password') is-invalid @enderror" name="password" required autocomplete="new-password">
          <label for="password" class="center-align">Password</label>


            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        <div class="input-field col s12">
          <i class="material-icons prefix pt-2">person_outline</i>
          <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
          <label for="memberid" class="center-align">Confirm Password</label>
          @error('memberid')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <button type="submit" class="btn waves-effect waves-light border-round gradient-45deg-purple-deep-orange col s12 mb-1">Reset
            Password</button>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s6 m6 l6">
          <p class="margin medium-small"><a href="{{route('login')}}">Login</a></p>
        </div>
        <div class="input-field col s6 m6 l6">
          <p class="margin right-align medium-small"><a href="{{route('register')}}">Register</a></p>
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

