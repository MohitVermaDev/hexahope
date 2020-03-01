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
              <div class="col s12 m6 l4">
                 <div class="card padding-4 animate fadeLeft">
                    <div class="row">
                       <div class="col s5 m5">
                           <?php $money = DB::table('money')->where('pay_user_id',Auth::User()->id)->where('status',0)->sum('amount');
                           $poolmoney = DB::table('pool_incomes')->where('pay_id',Auth::User()->id)->sum('pool_amount');
                           ?>
                       <h5 class="mb-0">$ {{$money+$poolmoney}}</h5>
                       </div>
                       <div class="col s7 m7 right-align">
                          <i class="material-icons background-round mt-5 mb-5 gradient-45deg-purple-amber gradient-shadow white-text">trending_up</i>
                          <p class="mb-0">Total Profit</p>
                       </div>
                    </div>
                 </div>
                
              </div>
            <div class="col s12 m6 l4">
             <div class="card padding-4 animate fadeLeft">
                <div class="row">
                   <div class="col s5 m5">
                       <?php $money = DB::table('wallet_transactions')->where('user_id',Auth::User()->id)->whereBetween('reason',array(1,2))->where('status',1)->sum('amount');
                       ?>
                   <h5 class="mb-0">$ {{$money}}</h5>
                   </div>
                   <div class="col s7 m7 right-align">
                      <i class="material-icons background-round mt-5 mb-5 gradient-45deg-purple-amber gradient-shadow white-text">trending_up</i>
                      <p class="mb-0">Total Withdraw</p>
                   </div>
                </div>
             </div>
            
          </div>
            
        <div class="col s12 m6 l4">
          <div class="card padding-4 animate fadeLeft">
             <div class="row">
                <div class="col s5 m5"><?php $money = Auth::User()->wallets[0]->amount;?>
                   <h5 class="mb-0">$ {{$money}}</h5>
                </div>
                <div class="col s7 m7 right-align">
                   <i class="material-icons background-round mt-5 mb-5 gradient-45deg-purple-amber gradient-shadow white-text">trending_up</i>
                   <p class="mb-0">Wallet Balance</p>
                </div>
             </div>
          </div>
         
        </div>
        
        </div>
      <div class="row">
        <div id="admin" class="col s12">
          <div class="card material-table">
            <div class="table-header">
              <span class="table-title">{{$title}}</span>
              <div class="actions">
                <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
              </div>
            </div>
            <table id="datatable">
              <thead>
                <tr>
                  <th>Sr</th>
                  <th>Partner ID</th>
                  <th>Partner Name</th>
                  <th>Cr. USD</th>
                  <th>Level</th>
                  <th>Created On</th>                 
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
      </div>
        <script type="text/javascript">
           
           
           
           
           $(document).ready(function() {
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
                  ajax: "{{ route('money.index') }}",
                  columns: [
                      {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                      {data: 'memberid', name: 'memberid'},
                      {data: 'name', name: 'name'},
                      {data: 'amount', name: 'amount'},
                      {data: 'reason', name: 'reason'},
                      {data: 'created_at', name: 'created_at'},
                  ]
});

});
          </script>
  @endsection