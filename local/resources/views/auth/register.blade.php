@extends('layouts.web')

@section('content')
<style>
.select2 
    {
        width: 100% !important;
      
    }
</style>
      <link href="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.12/dist/js/select2.min.js"></script>
         <div class="container ">
           <br>
           <br>
          <div class="card" style="    box-shadow: 0px 0px 26px #dcdcdc;
          border: 1px solid #dee6ad;">
            <div class="card-body p-50">
               <form class="registerme" method="POST" action="{{ route('register') }}">
                    @csrf
                  <h3 class="text-center">
                  Registration
                  </h3>
                <br>
                <br>
                  <div class="row" >
                <div class="col-md-6">        
                  <div class="form-group">
                    <label for="">Sponsor ID</label>
                    <?php $spid = ""; $mem=[]; $spname = ""; ?>
                    @if(isset($_GET['memberid'])) <?php $mem = member_using_member_id($_GET['memberid']);  $spid = $_GET['memberid'];  ?>  @endif
            <input id="sponid" type="text" value="{{ $spid }}" class="form-control" name="sponid"  autofocus>

                <?php if(count($mem)==0 && isset($_GET['memberid'])) { ?>
                  <span class="invalid-feedback" style="display:block" role="alert">
                       <strong>Invalid Memberid</strong>
                   </span>
                 <?php } else { ?>
                   <span class="invalid-feedback" role="alert">
                     <strong></strong>
                 </span>
               <?php } ?>
                    
                  </div>
                   
                </div>
                <div class="col-md-6">    
                  <div class="form-group ">
                    <label for="">Sponsor Name</label>
                    <input id="sponname" type="text"  <?php if(count($mem)>0) { ?> value="{{$mem[0]->name}}" <?php } ?> class="form-control" name="sponname"  readonly>
                   
                    <span class="invalid-feedback" role="alert">
                           <strong></strong>
                       </span>
                  </div>    
                 
                </div>
                {{--
                <div class="col-md-6">     
                  <div class="form-group ">
                    <label for="user_name_id">User ID</label>
                    <input id="user_name_id" type="text"  class="form-control" name="user_name_id"    autofocus>
                    <span class="invalid-feedback" role="alert">
                        <strong></strong>
                    </span>
                  </div>   
                      
                </div>
                --}}
                <div class="col-md-6">     
                  <div class="form-group ">
                    <label for="">Enter Name</label>
                    <input id="name" type="text"  class="form-control" name="name"    autofocus>
                    <span class="invalid-feedback" role="alert">
                        <strong></strong>
                    </span>
                  </div>   
                      
                </div>

                <div class="col-md-6">   
                    <div class="form-group ">
                        <label for="">Enter Email</label>
                        <input id="email" type="text" class="form-control" name="email"  >
                        <span class="invalid-feedback" role="alert">
                            <strong></strong>
                        </span>
                      </div>   
               
                </div>

                <div class="col-md-6">  
                    <div class="form-group ">
                        <label for="">Enter Mobile</label>
                        <input id="ph_mobile" type="text" class="form-control " name="ph_mobile"  maxlength="10">
                        <span class="invalid-feedback" role="alert">
                            <strong></strong>
                        </span>
                      </div>   
                
                </div>
                <div class="col-md-6">   
                  <div class="form-group ">
                      <label for="">Country</label>
                      <select id="country" type="text" class="form-control " name="country"  ><select>
                      <span class="invalid-feedback" role="alert">
                          <strong></strong>
                      </span>
                    </div>   
              
                    
              </div>
                <div class="col-md-6">   
                        <div class="  validate-input" data-validate="Select City">
                                <label for="sel1">Select State</label>
                                <select id="state" class="form-control input-sm" name="state"></select>
                                       
                           <span class="invalid-feedback" role="alert">
                                <strong></strong>
                            </span>
                        </div>
                </div>


               
                <div class="col-md-6">   
                    <div class="form-group ">
                        <label for="">Enter Password</label>
                        <input id="new_passw" type="password" class="form-control " name="new_passw"  >
                        <span class="invalid-feedback" role="alert">
                            <strong></strong>
                        </span>
                      </div>   
                       
                </div>
                <div class="col-md-6">  
                    <div class="form-group ">
                        <label for="">Confirm Password</label>
                        <input id="con_passw" type="password" class="form-control " name="con_passw"  >
                        <span class="invalid-feedback" role="alert">
                            <strong></strong>
                        </span>
                      </div>    
                       
                </div>
                <div class="col-md-12" style="display:none;">   
                        <div class="checkbox">
                          <label><input type="checkbox" id="trcon" checked > I agreed all Terms & Conditions 
                          <a href="#"  class="trbtn">Read</a>
                          </label>
                        </div>
                        <p id="termcon" class="text-justify" style="display:none;">
                            </p>
                </div>
              
                </div>
                <div class="container-login100-form-btn">
                    <div class="wrap-login100-form-btn" style="    text-align: center;">
                       <div class="login100-form-bgbtn"></div>
                       <br>
                       <button class="btn btn-primary blocksub" id="submitthisform" type="submit">
                       Submit
                       </button>
                       <!--<a class="btn btn-danger" href="{{ route('login') }}">-->
                       <!--    Login-->
                       <!--</a>-->
                    </div>
                 </div>
               </form>
              </div>
            </div>
            </div>
            <br>
            <br>
         </div>

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        
        <h4 class="modal-title">Confirm Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
        <table class="table table-bordered">
            <tr>
                <th>Sponsor ID</th>
                <td id="sp_id"></td>
            </tr>
            <tr>
                <th>Sponsor Name</th>
                <td id="sp_name"></td>
            </tr>
            <tr>
                <th>Name</th>
                <td id="you_name"></td>
            </tr>
            <tr>
                <th>Mobile</th>
                <td id="you_mobl"></td>
            </tr>
            <tr>
                <th>Email</th>
                <td id="you_em"></td>
            </tr>
            <tr>
                <th>Password</th>
                <td id="you_pass"></td>
            </tr>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Back</button>
        <button type="button" class="btn btn-primary" id="save_regist">Confirm</button>
      </div>
    </div>

  </div>
</div>
              
         <div id="modal-container" class="">
          <div class="modal-background">
         <div class="modal" id="detailmodel" style="min-width:350px;max-width:600px">
     
                    <p id="modeldata" style="font-weight: 600;">
                      <img src="https://wpamelia.com/wp-content/uploads/2018/11/ezgif-2-6d0b072c3d3f.gif" style="width:100%">
                    </p>
                    <center><button type="button" class="btn closeme btn-primary">Back</button> <a href="{{route('login')}}"  class="btn btn-primary">Login</a></center>
            </div>
            </div>
        </div>
            


     
     
      <script> 
 var filter = /^((\+[1-9]{1,4}[ \-]*)|(\([0-9]{2,3}\)[ \-]*)|([0-9]{2,4})[ \-]*)*?[0-9]{3,4}?[ \-]*[0-9]{3,4}?$/;
var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
jQuery('#submitthisform').click(function(e){
    e.preventDefault();
    var token = '{{csrf_token()}}';
var sponserid = jQuery("#sponid").val();
var name=  jQuery("#name").val();
// var username = jQuery("#user_name_id").val().replace(/ /g,'');
var email=  jQuery("#email").val();
var ph_mobile=  jQuery("#ph_mobile").val();
var state=  jQuery("#state").val();
var country=  jQuery("#country").val();
var new_passw=  jQuery("#new_passw").val();
var con_passw=  jQuery("#con_passw").val();
if(sponserid == '')
{
    jQuery('#sponid').parent('div').find('.invalid-feedback').css('display','block').find('strong').html('Sponser ID is Required');
    return false;
}else
{
    jQuery('#sponid').parent('div').find('.invalid-feedback').css('display','none').find('strong').html('');
}
if(name == '')
{
    jQuery('#name').parent('div').find('.invalid-feedback').css('display','block').find('strong').html('Name is Required');
    return false;
}else
{
    jQuery('#name').parent('div').find('.invalid-feedback').css('display','none').find('strong').html('');
}
if(email == '' )
{
    jQuery('#email').parent('div').find('.invalid-feedback').css('display','block').find('strong').html('Email is Required');
    return false;
}
else
{
    jQuery('#email').parent('div').find('.invalid-feedback').css('display','none').find('strong').html('');
}
// if(username == '' || username.length < 8)
// {
//     jQuery('#user_name_id').parent('div').find('.invalid-feedback').css('display','block').find('strong').html('Username is Required');
//     return false;
// }
if(!regex.test(email)){
    jQuery('#email').parent('div').find('.invalid-feedback').css('display','block').find('strong').html('Email is not Valid');
    return false;
}
else
{
    jQuery('#email').parent('div').find('.invalid-feedback').css('display','none').find('strong').html('');
}
if (!filter.test(ph_mobile)) {
    jQuery('#ph_mobile').parent('div').find('.invalid-feedback').css('display','block').find('strong').html('Mobile Number Not Valid');
        return false;
    }
    else
{
    jQuery('#ph_mobile').parent('div').find('.invalid-feedback').css('display','none').find('strong').html('');
}
if(ph_mobile == '')
{
    jQuery('#ph_mobile').parent('div').find('.invalid-feedback').css('display','block').find('strong').html('Phone No is Required');
    return false;
}else
{
    jQuery('#ph_mobile').parent('div').find('.invalid-feedback').css('display','none').find('strong').html('');
}
if(new_passw != con_passw){
jQuery('#con_passw').parent('div').find('.invalid-feedback').css('display','block').find('strong').html('Password Not Matched');
return false;
}else
{
    {
    jQuery('#con_passw').parent('div').find('.invalid-feedback').css('display','none').find('strong').html('');
}
}


if (!jQuery('#trcon').is(':checked')) {
    jQuery('.trerror').remove();
    jQuery('<p style="color:red" class="trerror">Please Read Terms & Condition First</p>').insertAfter('#trcon');
    return false
}else
{
    jQuery('.trerror').remove();
}
    jQuery('#sp_id').html(jQuery("#sponid").val());
    jQuery('#sp_name').html(jQuery("#sponname").val());
    jQuery('#you_name').html(jQuery("#name").val());
    jQuery('#you_mobl').html(jQuery("#ph_mobile").val());
    jQuery('#you_em').html(jQuery("#email").val());
    jQuery('#you_pass').html(jQuery("#new_passw").val());
    jQuery('#myModal').modal('show');
});

jQuery('#save_regist').click(function(e){
    e.preventDefault();
    jQuery('#myModal').modal('hide');
    jQuery('.registerme').submit();
});
      jQuery(document).ready(function(){
          jQuery('#country').change(function(){
              var countryid = jQuery(this).val();
              jQuery.ajax({
                  url:'{{route("states")}}',
                  method:'GET',
                  data:{
                      'countryid':countryid,
                      '_token':'{{csrf_token()}}',
                  },
                  success:function(src){
                      jQuery('#state').html('');
                      var dat = '';
                      jQuery(src).each(function(key,val){
                          dat += '<option value="'+val.id+'">'+val.name+'</option>';
                      });
                      jQuery('#state').html(dat);
                      jQuery('#state').select2();
                    //   console.log(src);
                  },
              });
          });
          
             jQuery('#country').select2({
                placeholder: ' Choose Country ',
                ajax: {
                url: '{{route("countries")}}',
                dataType: 'json',
                delay: 250,
                processResults: function (data) {
                return {
                results: data
                };
                },
                cache: true
                }
            });
          jQuery('.trbtn').on('click',function(e){
              e.preventDefault();
              jQuery('#termcon').toggle();
          })
        jQuery('#modal-container center').css('display','none');
       

jQuery("#sponid").change(function () {
  var spad= jQuery("#sponid").val();
var token = '{{csrf_token()}}';
jQuery('#sponname').val('');
jQuery.ajax({
    url: "<?php echo url('/');?>/getSpon",
    type: 'POST',
    dataType: "JSON",


data: {'spad' : spad ,
'_token':token
},

success: function (html)
{  if(html.length > 0){
    jQuery('#sponid').parent().find('.invalid-feedback').css('display','none').find('strong').html('');
    jQuery('#sponname').val(html[0].name);
}else
{
    
    jQuery('#sponid').parent().find('.invalid-feedback').css('display','block').find('strong').html('Not a valid Id');
}
    
},
});
});
//Js Validation
jQuery('.registerme').submit(function(e){
        e.preventDefault();
// alert(mem_pos);
// return false;
var token = '{{csrf_token()}}';
var sponserid = jQuery("#sponid").val();
var name=  jQuery("#name").val();
// var username = jQuery("#user_name_id").val().replace(/ /g,'');
var email=  jQuery("#email").val();
var ph_mobile=  jQuery("#ph_mobile").val();
var state=  jQuery("#state").val();
var country=  jQuery("#country").val();
var new_passw=  jQuery("#new_passw").val();
var con_passw=  jQuery("#con_passw").val();
if (!filter.test(ph_mobile)) {
    jQuery('#ph_mobile').parent('div').find('.invalid-feedback').css('display','block').find('strong').html('Mobile Number Not Valid');
        return false;
    }
if (!jQuery('#trcon').is(':checked')) {
    jQuery('.trerror').remove();
    jQuery('<p style="color:red" class="trerror">Please Read Terms & Condition First</p>').insertAfter('#trcon');
    return false
}else
{
    jQuery('.trerror').remove();
}
if(new_passw != con_passw){
jQuery('#con_passw').parent('div').find('.invalid-feedback').css('display','block').find('strong').html('Password Not Matched');
return false;
}
if(ph_mobile == '')
{
    jQuery('#ph_mobile').parent('div').find('.invalid-feedback').css('display','block').find('strong').html('Phone No is Required');
    return false;
}
if(sponserid == '')
{
    jQuery('#sponid').parent('div').find('.invalid-feedback').css('display','block').find('strong').html('Sponser ID is Required');
    return false;
}
if(email == '' )
{
    jQuery('#email').parent('div').find('.invalid-feedback').css('display','block').find('strong').html('Email is Required');
    return false;
}
if(name == '')
{
    jQuery('#name').parent('div').find('.invalid-feedback').css('display','block').find('strong').html('Name is Required');
    return false;
}
// if(username == '' || username.length < 8)
// {
//     jQuery('#user_name_id').parent('div').find('.invalid-feedback').css('display','block').find('strong').html('Username is Required');
//     return false;
// }
if(!regex.test(email)){
    jQuery('#email').parent('div').find('.invalid-feedback').css('display','block').find('strong').html('Email is not Valid');
    return false;
}

jQuery.ajax({
    url: "<?php echo url('/');?>/register",
    type: 'POST',
    dataType: "JSON",


data: {'sponserid' : sponserid ,
'name' : name ,
'email' : email ,
'ph_mobile' : ph_mobile ,
'state' : state ,
'country' : country ,
'new_passw' : new_passw ,
'_token':token,
// 'username':username
},
beforeSend: function(){
    jQuery('#modal-container').removeAttr('class').addClass('one');
  jQuery('body').addClass('modal-active');
},
success: function (html)
{  


    setTimeout(function() {
         jQuery('#modal-container center').css('display','block');
         jQuery('#modal-container #modeldata').html('<h4 style="text-align:center">Congratulations!</h4> <h4 style="text-align:center">You Have Successfully Registered with Hexa Hope.</h4><br><table class="table table-hover table-bordered">'
         +'<tr><th>Member ID</th><td>'+html.memberid+'</td></tr>'
         +'<tr><th colspan="2">Check Your Mail</th></tr>'
         +'</table>');
        }, 2000);

    
},
error : function(net){
    // console.log(net.responseJSON.errors);
    var a = net.responseJSON.errors;
  setTimeout(function() {
    
    
    jQuery('#modal-container center').css('display','block');
         var ab = '<ul><li>Re-check your Information</li>';
        jQuery.each(a, function(key, val){
            ab += '<li style="color:red">'+val[0]+'</li>';
        });
        ab += '</ul>';
        jQuery('#modal-container #modeldata').html(ab);
        }, 3000);
}
});


});

   

 

  jQuery('#modal-container .closeme').click(function(){
    jQuery('#modal-container center').css('display','none');
    jQuery('#modal-container #modeldata').html('<img src="https://wpamelia.com/wp-content/uploads/2018/11/ezgif-2-6d0b072c3d3f.gif">');
  jQuery('#modal-container').addClass('out').removeClass('one');;
  jQuery('body').removeClass('modal-active');
});   

});
</script>

@endsection