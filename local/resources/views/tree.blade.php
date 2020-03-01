@extends('layouts.app')
@section('content')
<style>
    .root {
  position: relative;
}

.level {
  margin-left: 240px;
  position: relative;
}
.level:before {
  content: "";
  width: 50px;
  border-top: 2px solid #7820a2;
  position: absolute;
  left: -98px;
  top: 50%;
  margin-top: 1px;
}

.item {
  min-height: 50px;
  position: relative;
}
.item:before {
  content: "";
  height: 100%;
  border-left: 2px solid #7820a2;
  position: absolute;
  left: -48px;
}
.item:after {
  content: "";
  width: 46px;
  border-top: 2px solid #7820a2;
  position: absolute;
  left: -46px;
  top: 50%;
  margin-top: 1px;
}

.item:first-child:before {
  width: 10px;
  height: 50%;
  top: 50%;
  margin-top: 2px;
  border-top-left-radius: 10px;
}
.item:first-child:after {
  height: 10px;
  border-top-left-radius: 10px;
}

.item:last-child:before {
  width: 10px;
  height: 50%;
  border-bottom-left-radius: 10px;
}
.item:last-child:after {
  height: 10px;
  border-top: none;
  border-bottom: 2px solid #7820a2;
  border-bottom-left-radius: 10px;
  margin-top: -11px;
}

.title {
  width: 144px;
  padding: 5px 10px;
  line-height: 20px;
  text-align: center;
  border: 2px solid #7820a2;
  border-radius: 5px;
  display: block;
  position: absolute;
  left: 0;
  top: 50%;
      color: #7820a2 !important;
    font-weight: 900 !important;
  margin-top: -15px;cursor: grab;
}
.firstplan
{
    background-image: linear-gradient(to right top, #6decb8, #6dedba, #6eefbb, #6ef0bd, #6ff1bf, #6ff1bf, #6ff1bf, #6ff1bf, #6ef0bd, #6eefbb, #6dedba, #6decb8);

}
.secondplan
{
    background-image: radial-gradient(circle, #ffa259, #ffa259, #ffa259, #ffa259, #ffa259, #ffa259, #ffa259, #ffa259, #ffa259, #ffa259, #ffa259, #ffa259);
    
}
.thridplan
{
    background-image: radial-gradient(circle, #69d1e8, #6ed3e7, #73d5e7, #78d7e6, #7dd9e6, #7dd9e4, #7ed8e3, #7ed8e1, #7ad5de, #75d2db, #71cfd8, #6cccd5);
   
}
.lastplan
{
    background-image: linear-gradient(to right top, #e9da5f, #e6d25c, #e3cb59, #e0c356, #ddbc53);
   
}
</style>
<div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
<div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
    <!-- Search for small screen-->
    <div class="container">
      <div class="row">
        <div class="col s4 m6 l6">
          <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{$title}}</span></h5>
          <ol class="breadcrumbs mb-0">
          <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a>
            </li>
          
            <li class="breadcrumb-item active">{{$title}}
            </li>
          </ol>
        </div>
        <div class="col s8 m6 l6" style="color:#fff!important">
            <form class="right" id="findusertreeform">
               <div class="row">
                   <div class="input-field col s8">
                       <input id="mmemberid" type="text" class="validate" style="color:#fff;    border-color: #fff;">
                       <label for="name" style="color:#fff">Partner Id</label>
                   </div>
                   <div class="input-field col s4">
                       <button class="btn waves-effect waves-light" type="submit" name="action" style="    padding: 0 7px;">Go!
                       </button>
                   </div>
               </div>
           </form>
        </div>
      </div>
    </div>
  </div>
    <div class="col s12" style="padding: 0;">
        <div class="container">
            <div class="section">
                <div class="card">
                    <div class="card-content" style="overflow: auto;min-height: 250px;">
                        <div class='root'>
                            <?php $top = member_using_member_id($memberid);?>
                            <span class='tooltipped title <?php  echo change_color_of_member_tree($memberid); ?>' data-position="top" data-tooltip="<?php echo $top[0]->name;?>" id="{{$memberid}}" data-id='{{$memberid}}'>{{$memberid}}</span>
                            <div class="level" style="display:block">
                                <div class="item"><span class=" title @if($left) tooltipped clickthis <?php echo change_color_of_member_tree($left); ?>" <?php $top = member_using_member_id($left);?> data-position="top" data-tooltip="<?php echo $top[0]->name;?>" @endif data-id="{{$left}}">@if($left) {{$left}} @else No Member @endif</span></div>
                                <div class="item"> <span class=" title @if($center) tooltipped clickthis <?php echo change_color_of_member_tree($center); ?>" <?php $top = member_using_member_id($center);?> data-position="top" data-tooltip="<?php echo $top[0]->name;?>" @endif data-id="{{$center}}">@if($center) {{$center}} @else No Member @endif</span></div>
                                <div class="item"><span class=" title @if($right) tooltipped clickthis <?php echo change_color_of_member_tree($right); ?>" <?php $top = member_using_member_id($right);?> data-position="top" data-tooltip="<?php echo $top[0]->name;?>" @endif data-id="{{$right}}">@if($right) {{$right}} @else No Member @endif</span> </div>
                              </div>
                          </div>
                          
                    </div>
                </div>
            </div><!-- START RIGHT SIDEBAR NAV -->

        </div>
    </div>
      <div class="col s12"  style="padding: 0;">
        <div class="container">
            <div class="section">
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s12 m3">
                                <div class="firstplan" style="max-width: 150px;
    min-width: 210px;
    margin: 0 auto;
    min-height: 47px;
    display: block;
    padding: 5px;
    text-align: center;"><h5 style="color:#fff">$ 10</h5></div>
                                <h6 style="text-align:center">HEXA MASTER</h6>
                            </div>
                            <div class="col s12 m3">
                                <div class="secondplan" style="max-width: 150px;
    min-width: 210px;
    margin: 0 auto;
    min-height: 47px;
    display: block;
    padding: 5px;
    text-align: center;"><h5 style="color:#fff">$ 15</h5></div>
                                <h6 style="text-align:center">HEXA ROYAL</h6>
                            </div>
                            <div class="col s12 m3">
                                <div class="thridplan" style="max-width: 150px;
    min-width: 210px;
    margin: 0 auto;
    min-height: 47px;
    display: block;
    padding: 5px;
    text-align: center;"><h5 style="color:#fff">$ 50</h5></div>
                                <h6 style="text-align:center">HEXA DIAMOND</h6>
                            </div>
                            <div class="col s12 m3">
                                <div class="lastplan" style="max-width: 150px;
    min-width: 210px;
    margin: 0 auto;
    min-height: 47px;
    display: block;
    padding: 5px;
    text-align: center;"><h5 style="color:#fff">$ 75</h5></div>
                                <h6 style="text-align:center">HEXA CROWN</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!-- START RIGHT SIDEBAR NAV -->

        </div>
    </div>
  
    <div class="content-overlay"></div>

<script>
 $(document).ready(function(){
    $('.tooltipped').tooltip();

$('#findusertreeform').submit(function(e){
    e.preventDefault();
    var memberd = $('#mmemberid').val();
    if(memberd =='')
    {
        alert('Member Id is Required');
        return false;
    }
    window.location.href="{{url('/tree')}}/"+memberd;
});
// When hovering over a title, show its children
$(document).on('click','.clickthis', function(){
  
  var $this = $(this);
  var id = $this.data('id');
  var token = '{{csrf_token()}}';
  $.ajax({
      url:'{{url("tree")}}/'+id,
      method:'get',
      data:{
        '_token':token,
      },
      success:function(suc){
          
        $this.parent().append(suc);
        $this.removeClass('clickthis');
        $this.addClass('treeactive');
        $this.parent().siblings().find('.level').parent().find('.title').addClass('clickthis');
        $this.parent().siblings().find('.level').hide('slow',function(){ $(this).remove(); })

        // $this.parent().siblings().find('.level').remove();
        $this.next().show('slow');
        $('.tooltipped').tooltip();
      }
  });
  
  
});
$(document).on('click','.treeactive',function(){
    var $this = $(this);
    $this.addClass('clickthis');
    $this.removeClass('treeactive');
    $this.parent().find('.level').hide('slow',function(){ $(this).remove(); })
})
 });

</script>
@endsection