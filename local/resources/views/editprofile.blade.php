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
                <img src="{{asset('web-assets/logo.png')}}" alt="users view avatar" style="    width: 100px;
                margin-right: 10px;">
              </a>
            <div class="media-body">
              <h6 class="media-heading">
                <span class="users-view-name">{{Auth::User()->name}} </span>
                <span class="grey-text">@</span>
                <span class="users-view-username grey-text">{{Auth::User()->memberid}}</span>
              </h6>
              <span>Plan ID:</span>
              <span class="users-view-id">{{Auth::User()->plan_id}}</span>
            </div>
          </div>
        </div>
        <div class="col s12 m5 quick-action-btns display-flex justify-content-end align-items-center pt-2">
            <a href="#" class="btn-small indigo">Edit</a>
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
                  <td>Registered On:</td>
                  <td>{{Auth::User()->created_at}}</td>
                </tr>
                <tr>
                  <td>Activated On:</td>
                  <td class="users-view-latest-activity">{{Auth::User()->activation_date}}</td>
                </tr>
                <tr>
                  <td>Upline ID:</td>
                  <td class="users-view-verified">{{Auth::User()->u_parent}}</td>
                </tr>
                <tr>
                  <td>Sponser:</td>
                  <td class="users-view-role">{{Auth::User()->sponserid}}</td>
                </tr>
                <tr>
                  <td>Status:</td>
                  <td><span class=" users-view-status chip @if(Auth::User()->id_active == 1) green lighten-5 green-text @else red lighten-5 red-text @endif">@if(Auth::User()->id_active == 1) Active  @else Not Active @endif</span></td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="col s12 m8">
            <h6 class="mb-2 mt-2"><i class="material-icons">account_balance_wallet</i> Wallet Info</h6>
            <table class="responsive-table">
              <thead>
                <tr>
                  <th>Wallet Type</th>
                  <th>Balance</th>
                  
                </tr>
              </thead>
              <tbody>
                <tr>
                  <td>Simple Wallet</td>
                    <td>{{Auth::User()->wallets[0]->amount}}</td>
                </tr>
                <tr>
                  <td>Joining Wallet</td>
                  <td>{{Auth::User()->wallets[1]->amount}}</td>
                </tr>
               
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <!-- users view card data ends -->
  
    <!-- users view card details start -->
    <div class="card">
      <div class="card-content">
        
        <div class="row">
          <div class="col s12">
            <h6 class="mb-2 mt-2"><i class="material-icons">account_balance</i> Account Info</h6>

            <table class="striped">
              <tbody>
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
  
              </tbody>
            </table>
            
            <h6 class="mb-2 mt-2"><i class="material-icons">error_outline</i> Personal Info</h6>
            <table class="striped">
              <tbody>
               
                <tr>
                  <td>Country:</td>
                    <td>{{Auth::User()->country}}</td>
                </tr>
                <tr>
                  <td>State:</td>
                  <td>{{Auth::User()->state}}</td>
                </tr>
                <tr>
                  <td>Contact:</td>
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