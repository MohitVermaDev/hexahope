
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <!-- Global site tag (gtag.js) - Google Analytics -->
<script async src="https://www.googletagmanager.com/gtag/js?id=UA-157072769-1"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'UA-157072769-1');
</script>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@if(isset($title)){{ $title }}@endif - {{site_name_new()}}</title>

    <link href="{{asset('web-assets/icon.png')}}" rel="shortcut icon" type="image/png">


<!-- Stylesheet -->
<link href="{{asset('web-assets/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('web-assets/css/animate.min.css')}}" rel="stylesheet" type="text/css">
<link href="{{asset('web-assets/css/javascript-plugins-bundle.css')}}" rel="stylesheet"/>

<!-- CSS | menuzord megamenu skins -->
<link href="{{asset('web-assets/js/menuzord/css/menuzord.css')}}" rel="stylesheet"/>

<!-- CSS | timeline -->
<link href="{{asset('web-assets/js/timeline-cp-responsive-vertical/timeline-cp-responsive-vertical.css')}}" rel="stylesheet" type="text/css">

<!-- CSS | Main style file -->
<link href="{{asset('web-assets/css/style-main.css')}}" rel="stylesheet" type="text/css">
<link id="menuzord-menu-skins" href="{{asset('web-assets/js/menuzord/css/skins/menuzord-rounded-boxed.css')}}" rel="stylesheet"/>

<!-- CSS | Responsive media queries -->
<link href="{{asset('web-assets/css/responsive.css')}}" rel="stylesheet" type="text/css">
<!-- CSS | Style css. This is the file where you can place your own custom css code. Just uncomment it and use it. -->

<!-- CSS | Theme Color -->
<link href="{{asset('web-assets/css/colors/theme-skin-color-set1.css')}}" rel="stylesheet" type="text/css">
<link rel="stylesheet" type="text/css" href="{{asset('dashboard-assets/vendors/sweetalert/sweetalert.css')}}">
<!-- external javascripts -->
<script src="{{asset('web-assets/js/jquery.js')}}"></script>
<script src="{{asset('web-assets/js/bootstrap.min.js')}}"></script>
<script src="{{asset('web-assets/js/javascript-plugins-bundle.js')}}"></script>
<script src="{{asset('web-assets/js/menuzord/js/menuzord.js')}}"></script>
<script src="{{asset('dashboard-assets/vendors/sweetalert/sweetalert.min.js')}}"></script>
<!-- Revolution Slider 5.x CSS settings -->
<link  href="{{asset('web-assets/js/revolution-slider/css/settings.css')}}" rel="stylesheet" type="text/css"/>
<link  href="{{asset('web-assets/js/revolution-slider/css/layers.css')}}" rel="stylesheet" type="text/css"/>
<link  href="{{asset('web-assets/js/revolution-slider/css/navigation.css')}}" rel="stylesheet" type="text/css"/>

<!-- Revolution Slider 5.x SCRIPTS -->
<script src="{{asset('web-assets/js/revolution-slider/js/jquery.themepunch.tools.min.js')}}"></script>
<script src="{{asset('web-assets/js/revolution-slider/js/jquery.themepunch.revolution.min.js')}}"></script>
<script>
jQuery(document).on('focus', '.select2-selection.select2-selection--single', function (e) {
  jQuery(this).closest(".select2-container").siblings('select:enabled').select2('open');
});

// steal focus during close - only capture once and stop propogation
jQuery('select.select2').on('select2:closing', function (e) {
  jQuery(e.target).data("select2").$selection.one('focus focusin', function (e) {
    e.stopPropagation();
  });
});
</script>
</head>
<body class="tm-enable-navbar-scrolltofixed tm-enable-navbar-always-visible-on-scroll">
    <div id="wrapper" class="clearfix"  >
        <!-- Header -->
        <header id="header" class="header header-layout-type-header-2rows">
            <div class="header-top ">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-auto header-top-left align-self-center text-center text-xl-left">
                            <ul class="element contact-info">
                                
                                <li class="contact-email"><i class="fa fa-envelope-o font-icon sm-display-block"></i> info@hexahope.com</li>
                            </ul>
                        </div>
                        <div class="col-xl-auto ml-xl-auto header-top-right align-self-center text-center text-xl-right">
                            <div class="element">
                                <ul class="header-top-nav list-inline">
                                   
                                    <li class="menu-item">
                                        @guest
                                        <a title="Home" class="menu-item-link" id="four" href="{{route('login')}}" data-toggle="modal" data-target="#newloginmodal"><strong>Login</strong></a>
                                        
     

@else
<a title="Home" class="menu-item-link" id="four" href="{{route('home')}}"><strong>{{Auth::User()->name}}</strong></a>
@endguest
</li>
                                    <li class="menu-item"><a title="Home" class="menu-item-link" href="{{route('register')}}"><strong>Register</strong></a></li>
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-nav">
                <div class="header-nav-wrapper {{ (request()->routeIs('login') ? 'navbar-scrolltofixed' : '' )}} {{ (request()->routeIs('register') ? 'navbar-scrolltofixed' : '' )}} green">
                    <div class="menuzord-container header-nav-container green ">
                        <div class="container position-relative">
                            <div class="row">
                                <div class="col">
                                    <div class="row header-nav-col-row">
                                        <div class="col-sm-auto align-self-center">
                                        <a class="menuzord-brand site-brand no-padding" href="{{route('homepage')}}">
                                            <img class="logo-default logo-1x" src="{{asset('web-assets/logo.png')}}" alt="Logo">
                                                <img class="logo-default logo-2x retina" src="{{asset('web-assets/logo.png')}}" alt="Logo">
                                            </a>
                                        </div>
                                        <div class="col-sm-auto ml-auto pr-0 align-self-center">
                                            <nav id="top-primary-nav" class="menuzord green" data-effect="fade" data-animation="none" data-align="right">
                                                <ul id="main-nav" class="menuzord-menu">
                                                    <li class="active"><a href="{{route('homepage')}}">Home</a></li>
                                                    <li><a href="{{url('/')}}#about-section">About Us</a></li>
                                                    <li><a href="{{url('/')}}/HexaHope.pdf" target="_blank">Opportunity</a></li>
                                                    <li><a href="{{url('/')}}#contact-background">Contact</a></li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                    <div class="row d-block d-xl-none">
                                       <div class="col-12">
                                          <nav id="top-primary-nav-clone" class="menuzord d-block d-xl-none default menuzord-color-default menuzord-border-boxed menuzord-responsive" data-effect="slide" data-animation="none" data-align="right" style="">
                                             <ul id="main-nav-clone" class="menuzord-menu menuzord-right menuzord-indented scrollable">
                                             </ul>
                                          </nav>
                                       </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        @yield('content')
       <!-- Footer -->
       <footer id="footer" class="footer">
        <div class="footer-widget-area">
            <div class="container pt-90 pb-60 {{ (request()->routeIs('login') ? 'loginregisterfooter' : '' )}} {{ (request()->routeIs('register') ? 'loginregisterfooter' : '' )}}">
                <div class="row">
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class=" split-nav-menu clearfix widget widget-contact-info clearfix">
                            <div class="tm-widget tm-widget-contact-info contact-info contact-info-style1  contact-icon-theme-colored1">
                                <div class="thumb">
                                    <img alt="Logo" src="{{asset('web-assets/logo.png')}}">
                                </div>
                                <div class="description">203, Envato Labs, Behind Alis Steet, USA.</div>
                                <ul>
                                    <li class="contact-email">
                                        <div class="icon"><i class="icon-globe"></i></div>
                                        <div class="text"><a href="mailto:info@hexahope.com">info@hexahope.com</a></div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                  
                    </div>
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class="widget widget_nav_menu">
                            <h4 class="widget-title ">Useful Links</h4>
                            <div class="menu-quick-links-container">
                                <ul class="menu">
                                    <li id="menu-item-16307" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-16307"><a href="{{url('/')}}#about-section">About Us</a></li>
                                    <li id="menu-item-16308" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-16308"><a href="#">Online Video</a></li>
                                    <li id="menu-item-16309" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-16309"><a href="{{url('/')}}#contact-background">Contact</a></li>
                                    <!--<li id="menu-item-16309" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-16309"><a href="#">Latest News</a></li>-->
                                    <li id="menu-item-16309" class="menu-item menu-item-type-custom menu-item-object-custom menu-item-16309"><a href="{{route('register')}}">Registration</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                  
                    <div class="col-sm-6 col-md-6 col-lg-4">
                        <div class=" split-nav-menu clearfix widget widget-opening-hours-compressed clearfix">
                            <h4 class="widget-title ">Opening Hours</h4>
                            <ul class="tm-widget tm-widget-opening-hours tm-widget-opening-hours-compressed opening-hours border-dark">
                                <li class="clearfix"> <span>Monday - Saturday</span>
                                    <div class="value">9.00 - 17.00</div>
                                </li>
                               
                                <li class="clearfix"> <span>Sunday</span>
                                    <div class="value">Closed</div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer-bottom" data-tm-bg-color="#2A2A2A">
                <div class="container">
                    <div class="row pt-20 pb-20">
                        <div class="col-sm-12">
                            <div class="footer-paragraph">
                                © {{date('Y')}} {{site_name_new()}}. All Rights Reserved.
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
</div>
<!-- end wrapper -->

<!-- Footer Scripts -->
<!-- JS | Custom script for all pages -->
<script src="{{asset('web-assets/js/custom.js')}}"></script>

<!-- SLIDER REVOLUTION 5.0 EXTENSIONS  
        (Load Extensions only on Local File Systems ! 
         The following part can be removed on Server for On Demand Loading) -->
<script src="{{asset('web-assets/js/revolution-slider/js/extensions/revolution.extension.actions.min.js')}}"></script>
<script src="{{asset('web-assets/js/revolution-slider/js/extensions/revolution.extension.carousel.min.js')}}"></script>
<script src="{{asset('web-assets/js/revolution-slider/js/extensions/revolution.extension.kenburn.min.js')}}"></script>
<script src="{{asset('web-assets/js/revolution-slider/js/extensions/revolution.extension.layeranimation.min.js')}}"></script>
<script src="{{asset('web-assets/js/revolution-slider/js/extensions/revolution.extension.migration.min.js')}}"></script>
<script src="{{asset('web-assets/js/revolution-slider/js/extensions/revolution.extension.navigation.min.js')}}"></script>
<script src="{{asset('web-assets/js/revolution-slider/js/extensions/revolution.extension.parallax.min.js')}}"></script>
<script src="{{asset('web-assets/js/revolution-slider/js/extensions/revolution.extension.slideanims.min.js')}}"></script>
<script src="{{asset('web-assets/js/revolution-slider/js/extensions/revolution.extension.video.min.js')}}"></script>

@guest
<style>

@media screen and (min-width: 768px) { 
  #newloginmodal.modal:before {
    display: inline-block;
    vertical-align: middle;
    content: " ";
    height: 100%;
  }
}

#newloginmodal .modal-dialog {
  display: inline-block;
  text-align: left;
  vertical-align: middle;
}
</style>
   <div id="newloginmodal" class="modal fade" role="dialog" style="
    background-image: url({{asset('web-assets/bgimage.jpg')}});
    background-repeat: no-repeat;
        text-align: center;
    background-size: cover;">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      
      <div class="modal-body" style="padding:0px">
       <h4 style="width: 100%;
    text-align: center;
    background: #fff;
    background-image: linear-gradient(to right, #003d7a, #0854a5, #ff3ab2, #e02e9a, #962168);
    margin: 0;
    padding: 26px;
    color: #fff;
   
    font-weight: 900;">
           Enter Your Login Details 
</h4>
        <form  method="POST" id="popsendlogin" style="text-align: left;
    padding: 0px 30px 34px 30px;">
                    @csrf
                    <div id="allloadingn"><img src="https://thumbs.gfycat.com/BitterEarnestBeardeddragon-small.gif" style="width:100%;height:90px;object-fit:contain;display:none"></div>
              <div id="allerrors"></div>
                 <br>
                
                 <div class="row" >
                     <div class="col-md-12">
                           <div class="form-group ">
                                 <label for="memberid">Partner ID</label>
                                 <input id="memberid" type="text" class="form-control  @error('memberid') is-invalid @enderror" name="memberid" style="border:1px solid #c3c3c3  !important" value="{{ old('memberid') }}" required >
                                 @error('memberid')
                                   <span class="invalid-feedback" style="display:block" role="alert">
                                      <strong>{{ $message }}</strong>
                                   </span>
                                 @enderror
                               </div>
                     </div>
                     <div class="col-md-12">
                           <div class="form-group ">
                                 <label for="password">Password</label>
                                 <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" style="border:1px solid #c3c3c3  !important"  required autocomplete="current-password">
            
                                 @error('password')
                                     <span class="invalid-feedback" style="display:block" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror
                               </div>
                     </div>
                 </div>
                
               
                
                  <div  style="    margin-top: 15px;">
                     
                        <button class="btn btn-success" type="submit" style="
    float: right;
    font-weight: 700;
">
                        Submit
                        </button>
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
                  <div class="text-center" style="    margin-top: 15px;">
                     <span class="txt1">
                     To Be Partner 
                     </span>
                     <a class="txt2" href="{{ route('register') }}">
                     Sign Up Here
                     </a>
                  </div>
               </form>
      </div>
     
    </div>

  </div>
</div>
<script>
       jQuery('#popsendlogin').submit(function(e){
      e.preventDefault();
      var memberid = jQuery('#memberid').val();
      var password = jQuery('#password').val();
      
      jQuery('#allloadingn img').css('display','block');  
      jQuery.ajax({
        
         url: '{{route("login")}}',
         method: 'POST',
         data:{
            'memberid':memberid,
            'password':password,
            '_token':'{{csrf_token()}}',
         },
         success:function(suc){
             if(suc.success){
            jQuery('#allerrors').html('');
            // jQuery('#allerrors').html('<div class="alert alert-success" role="alert">Successfully Authenticated! Redirecting you to your dashboard</div>');  
            // swal("Successfully Authenticated!", "Redirecting......", "success");
                // setTimeout(function() {
                    jQuery('#allloadingn img').css('display','none');  
                    window.location.href = '{{route("home")}}';
                // }, 2000);
            }else if(suc.error)
            {
                var errr = suc.error;
                        jQuery('#allerrors').html('');
                        jQuery('#allloadingn img').css('display','none');  
                        jQuery(errr).each(function(key,val){
                            
                           jQuery('#allerrors').append('<div class="alert alert-danger" role="alert">'+val+'</div>');
                        });
            }
         
         },
         error:function(err){
            var errr = err.responseJSON;
            jQuery('#allerrors').html('');
            jQuery('#allloadingn img').css('display','none');  
            jQuery(errr).each(function(key,val){
                
               jQuery('#allerrors').append('<div class="alert alert-danger" role="alert">'+val.message+'</div>');
            });
            setTimeout(function(){ 
              window.location.reload();
             }, 2000);
         }
      });
   });
</script>
@endguest
<script>
      jQuery(function() {
         
          
        jQuery('a[href*=\\#]:not([href=\\#])').click(function() {
            if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
                var target = jQuery(this.hash);
                target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
                if (target.length) {
                    jQuery('html,body').animate({
                        scrollTop: target.offset().top
                    }, 1000);
                    return false;
                }
            }
        });
    });

</script>

</body>
</html>
