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
            <div class="col s12 m6 l6">
              <h5 class="breadcrumbs-title mt-0 mb-0"><span>Withdrawal Income</span></h5>
              <ol class="breadcrumbs mb-0">
              <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a>
                </li>
              
                <li class="breadcrumb-item active">{{$title}}
                </li>
              </ol>
            </div>
            <div class="col s12 m6 l6">
                
              
            </div>
       
          </div>
        </div>
      </div>
      <div class="row">
       <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h5>Income Balance : {{intval(Auth::User()->wallets[0]->amount)}}</h5>
                </div>
            </div>
        </div>
        <div class="col s12">
        <div class="card">
          <div class="card-content ">
           <form action="{{route('withdrawsucced')}}" method="POST" id="widthmoney">
                        @csrf
                        <input type="hidden" name="otp" id="withdrow_otp" value="">
                        <div id="thiserrors"></div>
                        <div class="row">
                            <div class="input-field col s12">
                                <select class="validate" required name="finalamount" id="finalamount">
                                    <option value="">--Select Amount--</option>
                                    @for($i=1;$i<=50;$i++)
                                        <option value="{{$i}}">{{$i*20}}</option>
                                    @endfor
                                </select>
                            </div>
                            
                            <div class="input-field col s12">
                                <?php $btc = Auth::User()->btc_ad;?>
                                
                                <span style="width:100%">BTC Address: {{Auth::User()->btc_add}} <a href="{{url('edit_profile?action=accountinfo')}}" class="btn right" target="_blank">Update BTC</a> <br> <span style="color:red;font-size: 11px;">Add BTC Address to Withdraw</span></span>
                            </div>
                            
                             <div class="input-field col s12 otp_none">
                              <button class="btn" id="thiswithdrawsubmit" type="submit">Verify</button>
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
                        <button class="btn" id="this_otp_sub" type="submit">Check OTP</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
      </div>
       </div>
        <script type="text/javascript">
     
           $('#widthmoney').submit(function(e){
               e.preventDefault();
               $('#thiswithdrawsubmit').attr('disabled',true);
               $('#this_otp_sub').attr('disabled',true);
               var total = $('#finalamount').val();
               
               if(total == '' || isNaN(total))
               {
                   $('#thiserrors').html('<span style="color:red;font-weight:800">Select Amount First</span>');
                   return false;
               }
               
               checkmybalance(total,'#thiserrors','#thiswithdrawsubmit',0,1);
               send_otp(total);
            
           });
           function send_otp(total){
               $.ajax({
                   url:"{{route('send_otp')}}",
                   method:'POST',
                   data:{
                        '_token':"{{csrf_token()}}",
                        'type':2,
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
               var finalamount = $('#finalamount').val();
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
                              url:"{{route('withdrawsucced')}}",
                              method:"POST",
                              data:{
                                  '_token':"{{csrf_token()}}",
                                  'oldamount':finalamount,
                                    'otp':otp
                                  
                              },success:function(susc){
                                    if(susc.error){
                                      $('#thiserrors').html('<span style="color:red;font-weight:800">'+susc.error+'</span>');
                                      $('#thiswithdrawsubmit').attr('disabled',true);
                                      return false;
                                  }else if(susc.success){
                                        $('#thiswithdrawsubmit').attr('disabled',true);
                                        
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
                           if(chargeacc==1){
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
           $('#finalamount').change(function(e){
               e.preventDefault();
               if($(this).val() == '' || isNaN($(this).val()))
               {
                   $('#thiserrors').html('<span style="color:red;font-weight:800">Select Amount First</span>');
                   return false;
               }
               checkmybalance($(this).val(),'#thiserrors','#thiswithdrawsubmit',0,1);
           });
           
          

          </script>
  @endsection