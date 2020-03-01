@extends('layouts.app')
@section('content')
<style>
table.striped>tbody>tr>td {
    border-radius: 0;
    color: #000;
}
</style>
<div class="users-view">
    <!-- users view media object start -->
    <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
          <div class="row">
            <div class="col s10 m6 l6">
              <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{$title}}</span></h5>
              <!--<ol class="breadcrumbs mb-0">-->
              <!--<li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a>-->
              <!--  </li>-->
              
              <!--  <li class="breadcrumb-item active">{{$title}}-->
              <!--  </li>-->
              <!--</ol>-->
            </div>
           
          </div>
        </div>
      </div>
    <div class="card-panel">
      <div class="row">
        <div class="col s12 m7">
          <div class="display-flex media">
            <a href="#uploadimage" class="avatar modal-trigger">
                @if(Auth::User()->profile_image != '')
                    <img src="{{url('/images')}}/{{Auth::User()->profile_image}}" style="width:100px;margin:0 auto;display:block; padding: 0 15px;" class="circle">
                    @else
                    <img src="{{asset('dashboard-assets/NEWIM.png')}}" style="width:100px;margin:0 auto;display:block; padding: 0 15px;" class="circle">
                @endif
              </a>
            <div class="media-body">
              <h6 class="media-heading">
                {{Auth::User()->name}} 
              </h6>
              <h6 class="media-heading">
                 {{Auth::User()->memberid}}
               
              </h6>
              <h6 class="media-heading">
                
                Package: <?php if(Auth::User()->plan_id==1){ echo 'Hexa Master';}
              elseif(Auth::User()->plan_id==2){echo 'Hexa Royal';}
              elseif(Auth::User()->plan_id==3){echo 'Hexa Diamond';}
              elseif(Auth::User()->plan_id==4){echo 'Hexa Crown';}
              ?>
              </h6>
              <!--<span>Plan:</span>-->
              <!--<span class="users-view-id"></span>-->
            </div>
          </div>
        </div>
        <div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center">
            <!--<a class="waves-effect waves-light btn-small indigo modal-trigger" href="#uploadimage" >Upload Photo</a>-->
            <div id="uploadimage" class="modal">
            <div class="modal-content">
              <h4>Upload Your Image</h4>
                <form action="{{route('upload_profile')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    {{method_field('PUT')}}
                    <div class="row">
                        <div class="input-field col s12">
                            <input type="file" name="profile_file" required >
                            <label>Upload Image</label>
                        </div>
                        <div class="input-field col s12">
                            <button type="submit" class="btn">Update</button>
                        </div>
                    </div>
                
                </form>
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
          <div class="col s12 m4">
            <table class="striped">
              <tbody>
                <tr>
                  <td>Registration Date:</td>
                  <td>{{Auth::User()->created_at}}</td>
                </tr>
                <tr>
                  <td>Activation Date:</td>
                  <td class="users-view-latest-activity">{{Auth::User()->activation_date}}</td>
                </tr>
               
              
              </tbody>
            </table>
          </div>
          @if(count(Auth::User()->wallets)>0)
          <!--<div class="col s12 m8">-->
          <!--  <h6 class="mb-2 mt-2"><i class="material-icons">account_balance_wallet</i> Wallet Info</h6>-->
          <!--  <table class="responsive-table">-->
          <!--    <thead>-->
          <!--      <tr>-->
          <!--        <th>Wallet Type</th>-->
          <!--        <th>Balance</th>-->
          <!--      </tr>-->
          <!--    </thead>-->
          <!--    <tbody>-->
          <!--      <tr>-->
          <!--        <td>Income</td>-->
          <!--          <td>{{Auth::User()->wallets[0]->amount}}</td>-->
          <!--      </tr>-->
          <!--      <tr>-->
          <!--        <td>Top-up</td>-->
          <!--        <td>{{Auth::User()->wallets[1]->amount}}</td>-->
          <!--      </tr>-->
               
          <!--    </tbody>-->
          <!--  </table>-->
          <!--</div>-->
          @endif
        </div>
      </div>
    </div>
    <!-- users view card data ends -->
  
    <!-- users view card details start -->
    <div class="card">
      <div class="card-content">
        
        <div class="row">
          <div class="col s12">
            <h6 class="mb-2 mt-2"><i class="material-icons">account_balance</i>  My BTC Address</h6>

            <table class="striped">
              <tbody>
               {{--
                <tr>
                  <td>Account Type:</td>
                    <td class="users-view-username">{{Auth::User()->account_type}}</td>
                </tr>
                <tr>
                  <td>Bank Name:</td>
                  <td class="users-view-name">{{Auth::User()->bname}}</td>
                </tr>
                <tr>
                  <td>Bank IFSC:</td>
                  <td class="users-view-email">{{Auth::User()->bifsc}}</td>
                </tr>
                <tr>
                  <td>Account No:</td>
                  <td>{{Auth::User()->baccno}}</td>
                </tr>
                --}}
                <tr>
                  <td>{{Auth::User()->btc_add}}</td>
                </tr>
                <tr>
                  <td>
                  <a href="https://hexahope.com/edit_profile?action=accountinfo" class="btn btn-primary">Update BTC Address</a>
                  </td>
                </tr>
              </tbody>
            </table>
            
            <h6 class="mb-2 mt-2"><i class="material-icons">error_outline</i> My Personal Details</h6>
            <table class="striped">
              <tbody>
               
                <tr>
                  <td>Country:</td>
                  <?php $getcountry = DB::table('countries')->where('id',Auth::User()->country)->first();?>
                  <td>@if(!empty($getcountry)) {{$getcountry->name}} @else {{Auth::User()->country}} @endif</td>
                </tr>
                <tr>
                  <td>State:</td>
                  <?php $states = DB::table('states')->where('id',Auth::User()->state)->first();?>
                  <td>@if(!empty($states)) {{$getcountry->name}} @else {{Auth::User()->state}} @endif</td>
                </tr>
                <tr>
                  <td>Mobile:</td>
                  <td>{{Auth::User()->mobile}}</td>
                </tr>
                <tr>
                    <td>Email:</td>
                    <td>{{Auth::User()->email}}</td>
                </tr>
              </tbody>
            </table>
          </div>
        </div>
        <!-- </div> -->
      </div>
    </div>
    <!-- users view card details ends -->
  
  </div>
@endsection