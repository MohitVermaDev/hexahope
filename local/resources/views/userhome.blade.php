@extends('layouts.app')

@section('content')


@if(Auth::User()->id_active == 1)
<div class="row">
    
  <div class="col s12 m6 l3">
     <div class="card padding-4 animate fadeLeft">
        <div class="row">
           <div class="col s5 m5">
               <?php $money = DB::table('money')->where('pay_user_id',Auth::User()->id)->where('status',0)->sum('amount');
               $poolmoney = DB::table('pool_incomes')->where('pay_id',Auth::User()->id)->sum('pool_amount');
               ?>
           <h5 class="mb-0">{{intval($money+$poolmoney)}}</h5>
           </div>
           <div class="col s7 m7 right-align">
              <i class="material-icons background-round mt-5 mb-5 gradient-45deg-purple-amber gradient-shadow white-text">attach_money</i>
              <p class="mb-0">Total Income</p>
           </div>
        </div>
     </div>
    
  </div>
  <div class="col s12 m6 l3">
  <div class="card padding-4 animate fadeLeft">
     <div class="row">
        <div class="col s5 m5"><?php $money = Auth::User()->wallets[0]->amount;?>
           <h5 class="mb-0">{{intval($money)}}</h5>
        </div>
        <div class="col s7 m7 right-align">
           <i class="material-icons background-round mt-5 mb-5 gradient-45deg-purple-amber gradient-shadow white-text">trending_up</i>
           <p class="mb-0">Income Wallet Balance</p>
        </div>
     </div>
  </div>
 
</div>
  <div class="col s12 m6 l3">
    <div class="card padding-4 animate fadeLeft">
       <div class="row">
          <div class="col s5 m5">
             <h5 class="mb-0">{{intval(Auth::User()->wallets[1]->amount)}}</h5>
          </div>
          <div class="col s7 m7 right-align">
             <i class="material-icons background-round mt-5 mb-5 gradient-45deg-purple-amber gradient-shadow white-text">account_balance</i>
             <p class="mb-0">Topup Wallet Balance</p>
          </div>
       </div>
    </div>
   
 </div>
 
 <div class="col s12 m6 l3">
  <div class="card padding-4 animate fadeLeft">
     <div class="row">
       <?php $id = create_downline_report(Auth::User()->id,1);?>
       <?php $id1 = create_downline_report(Auth::User()->id,0);?>
        <div class="col s5 m5">
           <h5 class="mb-0"><?php echo count($id);?></h5>
           <p class="no-margin">Partners</p>
        </div>
        <div class="col s7 m7 right-align">
           <i class="material-icons background-round mt-5 mb-5 gradient-45deg-purple-amber gradient-shadow white-text">supervisor_account</i>
           <p class="mb-0">Active Partners</p>
        </div>
     </div>
  </div>
 
</div>

</div>
@endif

<div class="row" id="card-stats" >
    <div class="col s12 m6 l3 card-width animate fadeRight">
          <div class="card animate fadeLeft">
               <div class="card-content accent-2 white-text" style="background-image: linear-gradient(to right top, #6decb8, #6dedba, #6eefbb, #6ef0bd, #6ff1bf, #6ff1bf, #6ff1bf, #6ff1bf, #6ef0bd, #6eefbb, #6dedba, #6decb8);">
                  <h5 class=" white-text">Hexa Master </h5>
                  <h4  class=" white-text"><b>$ 10</b></h4>
                   @if(Auth::User()->plan_id < 1)
                   <div class="success-errors"></div>
                   <form action="{{route('activation')}}" class="activation"  method="POST">
                       @csrf
                       <input type="hidden" name="value" value="1">
                      <button class="btn btn-dark mt-3" type="submit" class="submitactivation"> Buy </button>
                    </form>
                      @else
                     <span class=" users-view-status chip  green lighten-5 green-text ">Purchased </span>
                    @endif
               </div>
              
            </div>
       
      </div>
      <div class="col s12 m6 l3 card-width animate fadeRight">
          <div class="card animate fadeLeft">
               <div class="card-content accent-2 white-text" style="background-image: radial-gradient(circle, #ffa259, #ffa259, #ffa259, #ffa259, #ffa259, #ffa259, #ffa259, #ffa259, #ffa259, #ffa259, #ffa259, #ffa259);">
                  <h5 class=" white-text">Hexa Royal </h5>
                  <h4  class=" white-text"><b>$ 15</b></h4>
                    @if(Auth::User()->plan_id < 2)
                    <div class="success-errors"></div>
                    <form action="{{route('activation')}}" class="activation" method="POST">
                       @csrf
                       <input type="hidden" name="value" value="2" >
                      <button class="btn btn-dark mt-3" type="submit" class="submitactivation"> Buy </button>
                    </form>
                    @else
                       <span class=" users-view-status chip  green lighten-5 green-text "> Purchased  </span>
                    @endif
               </div>
              
            </div>
     
      </div>
      <div class="col s12 m6 l3 card-width animate fadeLeft">
            <div class="card animate fadeLeft">
               <div class="card-content accent-2 white-text" style="background-image: radial-gradient(circle, #69d1e8, #6ed3e7, #73d5e7, #78d7e6, #7dd9e6, #7dd9e4, #7ed8e3, #7ed8e1, #7ad5de, #75d2db, #71cfd8, #6cccd5);">
                  <h5 class=" white-text">Hexa Diamond </h5>
                  <h4  class=" white-text"><b>$ 50</b></h4>
                     @if(Auth::User()->plan_id < 3)
                     <div class="success-errors"></div>
                    <form action="{{route('activation')}}" method="POST" class="activation">
                       @csrf
                       <input type="hidden" name="value" value="3">
                      <button class="btn btn-dark mt-3" type="submit" class="submitactivation"> Buy </button>
                    </form>  @else
                      <span class=" users-view-status chip  green lighten-5 green-text "> Purchased  </span>
                    @endif
               </div>
              
            </div>
      
      </div>
      <div class="col s12 m6 l3 card-width  animate fadeLeft">
            <div class="card animate fadeLeft">
               <div class="card-content accent-2 white-text" style="background-image: linear-gradient(to right top, #e9da5f, #e6d25c, #e3cb59, #e0c356, #ddbc53);">
                  <h5 class=" white-text">Hexa Crown </h5>
                  <h4  class=" white-text"><b>$ 75</b></h4>
                    @if(Auth::User()->plan_id < 4)
                    <div class="success-errors"></div>
            <form action="{{route('activation')}}" class="activation" method="POST">
               @csrf
               <input type="hidden" name="value" value="4">
              <button class="btn btn-dark mt-3" type="submit" class="submitactivation"> Buy </button>
            </form>
            @else
                <span class=" users-view-status chip  green lighten-5 green-text "> Purchased  </span>
            @endif
               </div>
              
            </div>
      

      </div>
      @if(Auth::User()->plan_id == 0)
      <div class="col s12 m12 l12 card-width  animate fadeLeft">
            <div class="card animate fadeLeft">
               <div class="card-content " style="background-image: radial-gradient(circle, #966ae0, #a36fe1, #ae74e2, #b979e4, #c47ee5, #c57ce6, #c579e8, #c677e9, #bd6ceb, #b261ec, #a657ef, #984df1);">
                  <h5 class=" white-text"><i class=" white-text material-icons">touch_app</i> You Need to Buy atleast one package from above! </h5>
                 
                   
               </div>
              
            </div>
       @endif

      </div>
</div>
<script>
  $('.activation').submit(function(){
      var valu = $(this).children('input[name=value]').val();
      var $this = $(this).parent().find('.success-errors');
      var text11='';
      if(valu==1){
          text11='Hexa Master (10$)';
      }else if(valu==2){
          text11='Hexa Royal (15$)';
      }else if(valu==3){
          text11='Hexa Diamond (50$)';
      }else if(valu==4){
          text11='Hexa Crown (75$)';
      }
      $.ajax({
            url:'{{route("check_first_balance")}}',
            method:'POST',
            data:{
                '_token':'{{csrf_token()}}',
                'value':valu,
            },
            success:function(sc)
            {
                if(sc.success){
                    $this.html(sc.success);
                          swal({
          title: "Are you sure?",
          text: "You Want to Buy "+text11,
          buttons: {
              cancel: true,
              delete: 'Yes, I am sure!'
            },
          dangerMode: true,
        }).then(function(isConfirm) {
          if (isConfirm) {
            //   alert(valu);
            //   return false;
                 $.ajax({
                    url:'{{route("activation")}}',
                    method:'POST',
                    data:{
                        '_token':'{{csrf_token()}}',
                        'value':valu,
                    },
                    success:function(sc)
                    {
                        if(sc.success){
                            swal("success", sc.success);
                            // $('#thisreload').load(' #main');
                            setTimeout(function() { location.reload();  }, 1000);
                        }
                      else
                      {
                        $this.html(sc.error);
                        return false;
                      }
                    },
                    error:function(err)
                    {
                      $this.html('Something Went Wrong');
                      console.log(err);
                      return false;
                    }
                });
          } 
        });
              
                return true;

                }
               else
               {
                $this.html(sc.error);
                window.location.href="{{route('send_fund_requests')}}";
                return false;
               }
            },
            error:function(err)
            {
              $this.html('Something Went Wrong');
              console.log(err);
              return false;
            }
        });
      return false;
  });
</script>


@if(Auth::User()->id_active == 1)
<div class="row">
    <div class="col s12 m6 l6" id="card-stats" style="    padding: 0;">

         <!-- User Statistics -->
         <div class="card user-statistics-card animate fadeLeft">
            <div class="card-content">
               <h4 class="card-title mb-0">Level Income</h4>
              
               
                  <iframe class="chartjs-hidden-iframe" tabindex="-1" style="display: block; overflow: hidden; border: 0px; margin: 0px; top: 0px; left: 0px; bottom: 0px; right: 0px; height: 100%; width: 100%; position: absolute; pointer-events: none; z-index: -1;"></iframe>
               <canvas id="usersreport" style="width:100%;height: 397px;"></canvas>
               
            </div>
         </div>
         <div class="card user-statistics-card animate fadeLeft">
            <div class="card-content">
               <h4 class="card-title mb-0">Referral Link</h4>
              
               <span onclick="copyToClipboard('#refereallnk');" id="refereallnk">{{url('/')}}/register/?memberid={{Auth::User()->memberid}}</span>
               
            </div>
         </div>
      </div>
     <script>
     
$(document).ready(function(){
  $.ajax({
    url: "{{route('levelchart')}}",
    method: "GET",
    success: function(data) {
      // console.log(data);
      var player = [];
      var score = [];

      for(var i in data) {
        player.push(data[i][0]);
        score.push(data[i][1]);
      }

      var chartdata = {
        labels: player,
        datasets : [
          {
            label: 'Level Report',
            backgroundColor : [
                        "#ffa259",
                        "#fe6845",
                        "#fa4252",
                        "#91bd3a",
                        "#561f55",
                        "#8b2f97",
                        "#cf56a1",
                        "#fcb2bf",
                        "#151965",
                        "#32407b",
                        "#515585",
                        "#46b5d1",
                    ],
                    borderColor : [
                        "#ffa259",
                        "#fe6845",
                        "#fa4252",
                        "#91bd3a",
                        "#561f55",
                        "#8b2f97",
                        "#cf56a1",
                        "#fcb2bf",
                        "#151965",
                        "#32407b",
                        "#515585",
                        "#46b5d1",
                    ],
                    borderWidth : [1, 1, 1, 1, 1],
            data: score
          }
        ]
      };

      var ctx = $("#usersreport");

      var barGraph = new Chart(ctx, {
        type: 'pie',
        data: chartdata
      });
    },
    error: function(data) {
      console.log(data);
    }
  });
});
    </script>
  
    <div class="col s12 m6 l6">
        <div class="card padding-4 animate fadeRight">
            @if(Auth::User()->profile_image != '')
            <img src="{{url('/images')}}/{{Auth::User()->profile_image}}" style="width:150px;margin:0 auto;display:block" class="circle">
            @else
            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcQ4Dyl_4V_fW1rrZQ-mPPQaTGvIwnGT3mzmTQ-pWpPpQ6FiwffJNQ&s" style="width:150px;margin:0 auto;display:block" class="circle">
            @endif
            
            <h5 class="center-align">{{Auth::User()->name}} @ {{Auth::User()->memberid}}</h5>
            <p class="center-align">My Package : <?php if(Auth::User()->plan_id==1){ echo 'Hexa Master (10$)';}
              elseif(Auth::User()->plan_id==2){echo 'Hexa Royal (15$)';}
              elseif(Auth::User()->plan_id==3){echo 'Hexa Diamond (50$)';}
              elseif(Auth::User()->plan_id==4){echo 'Hexa Crown (75$)';}
              ?></p>
            <table class="striped">
                <tr>
                    <th><b>Mobile: </b></th>
                    <td style="text-align:right"><span class=" users-view-status chip  green lighten-5 green-text ">{{Auth::User()->mobile}}</span></td>
                </tr>
                <tr>
                    <th><b>Email: </b></th>
                    <td style="text-align:right"><span class=" users-view-status chip  green lighten-5 green-text ">{{Auth::User()->email}}</span></td>
                </tr>
                <tr>
                    <th><b>Sponsor: </b></th>
                    <td style="text-align:right"><span class=" users-view-status chip  green lighten-5 green-text ">{{Auth::User()->sponserid}}</span></td>
                </tr>
                <tr>
                    <th><b>Upline: </b></th>
                    <td style="text-align:right"><span class=" users-view-status chip  green lighten-5 green-text ">{{Auth::User()->u_parent}}</span></td>
                </tr>
                <tr>
                    <th><b>Activation Date: </b></th>
                    <td style="text-align:right"><span class=" users-view-status chip  green lighten-5 green-text ">{{Auth::User()->activation_date}}</span></td>
                </tr>
                <tr>
                    <th><b>Registration Date: </b></th>
                    <td style="text-align:right"><span class=" users-view-status chip  green lighten-5 green-text ">{{Auth::User()->created_at}}</span></td>
                </tr>
            </table>
        </div>
    </div>
</div>
@endif


@endsection
