@extends('layouts.app')
@section('content')

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
  <div class="col s12">
    <div class="container">
        <div class="section">
            <div class="card">
                <div class="card-content">
                    Choose a Plan to Upgrade
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
                </div>
            </div>
        </div><!-- START RIGHT SIDEBAR NAV -->

    </div>
</div>
    <div class="col s12">
        <div class="container">
            <div class="section">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <h5 class="col s6">Pay To Start Your Account</h5>
                            <h6 class="col s6 right-align green-text">Wallet Balance: $ {{ Auth::User()->wallets[1]->amount}}</h6>
                            
                          </div>
                          <div id="success-errors">
                          </div>
                        <form action="{{route('activation')}}" id="last_submit" method="POST">
                            @csrf
                            @if(Auth::User()->plan_id < 1 && Auth::User()->wallets[1]->amount >= 10)
                            <div class="input-field col s3 ">
                              <p>
                                <label>
                                  <input type="checkbox" name="value" class="val val1" value="1" />
                                  <span>10$ </span>
                                </label>
                              </p>
                            </div>
                            @endif
                            @if(Auth::User()->plan_id < 2 && Auth::User()->wallets[1]->amount >= 15)
                            <div class="input-field col s3 ">
                              <p>
                                <label>
                                  <input type="checkbox" name="value" class="val val2" value="2" />
                                  <span>15$ </span>
                                </label>
                              </p>
                            </div>
                            @endif
                            @if(Auth::User()->plan_id < 3 && Auth::User()->wallets[1]->amount >= 50)
                            <div class="input-field col s3 ">
                              <p>
                                <label>
                                  <input type="checkbox" name="value" class="val val3" value="3" />
                                  <span>50$ </span>
                                </label>
                              </p>
                            </div>
                            @endif
                            @if(Auth::User()->plan_id < 4 && Auth::User()->wallets[1]->amount >= 75)
                            <div class="input-field col s3 ">
                              <p>
                                <label>
                                  <input type="checkbox" value="4" name="value" class="val val4" id="checkall"/>
                                  <span>75$ </span>
                                </label>
                              </p>
                            </div>
                            @endif
                            <button class="btn waves-effect waves-light" type="submit" id="submitfomr" name="action">Submit
                                <i class="material-icons right">send</i>
                            </button>
                          </form>
                    </div>
                </div>
            </div><!-- START RIGHT SIDEBAR NAV -->

        </div>
    </div>
  
    <div class="content-overlay"></div>
</div>
<script>
 

    $('#submitfomr').click(function(e){
        e.preventDefault();
        var value = $('.val:selected').val();
        var newval = [];
        $('.val:checked').each(function(){
          console.log($(this).val());
          if(isNaN($(this).val())){
            $('#success-errors').html('Something Went Wrong');
            return false;
          }
          newval.push($(this).val());
        });
        console.log(newval);
       if(newval.length == 0)
       {
        $('#success-errors').append('<br>Select Amount to Procced');

         return false;
       }
        $.ajax({
            url:'{{route("check_first_balance")}}',
            method:'POST',
            data:{
                '_token':'{{csrf_token()}}',
                'value':newval,
            },
            success:function(sc)
            {
                if(sc.success){
                    $('#success-errors').html('<div class="card-alert card gradient-45deg-green-teal">'+
                '<div class="card-content white-text"><p><i class="material-icons">check</i>'+sc.success+'</p></div>'+
                '<button type="button" class="close white-text" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
                $('#last_submit').submit();
                return true;

                }
               else
               {
                $('#success-errors').html('<div class="card-alert card gradient-45deg-red-pink">'+
                '<div class="card-content white-text"><p><i class="material-icons">error</i>'+sc.error+'</p></div>'+
                '<button type="button" class="close white-text" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button></div>');
                return false;
               }
            },
            error:function(err)
            {
              $('#success-errors').html('Something Went Wrong');
              console.log(err);
              return false;
            }
        });
        
    });
</script>
@endsection