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
#joinwidthmoney .select-dropdown.dropdown-trigger
{
    border:1px solid #7622a2;
    border-radius: 4px;
}
#joinwidthmoney ul
{
        box-shadow: rgb(118, 34, 162) 0px 2px 2px 0px, rgb(118, 34, 162) 0px 3px 1px -2px, rgb(118, 34, 162) 0px 1px 5px 0px; 
}
#joinwidthmoney ul.dropdown-content.select-dropdown li
{
    text-align:center;
        /*background: #f3ddff;*/
}
#joinwidthmoney ul.dropdown-content.select-dropdown li span
{
    /*color: #000;*/
    font-size: 17px;
}
#joinwidthmoney .select-dropdown.dropdown-content li.selected {
    background-color: #7622a2 !important;
}

#joinwidthmoney .select-dropdown.dropdown-content li.selected span {
    color: #fff !important;
}
.thisfncselected input.select-dropdown.dropdown-trigger
  {
      color:#fff;
  }
  @media (max-width:1471px){
    .dropdown-content li>a, .dropdown-content li>span {
        padding: 14px 11px !important;
        font-size: 14px;
}
}
div.material-table table th:last-child, div.material-table table td:last-child {
    padding: 0 14px 0 0;
    text-align: center;
}
</style>
<div class="content-wrapper-before gradient-45deg-indigo-purple" ></div>
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
                        <div id="withdraw11" class="modal modal-fixed-footer">
                <div class="modal-content" style="text-align:center;    padding: 5px 5px 0px 5px;;min-height:450px">
                  <h5>Transfer in Topup Wallet</h5>
                  <span>Balance: {{Auth::User()->wallets[0]->amount}}</span>
                  <hr>
                  <br>
                    <form action="" method="POST" id="joinwidthmoney">
                        @csrf
                        <div id="jointhiserrors"></div>
                        <div class="col s12">
                           <span style="color:red">You can transfer income in multiple of 5.</span>
                        </div>
                        <div class="col s4"><i class="material-icons dp48" style="    font-size: 73px;color:#7622a2">swap_horiz</i></div>
                        <div class="col s8">
                            <div class="row">
                                <div class="input-field col s12">
                            <select class="validate" required name="joinfinalamount" id="joinfinalamount">
                                <option value=""> - Select to Transfer - </option>
                                @for($i=1;$i<=50;$i++)
                                    <option value="{{$i}}">{{$i*5}}</option>
                                @endfor
                            </select>
                        </div>
                         <div class="input-field col s12">
                          <button class="btn" id="thisjoinsubmit" type="submit">Transfer</button>
                        </div>
                            </div>
                        </div>
                        
                    </form>
                </div>
               <div class="modal-footer">
              <a href="#!" class="modal-close" style="
    display: block;
    color: #000;
    margin-top: 5px;
    font-size: 18px;
    text-align: center;
    font-weight: 700;
   ">Close</a>
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
                                <input class="with-gap date_type" name="date_type" type="radio" value="level" />
                                <span style="    padding-left: 25px;    color: #000;">Level</span>
                              </label>
                              <label  class="ml-1 fixmobilewidth">
                                <input class="with-gap date_type" name="date_type" type="radio" value="loyality" />
                                <span style="    padding-left: 25px;    color: #000;">Loyality</span>
                              </label>
                              <label  class="ml-1 fixmobilewidth">
                                <input class="with-gap date_type" name="date_type" type="radio" value="pool" />
                                <span style="    padding-left: 25px;    color: #000;">Pool</span>
                              </label>
                              <label  class="ml-1 fixmobilewidth">
                                <input class="with-gap date_type" name="date_type" type="radio" value="with_trans" />
                                <span style="    padding-left: 25px;    color: #000;">Withdraw / Transfer</span>
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
        <div id="admin" class="col s12 level_income" style="display:none">
          <div class="material-table" style="overflow: auto;">
            
            <table id="level_income_table">
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
        <div id="admin" class="col s12 pool_income" style="display:none">
          <div class="material-table" style="overflow: auto;">
           
            <table id="pool_income_table">
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
        <div id="admin" class="col s12 loyality_income" style="display:none">
          <div class="material-table" style="overflow: auto;">
            
            <table id="loyality_income_table">
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
        <div id="admin" class="col s12 with_trs_income" style="display:none">
          <div class="material-table" style="overflow: auto;">
           
            <table id="with_trs_income_table">
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
           
           
           
        $('.dropdown-trigger').dropdown();
        $('.date_type').change(function() {
            if (this.value == 'all') {
                $('.level_income').hide();
                $('.pool_income').hide();
                $('.loyality_income').hide();
                $('.with_trs_income').hide();
                $('.all_income').show();
            }
            else if (this.value == 'level') {
                $('.level_income').show();
                $('.all_income').hide();
                $('.pool_income').hide();
                $('.loyality_income').hide();
                $('.with_trs_income').hide();
                
            }
            else if (this.value == 'loyality') {
                $('.level_income').hide();
                $('.all_income').hide();
                $('.pool_income').hide();
                $('.loyality_income').show();
                $('.with_trs_income').hide();
            }
            else if (this.value == 'pool') {
                $('.level_income').hide();
                $('.all_income').hide();
                $('.pool_income').show();
                $('.loyality_income').hide();
                $('.with_trs_income').hide();
            }
            else if (this.value == 'with_trans') {
                $('.level_income').hide();
                $('.all_income').hide();
                $('.pool_income').hide();
                $('.loyality_income').hide();
                $('.with_trs_income').show();
            }
        });
        
        
        var imgsas = '{{asset("dashboard-assets/lodgif.gif")}}';
           $('#income_ledger_report .modal-content').html('<img src="'+imgsas+'" style="width: 100%;height: 200px;object-fit: contain;">');
           $(document).on('click','.get_current_ledger',function(e){
               $('#income_ledger_report .modal-header').remove();
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
                    window.open('{{url("income/search/")}}?data_type='+data_type+'&from_date='+from_date+'&to_date='+to_date);
                });
                
                
                
                
                
               $('.search-toggle').click(function() {
                   if ($('.hiddensearch').css('display') == 'none')
                     $('.hiddensearch').slideDown();
                   else
                     $('.hiddensearch').slideUp();
                 });
                    $('#datatable').dataTable({
                        
                    "oLanguage": {
                        "sStripClasses": "",
                        "sSearch": "",
                        "sSearchPlaceholder": "Enter Keywords Here",
                        "sInfo": "_START_ -_END_ of _TOTAL_",
                        "sLengthMenu": '<span>Rows per page:</span><select class="browser-default">' +
                        '<option value="10">10</option>' +
                        '<option value="20">20</option>' +
                        '<option value="30">30</option>' +
                        '<option value="40">40</option>' +
                        '<option value="50">50</option>' +
                        '<option value="-1">All</option>' +
                        '</select></div>'
                    },
                    
                    bAutoWidth: false,
                    processing: true,
                  serverSide: true,
                  ajax: "{{ route('all_income') }}",
                  columns: [
                      {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                      {data: 'date', name: 'date'},
                      {data: 'total', name: 'total'},
                      {data: 'income_type', name: 'income_type'},
                      {data: 'action', name: 'action'},
                  ],
                  
});
                    $('#level_income_table').dataTable({
                        "oLanguage": {
                            "sStripClasses": "",
                            "sSearch": "",
                            "sSearchPlaceholder": "Enter Keywords Here",
                            "sInfo": "_START_ -_END_ of _TOTAL_",
                            "sLengthMenu": '<span>Rows per page:</span><select class="browser-default">' +
                            '<option value="10">10</option>' +
                            '<option value="20">20</option>' +
                            '<option value="30">30</option>' +
                            '<option value="40">40</option>' +
                            '<option value="50">50</option>' +
                            '<option value="-1">All</option>' +
                            '</select></div>'
                        },
                        bAutoWidth: false,
                        processing: true,
                      serverSide: true,
                      ajax: "{{ route('income_ledger',['gettitl'=>'level']) }}",
                      columns: [
                          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                          {data: 'date', name: 'date'},
                          {data: 'total', name: 'total'},
                          {data: 'action', name: 'action'},
                      ]
                    });
                    $('#pool_income_table').dataTable({
                        "oLanguage": {
                            "sStripClasses": "",
                            "sSearch": "",
                            "sSearchPlaceholder": "Enter Keywords Here",
                            "sInfo": "_START_ -_END_ of _TOTAL_",
                            "sLengthMenu": '<span>Rows per page:</span><select class="browser-default">' +
                            '<option value="10">10</option>' +
                            '<option value="20">20</option>' +
                            '<option value="30">30</option>' +
                            '<option value="40">40</option>' +
                            '<option value="50">50</option>' +
                            '<option value="-1">All</option>' +
                            '</select></div>'
                        },
                        bAutoWidth: false,
                        processing: true,
                      serverSide: true,
                      ajax: "{{ route('income_ledger',['gettitl'=>'pool']) }}",
                      columns: [
                          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                          {data: 'date', name: 'date'},
                          {data: 'total', name: 'total'},
                          {data: 'action', name: 'action'},
                      ]
                    });
                    $('#loyality_income_table').dataTable({
                        "oLanguage": {
                            "sStripClasses": "",
                            "sSearch": "",
                            "sSearchPlaceholder": "Enter Keywords Here",
                            "sInfo": "_START_ -_END_ of _TOTAL_",
                            "sLengthMenu": '<span>Rows per page:</span><select class="browser-default">' +
                            '<option value="10">10</option>' +
                            '<option value="20">20</option>' +
                            '<option value="30">30</option>' +
                            '<option value="40">40</option>' +
                            '<option value="50">50</option>' +
                            '<option value="-1">All</option>' +
                            '</select></div>'
                        },
                        bAutoWidth: false,
                        processing: true,
                      serverSide: true,
                      ajax: "{{ route('income_ledger',['gettitl'=>'loyality']) }}",
                      columns: [
                          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                          {data: 'date', name: 'date'},
                          {data: 'total', name: 'total'},
                          {data: 'income_type', name: 'income_type'},
                          {data: 'action', name: 'action'},
                      ]
                    });
                    $('#with_trs_income_table').dataTable({
                        "oLanguage": {
                            "sStripClasses": "",
                            "sSearch": "",
                            "sSearchPlaceholder": "Enter Keywords Here",
                            "sInfo": "_START_ -_END_ of _TOTAL_",
                            "sLengthMenu": '<span>Rows per page:</span><select class="browser-default">' +
                            '<option value="10">10</option>' +
                            '<option value="20">20</option>' +
                            '<option value="30">30</option>' +
                            '<option value="40">40</option>' +
                            '<option value="50">50</option>' +
                            '<option value="-1">All</option>' +
                            '</select></div>'
                        },
                        bAutoWidth: false,
                        processing: true,
                      serverSide: true,
                      ajax: "{{ route('income_ledger',['gettitl'=>'with_trans']) }}",
                      columns: [
                          {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                          {data: 'date', name: 'date'},
                          {data: 'total', name: 'total'},
                          {data: 'charges', name: 'charges'},
                          {data: 'income_type', name: 'income_type'},
                          {data: 'action', name: 'action'},
                      ]
                    });
});
    $('#thisselected').click(function(e){
        e.preventDefault();
        var selectedval = $('#thisfncselected option:selected').val();
        if(selectedval==0)
        {
            $('#withdraw11').modal('open');
            // location.href= "{{route('fundtransfer')}}";
        }else if(selectedval==1)
        {
            location.href= "{{route('withdrawal')}}";
        }
    });
          </script>
  @endsection