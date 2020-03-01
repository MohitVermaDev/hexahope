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
            <div class="col s12 m6 l6">
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
                        <h5 class="mb-0 mt-0 white-text"> {{$money+$poolmoney}}</h5>
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
                        <h5 class="mb-0 mt-0 white-text"> {{$wallet_transactions+$wallet_transactions1}}</h5>
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
                        <h5 class="mb-0 mt-0 white-text"> {{intval(Auth::User()->wallets[0]->amount)}}</h5>
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
                     <div style="border-radius:4px;padding: 1%;">
                    
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
                                <span style="    padding-left: 25px;    color: #000;">All</span>
                              </label>
                              <label class="ml-1 fixmobilewidth">
                                <input class="with-gap date_type" name="date_type" type="radio" value="Partner" />
                                <span style="    padding-left: 25px;    color: #000;">Partner</span>
                              </label>
                              <label  class="ml-1 fixmobilewidth">
                                <input class="with-gap date_type" name="date_type" type="radio" value="Income" />
                                <span style="    padding-left: 25px;    color: #000;">Income</span>
                              </label>
                              <label  class="ml-1 fixmobilewidth">
                                <input class="with-gap date_type" name="date_type" type="radio" value="Purchased" />
                                <span style="    padding-left: 25px;    color: #000;">Purchased</span>
                              </label>
                              <label  class="ml-1 fixmobilewidth">
                                <input class="with-gap date_type" name="date_type" type="radio" value="Topup" />
                                <span style="    padding-left: 25px;    color: #000;">Topup</span>
                              </label>
            
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="input-field col s5" style="margin-top: 30px;">
                             <input type="date" name="from_date" id="from_date" required >
                             <label style="    color: #000; font-size: 17px;">From</label>
                        </div>
                        <div class="input-field col s5" style="margin-top: 30px;">
                             <input type="date" name="to_date" id="to_date" required>
                             <label style="    color: #000; font-size: 17px;">To</label>
                        </div>
                        <div class="input-field col s2" style="margin-top: 30px;    padding: 0 !important;">
                            <button type="submit" class="btn" style="    padding: 0 !important; background:#fff;color:#7622a2; box-shadow:0 0 !important; "><i class="material-icons dp48" style="font-size:30px">youtube_searched_for</i></button>
                        </div>
                    </div>
                   
                  </form>
                  </div>
                 </div>
                
              </div>
          
            
      
        
       
        <div id="admin" class="col s12 all_income">
          <div class="material-table" style="overflow: auto;">
           <div class="table-header">
              <span class="table-title">Detailed Report</span>
              
            </div>
            <table id="datatable">
              <thead>
                <tr>
                  <th>Sr</th>
                  <th style="min-width: 95px;">Dated</th>
                  <th>Wallet</th>
                  <th style="    min-width: 100px;">Source</th>
                  <th >Action</th>                 
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
        <div id="admin" class="col s12 partner_topup" style="display:none">
          <div class="material-table" style="overflow: auto;">
            <div class="table-header">
              <span class="table-title">Detailed Report</span>
              
            </div>
            <table id="partner_topup_table">
              <thead>
                <tr>
                  <th>Sr</th>
                  <th style="min-width: 95px;">Dated</th>
                  <th>Wallet</th>
                  
                  <th >Action</th>                 
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
        <div id="admin" class="col s12 income_topup" style="display:none">
          <div class="material-table" style="overflow: auto;">
           <div class="table-header">
              <span class="table-title">Detailed Report</span>
              
            </div>
            <table id="income_topup_table">
              <thead>
                <tr>
                  <th>Sr</th>
                  <th style="min-width: 95px;">Dated</th>
                  <th>Wallet</th>
                  <th>Action</th>                 
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
        <div id="admin" class="col s12 purchased_topup" style="display:none">
          <div class="material-table" style="overflow: auto;">
            <div class="table-header">
              <span class="table-title">Detailed Report</span>
              
            </div>
            <table id="purchased_topup_table">
              <thead>
                <tr>
                  <th>Sr</th>
                  <th  style="min-width: 95px;">Dated</th>
                  <th>Wallet</th>
                  <th>Source</th>
                  <th >Action</th>                 
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
        <div id="admin" class="col s12 topup_topup" style="display:none">
          <div class="material-table" style="overflow: auto;">
           <div class="table-header">
              <span class="table-title">Detailed Report</span>
              
            </div>
            <table id="topup_topup_table">
              <thead>
                <tr>
                  <th>Sr</th>
                  <th style="min-width: 95px;">Dated</th>
                  <th>Wallet</th>
                  <th>Charges</th>
                  <th>Source</th>
                  <th >Action</th>                 
                </tr>
              </thead>
              <tbody>

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
              <a href="#!" class="modal-close" style="
    display: block;
    color: #000;
    margin-top: 5px;
    font-size: 18px;
    text-align: center;
    font-weight: 700;
    display:none">Close</a>
            </div>
            
        </div>
<script type="text/javascript">

    $(document).ready(function() {
      $('.date_type').change(function() {
            if (this.value == 'all') {
                $('.partner_topup').hide();
                $('.income_topup').hide();
                $('.purchased_topup').hide();
                $('.topup_topup').hide();
                $('.all_income').show();
            }
            else if (this.value == 'Partner') {
                $('.partner_topup').show();
                $('.all_income').hide();
                $('.income_topup').hide();
                $('.purchased_topup').hide();
                $('.topup_topup').hide();
                
            }
            else if (this.value == 'Income') {
                $('.partner_topup').hide();
                $('.all_income').hide();
                $('.income_topup').hide();
                $('.purchased_topup').show();
                $('.topup_topup').hide();
            }
            else if (this.value == 'Purchased') {
                $('.partner_topup').hide();
                $('.all_income').hide();
                $('.income_topup').show();
                $('.purchased_topup').hide();
                $('.topup_topup').hide();
            }
            else if (this.value == 'Topup') {
                $('.partner_topup').hide();
                $('.all_income').hide();
                $('.income_topup').hide();
                $('.purchased_topup').hide();
                $('.topup_topup').show();
            }
        });
        $('#datatable').dataTable();
    
    });
</script>
  @endsection