
@extends('layouts.web')

@section('content')
<br>
<br>
         <div class="container" >
            <div class="card" style="    box-shadow: 0px 0px 26px #dcdcdc;
            border: 1px solid #dee6ad;">
               <div class="card-body">
            <div class="row">
               <div class="col-md-6 test-login">
                 
               <img src="{{asset('web-assets/images/12.jpg')}}" style="width:100%">
            
               </div>
               <div class="col-md-6">
                  <div id='allerrors' >

                  </div>
               <div>
               <form  method="POST" id="sendlogin">
                    @csrf
               <img src="{{asset('web-assets/logo.png')}}" style="width:200px;margin:0 auto;display:block">
                 <br>
                
                 <div class="row" >
                     <div class="col-md-12">
                           <div class="form-group ">
                                 <label for="memberid">Member ID</label>
                                 <input id="memberid" type="text" class="form-control  @error('memberid') is-invalid @enderror" name="memberid" value="{{ old('memberid') }}" required >
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
                                 <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">
            
                                 @error('password')
                                     <span class="invalid-feedback" style="display:block" role="alert">
                                         <strong>{{ $message }}</strong>
                                     </span>
                                 @enderror
                               </div>
                     </div>
                 </div>
                
               
                
                  <div class="text-center">
                     
                        <button class="btn btn-success" type="submit">
                        Login
                        </button>
                    
                  </div>
                  <div class="text-center">
                     <span class="txt1">
                     Don’t have an account?
                     </span>
                     <a class="txt2" href="{{ route('register') }}">
                     Sign Up
                     </a>
                  </div>
               </form>
               
            
         </div>
            </div>
            </div>
         </div>
      </div>
   </div>
   <br>
   <br>
<script>
   jQuery('#sendlogin').submit(function(e){
      e.preventDefault();
      var memberid = jQuery('#memberid').val();
      var password = jQuery('#password').val();
      
      jQuery('#allerrors').html('<p style="color:green;text-align:center;font-weight:600">Authenticating.....</p>');  
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
            jQuery('#allerrors').html('<div class="alert alert-success" role="alert">Successfully Authenticated! Redirecting you to your dashboard</div>');  
             
              window.location.reload();
            }else if(suc.error)
            {
                var errr = suc.error;
                        jQuery('#allerrors').html('');
                        jQuery(errr).each(function(key,val){
                           jQuery('#allerrors').append('<div class="alert alert-danger" role="alert">'+val+'</div>');
                        });
            }
         
         },
         error:function(err){
            var errr = err.responseJSON;
            jQuery('#allerrors').html('');
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
@endsection

