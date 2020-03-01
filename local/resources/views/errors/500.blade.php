@extends('errors::minimal')

@section('title', __('Server Error'))

@section('message')
<div class="image"></div>

<div class="content">
   <div class="content-box">
      <div class="big-content">
         <div class="list-square">
            <span class="square"></span>
            <span class="square"></span>
            <span class="square"></span>
         </div>
         <div class="list-line">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
         </div>
         <i class="fa fa-search" aria-hidden="true"></i>
         <div class="clear"></div>
      </div>
      <h1>Oops! Error 500 </h1>
      <p>Server Error<br>
         
      </p>
      <h1><center><a class="btn btn-danger" href="{{url('/')}}"> Go To Home</a></center></h1>
   </div>
</div>

@endsection


