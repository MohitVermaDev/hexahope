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
      
      <div class="row">
                <div class="col s12">
        <div class="container">
            <div class="section">
                <div class="card">
                    <div class="card-content">
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
        <div class="col s8">
            <div class="card">
                <div class="card-content">
                    <?php
                    $getsitename = DB::table('admin_settings')->where('setting_name','web_title')->first();
                    $getsiteperce = DB::table('admin_settings')->where('setting_name','charges_percentage')->first();
                    $getsitewithperce = DB::table('admin_settings')->where('setting_name','withdraw_charges')->first();
                    $getqr = DB::table('admin_settings')->where('setting_name','btc_qr')->first();
                    $getbtc = DB::table('admin_settings')->where('setting_name','btc_address')->first();
                    ?>
                    <form action="{{route('savesettings')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="row">
                        <div class="input-field col s3" style="">
                            <span style="font-weight:700;text-align:right">Site Name</span>
                        </div>
                        <div class="input-field col s9">
                            <input type="text" required name="web_title" value="{{$getsitename->setting_value}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <span style="font-weight:700;text-align:right">Transfer Charges %</span>
                        </div>
                        <div class="input-field col s9">
                            <input type="text" required name="charges_percentage" value="{{$getsiteperce->setting_value}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <span style="font-weight:700;text-align:right">Withdraw Charges %</span>
                        </div>
                        <div class="input-field col s9">
                            <input type="text" required name="withdraw_charges" value="{{$getsitewithperce->setting_value}}">
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            
                            <span style="font-weight:700;text-align:right">QR CODE</span>
                            <img src="{{asset('images/'.$getqr->setting_value)}}" style="width:100%">
                        </div>
                        <div class="input-field col s9">
                            <input type="file" name="btc_qr" >
                        </div>
                    </div>
                    <div class="row">
                        <div class="input-field col s3">
                            <span style="font-weight:700;text-align:right">BTC ADDRESS</span>
                        </div>
                        <div class="input-field col s9">
                            <input type="text" required name="btc_address" value="{{$getbtc->setting_value}}">
                        </div>
                    </div>
                   <div class="row">
                        <div class="input-field col s3">
                         
                        </div>
                        <div class="input-field col s9">
                            <button type="submit" class="btn">Save</button>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
      </div>

@endsection
