
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title }} - {{site_name_new()}}</title>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- BEGIN: VENDOR CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard-assets/vendors/vendors.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard-assets/vendors/animate-css/animate.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard-assets/vendors/sweetalert/sweetalert.css')}}">
    <!-- END: VENDOR CSS-->
    <!-- BEGIN: Page Level CSS-->

    <!-- END: VENDOR CSS-->

    <link rel="stylesheet" type="text/css" href="{{asset('dashboard-assets/css/themes/vertical-modern-menu-template/materialize.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard-assets/css/themes/vertical-modern-menu-template/style.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('dashboard-assets/css/pages/dashboard-modern.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard-assets/css/pages/intro.min.css')}}">
    <!-- END: Page Level CSS-->
    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('dashboard-assets/css/custom/custom.css')}}">

        <!-- END: Footer-->
        <!-- BEGIN VENDOR JS-->
        <script src="{{asset('dashboard-assets/js/vendors.min.js')}}"></script>
            <script src="{{asset('dashboard-assets/vendors/chartjs/chart.min.js')}}"></script>
            <script src="{{asset('dashboard-assets/vendors/sweetalert/sweetalert.min.js')}}"></script>
        <!-- BEGIN THEME  JS-->
        <script src="{{asset('dashboard-assets/js/plugins.min.js')}}"></script>
        <script src="{{asset('dashboard-assets/js/search.min.js')}}"></script>
        <script src="{{asset('dashboard-assets/vendors/data-tables/js/jquery.dataTables.min.js')}}"></script>
        <script src="{{asset('dashboard-assets/js/custom/custom-script.min.js')}}"></script>
        <script src="{{asset('dashboard-assets/js/scripts/customizer.min.js')}}"></script>
        <!-- END THEME  JS-->
        <!-- BEGIN PAGE LEVEL JS-->
        <script src="{{asset('dashboard-assets/js/scripts/dashboard-modern.js')}}"></script>
        <script src="{{asset('dashboard-assets/js/scripts/intro.min.js')}}"></script>
    

</head>
<body class="vertical-layout vertical-menu-collapsible page-header-dark vertical-modern-menu preload-transitions 2-columns   " data-open="click" data-menu="vertical-modern-menu" data-col="2-columns">
   
  <!-- BEGIN: Header-->
  <header class="page-topbar" id="header">
   <div class="navbar navbar-fixed"> 
     <nav class="navbar-main navbar-color nav-collapsible sideNav-lock navbar-dark gradient-45deg-indigo-purple no-shadow" style="background: linear-gradient(45deg, #a23c7a, #f536aa) !important;">
       <div class="nav-wrapper">
        <div class="header-search-wrapper" id="welcometext">
             Welcome {{strtok(strtoupper(substr(Auth::User()->name,0,9)),' ')}} ({{Auth::User()->memberid}})
            </div>
            <script>
          function copyToClipboard(element) {
              
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  
  $temp.remove();
  M.toast({html: 'Copied!'})
}

            </script>
         <ul class="navbar-list right">
           
           {{--
           <li><a class="waves-effect waves-block waves-light notification-button" href="javascript:void(0);" data-target="notifications-dropdown"><i class="material-icons">notifications_none<small class="notification-badge">5</small></i></a></li>
           --}}
           <li><a class="waves-effect waves-block waves-light profile-button" href="javascript:void(0);" data-target="profile-dropdown"><span class="avatar-status avatar-online"><span class="material-icons">accessibility</span><i></i></span></a></li>
           
         </ul>
         {{--
         <ul class="dropdown-content" id="notifications-dropdown">
           <li>
             <h6>NOTIFICATIONS<span class="new badge">5</span></h6>
           </li>
           <li class="divider"></li>
           <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle cyan small">add_shopping_cart</span> A new order has been placed!</a>
             <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">2 hours ago</time>
           </li>
           <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle red small">stars</span> Completed the task</a>
             <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">3 days ago</time>
           </li>
           <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle teal small">settings</span> Settings updated</a>
             <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">4 days ago</time>
           </li>
           <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle deep-orange small">today</span> Director meeting started</a>
             <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">6 days ago</time>
           </li>
           <li><a class="black-text" href="#!"><span class="material-icons icon-bg-circle amber small">trending_up</span> Generate monthly report</a>
             <time class="media-meta grey-text darken-2" datetime="2015-06-12T20:50:48+08:00">1 week ago</time>
           </li>
         </ul>
         --}}
         <!-- profile-dropdown-->
         <ul class="dropdown-content" id="profile-dropdown">
           <li><a class="grey-text text-darken-1" href="{{route('profile')}}"><i class="material-icons">person_outline</i> Profile</a></li>
           <li><a class="grey-text text-darken-1" href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();"><i class="material-icons">keyboard_tab</i> Logout</a>
                          
                          <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                           @csrf
                       </form>
                        </li>
         </ul>
       </div>
    
     </nav>
   </div>
 </header>
 


 <!-- BEGIN: SideNav-->
 <aside class="sidenav-main nav-expanded nav-lock nav-collapsible sidenav-light sidenav-active-square">
   <div class="brand-sidebar">
     <h1 class="logo-wrapper"><a class="brand-logo darken-1" href="{{route('home')}}">
         <img class="hide-on-med-and-down" src="{{asset('web-assets/icon.png')}}" alt="materialize logo"/>
     
     <span class="logo-text hide-on-med-and-down">HEXA HOPE</span></a><a class="navbar-toggler" href="#"><i class="material-icons">radio_button_checked</i></a></h1>
   </div>
   <ul class="menu-actie sidenav sidenav-collapsible leftside-navigation collapsible sidenav-fixed menu-shadow" id="slide-out" data-menu="menu-navigation" data-collapsible="menu-accordion">
   <li class="bold"><a class="waves-effect waves-cyan  " href="{{route('home')}}"><i class="material-icons">phonelink</i><span class="menu-title" data-i18n="Chat">My Office</span></a>
      </li>
<li class="bold "><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)" tabindex="0"><i class="material-icons">person_outline</i><span class="menu-title" data-i18n="CSS">My Profile</span></a>
  <div class="collapsible-body" >
    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
      <li><a href="{{route('profile')}}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Typograpy">View Profile</span></a>
      </li>
      <!--<li><a href="{{route('edit_profile')}}/?action=accountinfo"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Color">Change BTC Address</span></a>-->
      <!--</li>-->
       <li><a href="{{route('edit_profile')}}/?action=password"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Color">Change Password</span></a>
      </li>
      
    </ul>
  </div>
</li>
     
  @if(Auth::User()->hasRole('user'))
  <li class="bold"><a class="waves-effect waves-cyan  " href="{{route('send_fund_requests')}}"><i class="material-icons">swap_horiz</i><span class="menu-title" data-i18n="Chat">Fund Requests</span></a>
      </li>
      
      <li class="bold"><a class="waves-effect waves-cyan  " href="{{route('member_activation')}}"><i class="material-icons">compare</i><span class="menu-title" data-i18n="Chat">Buy Package</span></a>
      </li>
   @endif   
       <li class="bold "><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)" tabindex="0"><i class="material-icons">supervisor_account</i><span class="menu-title" data-i18n="CSS">My Team</span></a>
  <div class="collapsible-body" >
    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
         <li><a href="{{url('/')}}/register/?memberid={{Auth::User()->memberid}}" target="_blank"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Color">Add New Partner</span></a>
      </li>
      
      <li><a href="{{route('get_directes')}}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Color">Direct Partner</span></a>
      </li>
      <li><a href="{{route('downline')}}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Color">Team Partner </span></a>
      </li>
       <li><a href="{{route('tree')}}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Typograpy">Tree View</span></a>
      </li>
     
    </ul>
  </div>
</li>

@if(Auth::User()->hasRole('user'))
 <!--<li class="bold"><a class="waves-effect waves-cyan  " href="{{route('fundtransfer')}}"><i class="material-icons">account_balance</i><span class="menu-title" data-i18n="Chat">Wallet</span></a>-->
 <!-- </li>-->
   <li class="bold "><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)" tabindex="0"><i class="material-icons">account_balance</i><span class="menu-title" data-i18n="CSS">My Wallet</span></a>
  <div class="collapsible-body" >
    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
      <li><a href="{{route('all_income')}}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Color">Income Wallet</span></a>
      </li>
      <li><a href="{{route('fundtransfer')}}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Color">TopUp Wallet</span></a>
      </li>
      <!--<li><a href="{{route('money.index')}}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Typograpy">Level Profits</span></a>-->
      <!--</li>-->
    
      <!--  <li ><a href="{{route('money.pool')}}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Color">Pool Incomes</span></a>-->
      <!--    </li>-->
      <!--     <li ><a href="{{route('myloyality')}}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Color">Loyality Incomes</span></a>-->
      <!--    </li>-->
      <!--<li><a href="{{route('wallet')}}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Color">Withdraw</span></a>-->
      <!--</li>-->
        <li><a href="{{route('flush_income')}}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Color">Lost Income</span></a>
      </li>
    </ul>
  </div>
</li>
 @endif
  @if(Auth::User()->hasRole('admin'))
      <li class="bold"><a class="waves-effect waves-cyan  " href="{{route('users.index')}}"><i class="material-icons">perm_identity</i><span class="menu-title" data-i18n="Chat">Users</span></a>
      </li>
      <li class="bold"><a class="waves-effect waves-cyan  " href="{{route('topup_wallet')}}"><i class="material-icons">swap_horiz</i><span class="menu-title" data-i18n="Chat">Topup Wallet</span></a>
      </li>
      <li class="bold"><a class="waves-effect waves-cyan  " href="{{route('wallet_requests')}}"><i class="material-icons">swap_horiz</i><span class="menu-title" data-i18n="Chat">Withdraw Requests</span></a>
      </li>
     <li class="bold"><a class="waves-effect waves-cyan  " href="{{route('member_fund_requests')}}"><i class="material-icons">swap_horiz</i><span class="menu-title" data-i18n="Chat">Fund Requests</span></a>
      </li>
       <li class="bold"><a class="waves-effect waves-cyan  " href="{{route('check_pool')}}"><i class="material-icons">swap_horiz</i><span class="menu-title" data-i18n="Chat">Auto Pool</span></a>
      </li>
      <li class="bold"><a class="waves-effect waves-cyan  " href="{{route('settings')}}"><i class="material-icons">swap_horiz</i><span class="menu-title" data-i18n="Chat">Settings</span></a>
      </li>
      <li class="bold"><a class="waves-effect waves-cyan  " href="{{route('admin_enquiries')}}"><i class="material-icons">swap_horiz</i><span class="menu-title" data-i18n="Chat">Enquiries</span></a>
      </li>
      <li class="bold"><a class="waves-effect waves-cyan  " href="{{route('admin_loyality')}}"><i class="material-icons">swap_horiz</i><span class="menu-title" data-i18n="Chat">Loyality</span></a>
      </li>
 @endif

{{--
  <li class="bold "><a class="collapsible-header waves-effect waves-cyan " href="JavaScript:void(0)" tabindex="0"><i class="material-icons">invert_colors</i><span class="menu-title" data-i18n="CSS">Promo</span></a>
  <div class="collapsible-body" >
    <ul class="collapsible collapsible-sub" data-collapsible="accordion">
      <li><a href="{{route('tree')}}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Typograpy">Banner</span></a>
      </li>
      <li><a href="{{route('downline')}}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Color">YouTube</span></a>
      </li>
      <li><a href="{{route('downline')}}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Color">Testimonial</span></a>
      </li>
      <li><a href="{{route('downline')}}"><i class="material-icons">radio_button_unchecked</i><span data-i18n="Color">Referral Link with Msg</span></a>
      </li>
    </ul>
  </div>
</li>
--}}
@if(Auth::User()->hasRole('admin'))
   <li class="bold"><a class="waves-effect waves-cyan  " href="{{route('admin_suppots')}}"><i class="material-icons">person_outline</i><span class="menu-title" data-i18n="Chat">Support</span></a>
  </li>
 @else
  <li class="bold"><a class="waves-effect waves-cyan  " href="{{route('support')}}"><i class="material-icons">person_outline</i><span class="menu-title" data-i18n="Chat">Support</span></a>
  </li>
  @endif
    <li class="bold"><a class="waves-effect waves-cyan  "  href="{{ route('logout') }}"
            onclick="event.preventDefault();
                          document.getElementById('logout-form').submit();"><i class="material-icons">person_outline</i><span class="menu-title" data-i18n="Chat">Logout</span></a>
  </li>
   </ul>
   <div class="navigation-background"></div><a class="sidenav-trigger btn-sidenav-toggle btn-floating btn-medium waves-effect waves-light hide-on-large-only" href="#" data-target="slide-out"><i class="material-icons">menu</i></a>
 </aside>
 <!-- END: SideNav-->

 <!-- BEGIN: Page Main-->
<div id="thisreload">
 <div id="main">
   <div class="row">
     <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
     <div class="col s12">
       <div class="container">
         <div class="section">
@yield('content')
</div><!-- START RIGHT SIDEBAR NAV -->

<!-- END RIGHT SIDEBAR NAV -->
       </div>
       <div class="content-overlay"></div>
     </div>
   </div>
 </div>
</div>
 <!-- END: Page Main-->

 <!-- Theme Customizer -->



 



<script>
       var windowURL = window.location.href;
        pageURL = windowURL.substring(0, windowURL.lastIndexOf('/'));
     
        var x= $('.menu-actie a[href="'+pageURL+'"]');
            x.addClass('active');
            x.parent().addClass('active');
        var y= $('.menu-actie a[href="'+windowURL+'"]');
            y.addClass('active');
            y.parent().addClass('active');
   </script>
</body>
</html>
