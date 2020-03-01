<?php
$totaldirect = gettotalsponsers(Auth::id());
if($totaldirect < 1)
{
    echo '<script>
    alert("You Dont have Enough Sponser");
    window.location.href="'.route('home').'"
    </script>';
}

?>
@extends('layouts.app')
@section('content')

<style>
  .dataTables_empty,.dataTables_processing
  {
    text-align: center;
  }
  
</style>





      <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
          <div class="row">
            <div class="col s12 m4 l4">
              <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{$title}}</span></h5>
              <ol class="breadcrumbs mb-0">
              <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a>
                </li>
              
                <li class="breadcrumb-item active">{{$title}}
                </li>
              </ol>
            </div>
            <div class="col s12 m8 l8">
               
               
            </div>
       
          </div>
        </div>
      </div>
      <div class="row" style="min-height: 1000px;">
       <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h5>Wallet Balance : {{Auth::User()->wallets[1]->amount}}</h5>
                </div>
            </div>
        </div>
         
     
        <div id="admin" class="col s12">
          <div class="card">
            <div class="card-content">
                <form action="" method="POST" id="fundwidthmoney">
                    @csrf
                    <input type="hidden" name="otp" id="fund_otp" value="">
                    <div id="fundthiserrors"></div>
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="text" required name="user_nameid" id="user_nameid">
                            <label>Enter Partner ID</label>
                            <span id="membererror"></span>
                        </div>
                        <div class="input-field col s12">
                            <select class="validate" required name="fundfinalamount" id="fundfinalamount">
                                <option value="">--Select USD--</option>
                                @for($i=1;$i<=50;$i++)
                                    <option value="{{$i}}">{{$i*5}}</option>
                                @endfor
                            </select>
                        </div>
                        <div class="input-field col s12">
                            <textarea style="border:0px solid #eee;border-bottom:1px solid #ddd"  name="remarks" id="remarks"></textarea>
                            <label>REMARKS</label>
                            <span id="remarks"></span>
                        </div>
                         <div class="input-field col s12 otp_none">
                          <button class="btn" id="thisfundsubmit" type="submit">Verify</button>
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
          </div>
        </div>

      </div>
        <script type="text/javascript">
        
        $('#fundfinalamount').change(function(e){
               e.preventDefault();
               if($(this).val() == '' || isNaN($(this).val()))
               {
                   $('#fundthiserrors').html('<span style="color:red;font-weight:800">Select Amount First</span>');
                   return false;
               }
               checkmybalance($(this).val(),'#fundthiserrors','#thisfundsubmit',1,2);
           });
         $('#user_nameid').on('change',function(e){
             e.preventDefault();
             var user_nameid = $(this).val();
             $('#membererror').html();
             if(user_nameid == ''){
                 $('#membererror').css('color','green').css('font-weight','800').html('Enter User Name First');
                 return false;
             }
             $.ajax({
                   url:"{{route('check_downline_user')}}",
                   method:"POST",
                   data:{
                       '_token':"{{csrf_token()}}",
                       'user_nameid':user_nameid
                   },success:function(suc){
                        if(suc.error){
                           $('#membererror').css('color','red').css('font-weight','800').html(suc.error);
                           $('#thisfundsubmit').attr('disabled',true);
                           return false;
                       }else if(suc.success){
                           $('#membererror').css('color','green').css('font-weight','800').html(suc.success);
                            $('#thisfundsubmit').attr('disabled',false);
                           
                       }
                   }
               });
         });
        $('#fundwidthmoney').submit(function(e){
               e.preventDefault();
               $('#thisfundsubmit').attr('disabled',true);
               
               var total = $('#fundfinalamount').val();
               var user_nameid = $('#user_nameid').val();
               var remarks = $('#remarks').val();
               if(total == '' || isNaN(total))
               {
                   $('#fundthiserrors').html('<span style="color:red;font-weight:800">Select Amount First</span>');
                   return false;
               }
               checkmybalance(total,'#fundthiserrors','#thisfundsubmit',1,2);
               send_otp();
               $('#thisfundsubmit').attr('disabled',true);
             
           });
          function send_otp(){
               $.ajax({
                   url:"{{route('send_otp')}}",
                   method:'POST',
                   data:{
                        '_token':"{{csrf_token()}}",
                        'type':3
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
               var total = $('#fundfinalamount').val();
               var user_nameid = $('#user_nameid').val();
               var remarks = $('#remarks').val();
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
                           $('#withdrow_otp').val(otp);
                           swal({icon:'success',title:suc.success});
                           $.ajax({
                              url:"{{route('transfertouser')}}",
                              method:"POST",
                              data:{
                                  '_token':"{{csrf_token()}}",
                                  'oldamount':total,
                                  'user_nameid':user_nameid,
                                  'remarks':remarks,
                                  'otp':otp
                              },success:function(sucw){
                                    if(sucw.error){
                                     swal({icon:'error',title:sucw.error});
                                      $('#thisfundsubmit').attr('disabled',true);
                                      return false;
                                  }else if(sucw.success){
                                      $('#fundthiserrors').html('');
                                        swal({icon:'success',title:sucw.success});
                                        window.location.reload();
                                  }
                              }
                          });
                       }else
                       {
                           swal({icon:'error',title:suc.error});
                       }
                   },
                   error:function(err){
                       swal({icon:'error',title:'Something Went Wrong'});
                   }
               });
           });
           function checkmybalance(old,errornew,blockbtn,wallettype,chargeacc)
           {
               $.ajax({
                   url:'{{route("checkmybalance")}}',
                   method:'POST',
                   data:{
                       '_token':'{{csrf_token()}}',
                       'oldamount':old,
                       'wallettype':wallettype,
                       'chargeacc':chargeacc
                   },
                   success:function(suc){
                       if(suc.error){
                           $(errornew).html('<span style="color:red;font-weight:800">'+suc.error+'</span>');
                           $(blockbtn).attr('disabled',true);
                           return false;
                       }else if(suc.success){
                           if(chargeacc==2){
                          
                            $(errornew).html(suc.success);
                           }else
                           {
                                $(errornew).html('');
                           }
                            $(blockbtn).attr('disabled',false);
                            return true;
                       }
                   }
               });
            }
          
           
       
          </script>
  @endsection