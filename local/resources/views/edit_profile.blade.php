@extends('layouts.app')
@section('content')

<div class="users-view">
    <!-- users view media object start -->
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
          <div class="row">
            <div class="col s10 m6 l6">
              <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{$title}}</span></h5>
              <ol class="breadcrumbs mb-0">
              <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a>
                </li>
              
                <li class="breadcrumb-item active">{{$title}}
                </li>
              </ol>
            </div>
           
          </div>
        </div>
      </div>
    <div class="card-panel">
      <div class="row">
        <div class="col s12 m7">
          <div class="display-flex media">
            <a href="#" class="avatar">
               @if(Auth::User()->profile_image != '')
                    <img src="{{url('/images')}}/{{Auth::User()->profile_image}}" style="width:100px;margin:0 auto;display:block" class="circle">
                    @else
                    <img src="{{asset('dashboard-assets/NEWIM.png')}}" style="width:100px;margin:0 auto;display:block" class="circle">
                @endif
              </a>
            <div class="media-body">
              <h6 class="media-heading">
                <span class="users-view-name">{{Auth::User()->name}} </span>
                <span class="grey-text">@</span>
                <span class="users-view-username grey-text">{{Auth::User()->memberid}}</span>
              </h6>
              <span>Plan:</span>
               <span class="users-view-id"><?php if(Auth::User()->plan_id==1){ echo 'Hexa Master (10$)';}
              elseif(Auth::User()->plan_id==2){echo 'Hexa Royal (15$)';}
              elseif(Auth::User()->plan_id==3){echo 'Hexa Diamond (50$)';}
              elseif(Auth::User()->plan_id==4){echo 'Hexa Crown (75$)';}
              ?></span>
            </div>
          </div>
        </div>
        
      </div>
    </div>
    <!-- users view media object ends -->
    <!-- users view card data start -->
    <div class="card">
      <div class="card-content">
        <div class="row">
       
    <div class="col s12">
      <ul class="tabs">
        {{--
        <li class="tab col s3"><a class="active" href="#personalinfo">Personal Info</a></li>
        --}}
        <li class="tab col s3"><a <?php if(isset($_GET['action'])){ if($_GET['action']=='accountinfo'){ echo 'class="active"'; }}?> href="#accountinfo">BTC Account</a></li>
        <li class="tab col s3"><a <?php if(isset($_GET['action'])){ if($_GET['action']=='password'){ echo 'class="active"'; }}?> href="#password">Password</a></li>
      </ul>
    </div>
     {{--
    <div id="personalinfo"  class="col s12 ">
        <br>
        <br>
        
         @if(count($errors) > 0)
                        @foreach($errors->all() as $error)
                            <div class="card-alert card gradient-45deg-red-pink">
                                <div class="card-content white-text">
                                {{$error}}
                            </div> </div>
                        @endforeach
                    @endif

                        @if(session('success'))
                        <div class="card-alert card gradient-45deg-green-teal">
                            <div class="card-content white-text">
                                {{session('success')}}
                            </div>
                        </div>
                        
                        @endif
                        
                        @if(session('error'))
                            <div class="card-alert card gradient-45deg-red-pink">
                                <div class="card-content white-text">
                                    {{session('error')}}
                                </div>

                            </div>
                        @endif
        <form action="{{route('update_profile')}}" method="POST" class="update_profile">
            @csrf
            {{method_field('PUT')}}
            <div class="row">
                <div class="input-field col s6">
                    <input type="text" class="validate" value="{{Auth::User()->name}}" name="name">
                    <label>Name</label>
                </div>
                <div class="input-field col s6">
                    <input type="text" class="validate" value="{{Auth::User()->email}}" name="email">
                    <label>Email</label>
                </div>
                <div class="input-field col s6">
                    <input type="text" class="validate" value="{{Auth::User()->mobile}}" name="mobile" id="mobile">
                    <label>Mobile</label>
                </div>
                 <div class="input-field col s12">
                    <button type="submit" class="btn">Save</button>
                </div>
            </div>
        </form>
    </div>
      --}}
    <div id="accountinfo" class="col s12 <?php if(isset($_GET['action'])){ if($_GET['action']=='accountinfo'){ echo 'active'; }}?>">
        <br>
        <br>
      
        <form action="{{route('update_accounts')}}" method="POST" class="update_accounts" id="update_accounts">
            @csrf
            {{method_field('PUT')}}
            <input type="hidden" value="" name="acc_otp">
            <div class="row">
                <div class="input-field col s6">
                    <input type="text" class="validate" value="{{Auth::User()->btc_add}}" name="btc_add" id="btc_add" required>
                    <label>BTC Address</label>
                </div>
               <div class="input-field col s12 otp_none">
                <button type="submit" class="btn" id="update_acc">Send OTP</button>
                </div>
            </div>
        </form>
        <br>
            <form method="POST" id="check_otp_form" style="display:none">
                @csrf
                <div class="success_messege"></div>
                <div class="row">
                    <div class="input-field col s12">
                        <input type="number" value="" name="new_otp" id="check_otp">
                        <label>Enter OTP</label>
                    </div>
                    <div class="input-field col s12">
                        <button class="btn" id="this_otp_sub" type="submit">Submit</button>
                    </div>
                </div>
            </form>
    </div>
     <div id="password" class="col s12 <?php if(isset($_GET['action'])){ if($_GET['action']=='password'){ echo 'active'; }}?>">
        <br>
        <br>
        
        <form action="{{route('update_password')}}" method="POST" class="update_password">
            @csrf
            {{method_field('PUT')}}
            <div class="row">
                <div class="input-field col s12">
                    <input type="text" class="validate" name="old_password" id="old_password" required>
                    <label>Old Password</label>
                </div>
                <div class="input-field col s6">
                    <input type="text" class="validate" name="new_password" id="new_password" required>
                    <label>New Password</label>
                </div>
                <div class="input-field col s6">
                    <input type="text" class="validate" name="confirm_password"  id="confirm_password" required>
                    <label>Confirm Password</label>
                </div>
               <div class="input-field col s12">
                <button type="submit" class="btn">Save</button>
                </div>
            </div>
        </form>
    </div>
 
        </div>
      </div>
    </div>
    <!-- users view card data ends -->
  
  <script>
   var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
   $('.update_profile').submit(function(){
       if (!filter.test($('#mobile').val())) {
            swal('Mobile Number Not Valid');
        return false;
    }
       return true;
   });
      $('.update_password').submit(function(){
       if ($('#old_password').val()=='') {
            swal('Old Password is Required');
        return false;
    }
    if ($('#new_password').val()=='') {
            swal('New Password is Required');
        return false;
    }
    if ($('#confirm_password').val()=='') {
            swal('Confirm Password is Required');
        return false;
    }
     if ($('#confirm_password').val()!=$('#new_password').val()) {
            swal('New Password & Confirm Password is not matched');
        return false;
    }
       return true;
   });
   $('#update_accounts').submit(function(e){
       e.preventDefault();
       $('#update_acc').attr('disabled',true);
       send_otp();
   });
            function send_otp(){
               $.ajax({
                   url:"{{route('send_otp')}}",
                   method:'POST',
                   data:{
                        '_token':"{{csrf_token()}}",
                        'type':1,
                   },
                   success:function(suc)
                   {
                        swal({
                          icon: "success",
                          title: suc.success
                        });
                       $('.otp_none').css('display','none');
                       $('#check_otp_form').css('display','block');
                       $('#this_otp_sub').attr('disabled',false);
                       $('.success_messege').html(suc.success);
                   }
               });
           }
           $('#check_otp_form').submit(function(e){
               e.preventDefault();
               var otp = $('#check_otp').val();
               var btc_add = $('#btc_add').val();
               $.ajax({
                   url:"{{route('check_otp')}}",
                   method:'POST',
                   data:{
                        '_token':"{{csrf_token()}}",
                        'otp':otp
                   },
                   success:function(suc)
                   {
                       if(suc.success){
                           
                           swal({
                              icon: "success",
                              title: suc.success
                            });
                           $.ajax({
                               url:"{{route('update_accounts')}}",
                               method:'PUT',
                               data:{
                                    '_token':"{{csrf_token()}}",
                                    'btc_add':btc_add,
                                    'acc_otp':otp,
                               },success:function(susc){
                                    if(susc.error){
                                        swal({
                                              icon: "error",
                                              title: susc.error
                                            });
                                        $('#update_acc').attr('disabled',true);
                                        return false;
                                  }else if(susc.success){
                                        $('#update_acc').attr('disabled',true);
                                        swal({
                                              icon: "success",
                                              title: susc.success
                                            });
                                        
                                        window.location.reload();
                                  }
                              }
                           });
                       }else
                       {
                           swal({
                              icon: "error",
                              title: suc.error
                            });
                       }
                   },
                   error:function(err){
                       swal({
                              icon: "error",
                              title: 'Something Went Wrong'
                            });
                   }
               });
           });
                   
  </script>
  </div>
@endsection