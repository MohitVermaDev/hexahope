@extends('layouts.app')
@section('content')
<link rel="stylesheet" hred="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css">
<style>
  .dataTables_empty,.dataTables_processing
  {
    text-align: center;
  }
    .modal th,.modal td
  {
      text-align:right;
  }
  @media only screen and (max-width: 700px){
.modal {
    width: 94%;
}
}
.thisfncselected input.select-dropdown.dropdown-trigger
  {
      color:#fff;
  }
  @media (max-width:1471){
    .dropdown-content li>a, .dropdown-content li>span {
        padding: 14px 11px !important;
        font-size: 14px;
}
}
</style>
<div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
        <div class="row">
            <div class="col s12 m12 l6">
              <h5 class="breadcrumbs-title mt-0 mb-0"><span>Income Wallet Report</span></h5>
              <ol class="breadcrumbs mb-0">
              <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a>
                </li>
              
                <li class="breadcrumb-item active">{{$title}}
                </li>
              </ol>
              <br>
            </div>
            <div class="col s12 m12 l6">
                <div class="row">
                    <div class="input-field col s8 thisfncselected">
                        <select id="thisfncselected">
                          <option value="0" selected>Transfer in Topup Wallet</option>
                          <option value="1">Transfer for Withdrawal</option>
                        </select>
                        <!--<label style="    color: #fff;">Transfer in Topup Wallet</label>-->
                    </div>
                    <div class="input-field col s4">
                        <a class="waves-effect waves-light btn blue modal-trigger right" style="margin-right:4px; display:none" id="newfundadd"  href="#withdraw11" >Add Fund to joining Wallet</a>
                        <div id="withdraw11" class="modal">
                <div class="modal-content">
                  <h5>Transfer in Topup Wallet</h5>
                  <span>Balance: {{Auth::User()->wallets[0]->amount}}</span>
                    <form action="" method="POST" id="joinwidthmoney">
                        @csrf
                        <div id="jointhiserrors"></div>
                        <div class="input-field col s4"><img style="width: 100%;" src="https://hexahope.com/web-assets/icon.png" alt="materialize logo"></div>
                        <div class="input-field col s8">
                            <select class="validate" required name="joinfinalamount" id="joinfinalamount">
                                <option value="">--Select Amount--</option>
                                @for($i=1;$i<=50;$i++)
                                    <option value="{{$i}}">{{$i*5}}</option>
                                @endfor
                            </select>
                        </div>
                         <div class="input-field col s12">
                          <button class="btn" id="thisjoinsubmit" type="submit">Transfer</button>
                        </div>
                    </form>
                </div>
              
              </div>
                        <button type="button" class="btn btn-danger" id="thisselected">Go!</button>
                    </div>
                </div>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
          <div class="col s12 m6 l6 xl4">
            <div class="card gradient-45deg-light-blue-cyan gradient-shadow white-text animate fadeLeft">
               <div class="padding-4">
                  <div class="row">
                     <div class="col s3 m3">
                        <i class="material-icons background-round ">timeline</i>
                     </div>
                     <div class="col s9 m9 right-align">
                         <?php $money = DB::table('money')->where('pay_user_id',Auth::User()->id)->where('status',0)->sum('amount');
               $poolmoney = DB::table('pool_incomes')->where('pay_id',Auth::User()->id)->sum('pool_amount');
               ?>
                        <h5 class="mb-0 mt-0 white-text">$ {{$money+$poolmoney}}</h5>
                        <p class="no-margin">Total Credit</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
        <div class="col s12 m6 l6 xl4">
            <div class="card gradient-45deg-red-pink gradient-shadow white-text animate fadeLeft">
               <div class="padding-4">
                  <div class="row">
                     <div class="col s3 m3">
                        <i class="material-icons background-round ">attach_money</i>
                     </div>
                     <div class="col s9 m9  right-align">
                         <?php
                            $wallet_transactions = DB::table('wallet_transactions')->where('user_id',Auth::id())->whereBetween('reason',array(1,2))->whereBetween('status',array(0,1))->sum('amount');
                            $wallet_transactions1 = DB::table('wallet_transactions')->where('user_id',Auth::id())->whereBetween('reason',array(1,2))->whereBetween('status',array(0,1))->sum('withdraw_charges');
                         ?>
                        <h5 class="mb-0 mt-0 white-text">$ {{$wallet_transactions+$wallet_transactions1}}</h5>
                        <p class="no-margin">Total Debit</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col s12 m6 l6 xl4">
            <div class="card gradient-45deg-amber-amber gradient-shadow white-text animate fadeRight">
               <div class="padding-4">
                  <div class="row">
                     <div class="col s3 m3">
                        <i class="material-icons background-round ">account_balance_wallet</i>
                     </div>
                     <div class="col s9 m9 right-align">
                        <h5 class="mb-0 mt-0 white-text">$ {{Auth::User()->wallets[0]->amount}}</h5>
                        <p class="no-margin">Balance</p>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="card">
        <div class="row">
            
              <div class="col s12">
                  
                  <div class="padding-1 animate fadeLeft">
                     <div style="border:1px solid #eee;border-radius:4px;padding: 1%;">
                    
                    <form method="GET" action="#" id="hexa_income_filter">
                        @csrf
                     <div class="row">
                        <div class="col s12">
                            <br>
                            <style>
                                @media(max-width:473px)
                                {
                                    .fixmobilewidth
                                    {
                                        min-width:23%;
                                        display:inline-block;
                                    }
                                }
                            </style>
                            <label class="ml-1 fixmobilewidth">
                                <input class="with-gap date_type" name="date_type" type="radio" value="all" checked  />
                                <span style="    padding-left: 25px;">All</span>
                              </label>
                              <label class="ml-1 fixmobilewidth">
                                <input class="with-gap date_type" name="date_type" type="radio" value="level" />
                                <span style="    padding-left: 25px;">Level</span>
                              </label>
                              <label  class="ml-1 fixmobilewidth">
                                <input class="with-gap date_type" name="date_type" type="radio" value="loyality" />
                                <span style="    padding-left: 25px;">Loyality</span>
                              </label>
                              <label  class="ml-1 fixmobilewidth">
                                <input class="with-gap date_type" name="date_type" type="radio" value="pool" />
                                <span style="    padding-left: 25px;">Pool</span>
                              </label>
                              <label  class="ml-1 fixmobilewidth">
                                <input class="with-gap date_type" name="date_type" type="radio" value="with_trans" />
                                <span style="    padding-left: 25px;">Withdraw / Transfer</span>
                              </label>
            
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="input-field col s4" style="margin-top: 30px;">
                             <input type="date" name="from_date" id="from_date" required >
                             <label style="    color: #000; font-size: 17px;">From</label>
                        </div>
                        <div class="input-field col s4" style="margin-top: 30px;">
                             <input type="date" name="to_date" id="to_date" required>
                             <label style="    color: #000; font-size: 17px;">To</label>
                        </div>
                        <div class="input-field col s4" style="margin-top: 30px;">
                            <button type="submit" class="btn">Go</button>
                        </div>
                    </div>
                   
                  </form>
                  </div>
                 </div>
                
              </div>
          
            
      
        
       
        <div id="admin" class="col s12 all_income">
          <div class="material-table">
            <div class="table-header">
              <span class="table-title">{{$title}}</span>
             
            </div>
            <table id="datatable">
              <thead>
                <tr>
                  <th>Sr</th>
                  <th  style="min-width: 95px;">Dated</th>
                  <th>Wallet</th>
                  <th>Source</th>
                  <th style="    padding-left: 28px;">Action</th>                 
                </tr>
              </thead>
              <tbody>
                @if(count($data11)>0)
                <?php $i=1;?>
                    @foreach($data11 as $dat)
                        <tr>
                            <td>{{++$i}}</td>
                            <td>{{$dat['date']}}</td>
                            <td><?php echo $dat['total']; ?></td>
                            <td>{{$dat['income_type']}}</td>
                            <td><?php echo $dat['action']; ?></td>
                        </tr>
                        
                    @endforeach
                @endif
              </tbody>
            </table>
          </div>
        </div>
      
      </div>
       </div>
         <div id="income_ledger_report" class="modal modal-fixed-footer">
            <div class="modal-content" style="    padding: 10px;">
              
            </div>
            <div class="modal-footer">
              <a href="#!" class="modal-close waves-effect waves-green btn-flat btn-primary" style="display:none">Close</a>
            </div>
        </div>
        <script type="text/javascript">
         $('#joinwidthmoney').submit(function(e){
               e.preventDefault();
               $('#thisjoinsubmit').attr('disabled',true);
               
               var total = $('#joinfinalamount').val();
               if(total == '' || isNaN(total))
               {
                   $('#jointhiserrors').html('<span style="color:red;font-weight:800">Select Amount First</span>');
                   return false;
               }
               checkmybalance(total,'#jointhiserrors','#thisjoinsubmit',0);
               $('#thisjoinsubmit').attr('disabled',true);
               $.ajax({
                   url:"{{route('transferstart')}}",
                   method:"POST",
                   data:{
                       '_token':"{{csrf_token()}}",
                       'oldamount':total,
                   },success:function(suc){
                        if(suc.error){
                           $('#jointhiserrors').html('<span style="color:red;font-weight:800">'+suc.error+'</span>');
                           $('#thisjoinsubmit').attr('disabled',true);
                           return false;
                       }else if(suc.success){
                           $('#jointhiserrors').html('');
                            alert(suc.success);
                            window.location.reload();
                       }
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
                           if(chargeacc==2){
                          
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
               checkmybalance($(this).val(),'#thiserrors','#thiswithdrawsubmit',0,0);
           });
           
           

        
        
        var imgsas = '{{asset("dashboard-assets/lodgif.gif")}}';
           $('#income_ledger_report .modal-content').html('<img src="'+imgsas+'" style="width: 100%;height: 200px;object-fit: contain;">');
           $(document).on('click','.get_current_ledger',function(e){
               var imgsas = '{{asset("dashboard-assets/lodgif.gif")}}';
              $('#income_ledger_report .modal-content').html('<img src="'+imgsas+'" style="width: 100%;height: 200px; object-fit: contain;">');
               e.preventDefault();
               var date = $(this).data('id');
               $.ajax({
                   url:'{{route("get_current_ledger",["gettitle"=>"level"])}}',
                   method:'POST',
                   data:{
                       'date':date,
                       '_token':'{{csrf_token()}}',
                   },
                   success:function(suc)
                   {
                       $('#income_ledger_report .modal-content').html(suc);
                       $('#income_ledger_report .modal-close').css('display','block');
                   }
               });
           });
           
             $(document).on('click','.pool_current_ledger',function(e){
               var imgsas = '{{asset("dashboard-assets/lodgif.gif")}}';
              $('#income_ledger_report .modal-content').html('<img src="'+imgsas+'" style="width: 100%;height: 200px; object-fit: contain;">');
               e.preventDefault();
               var date = $(this).data('id');
               $.ajax({
                   url:'{{route("get_current_ledger",["gettitle"=>"pool"])}}',
                   method:'POST',
                   data:{
                       'date':date,
                       '_token':'{{csrf_token()}}',
                   },
                   success:function(suc)
                   {
                       $('#income_ledger_report .modal-content').html(suc);
                       $('#income_ledger_report .modal-close').css('display','block');
                   }
               });
           });
            $(document).on('click','.loyal_current_ledger',function(e){
               var imgsas = '{{asset("dashboard-assets/lodgif.gif")}}';
              $('#income_ledger_report .modal-content').html('<img src="'+imgsas+'" style="width: 100%;height: 200px; object-fit: contain;">');
               e.preventDefault();
               var date = $(this).data('id');
               $.ajax({
                   url:'{{route("get_current_ledger",["gettitle"=>"loyality"])}}',
                   method:'POST',
                   data:{
                       'date':date,
                       '_token':'{{csrf_token()}}',
                   },
                   success:function(suc)
                   {
                       $('#income_ledger_report .modal-content').html(suc);
                       $('#income_ledger_report .modal-close').css('display','block');
                   }
               });
           });
            $(document).on('click','.with_current_ledger',function(e){
               var imgsas = '{{asset("dashboard-assets/lodgif.gif")}}';
              $('#income_ledger_report .modal-content').html('<img src="'+imgsas+'" style="width: 100%;height: 200px; object-fit: contain;">');
               e.preventDefault();
               var date = $(this).data('id');
               $.ajax({
                   url:'{{route("get_current_ledger",["gettitle"=>"withdraw"])}}',
                   method:'POST',
                   data:{
                       'date':date,
                       '_token':'{{csrf_token()}}',
                   },
                   success:function(suc)
                   {
                       $('#income_ledger_report .modal-content').html(suc);
                       $('#income_ledger_report .modal-close').css('display','block');
                   }
               });
           });
            $(document).on('click','.topup_current_ledger',function(e){
               var imgsas = '{{asset("dashboard-assets/lodgif.gif")}}';
              $('#income_ledger_report .modal-content').html('<img src="'+imgsas+'" style="width: 100%;height: 200px; object-fit: contain;">');
               e.preventDefault();
               var date = $(this).data('id');
               $.ajax({
                   url:'{{route("get_current_ledger",["gettitle"=>"transfer"])}}',
                   method:'POST',
                   data:{
                       'date':date,
                       '_token':'{{csrf_token()}}',
                   },
                   success:function(suc)
                   {
                       $('#income_ledger_report .modal-content').html(suc);
                       $('#income_ledger_report .modal-close').css('display','block');
                   }
               });
           });
           $(document).ready(function() {
                $('.datepicker').datepicker({'format':'yyyy-mm-dd'});
                
                
                
                $('#hexa_income_filter').submit(function(e){
                    e.preventDefault();
                    var from_date = $('#from_date').val();
                    var to_date = $('#to_date').val();
                    var data_type = $('.date_type:checked').val();
                    window.location.href = '{{url("income/search")}}?data_type='+data_type+'&from_date='+from_date+'&to_date='+to_date+'';
                });
                
                
           });    
               $('#thisselected').click(function(e){
        e.preventDefault();
        var selectedval = $('#thisfncselected option:selected').val();
        if(selectedval==0)
        {
            $('#withdraw11').modal('open');
        }else if(selectedval==1)
        {
            location.href= "{{route('withdrawal')}}";
        }
    });
          </script>
  @endsection