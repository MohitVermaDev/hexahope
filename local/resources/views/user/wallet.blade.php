<?php
$totaldirect = gettotalsponsers(Auth::id());
if($totaldirect < 1)
{
    echo '<script>
    alert("You Dont have Enough Sponser");
    window.location.href="'.route('home').'"
    </script>';
}

?>
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
            <div class="col s12 m6 l6">
                
               <a class="waves-effect waves-light btn right" href="{{route('withdrawal')}}">Withdraw</a>
              
               
            </div>
       
          </div>
        </div>
      </div>
      <div class="row">
       <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h5>Profit Wallet Balance : {{Auth::User()->wallets[0]->amount}}</h5>
                </div>
            </div>
        </div>
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
                  <th>Amount</th>
                  <th>BTC Amount</th>
                  <th>Type</th>
                  <th>BTC Address</th>
                  <th>Status</th>
                  <th>Date</th>
                 
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
                  ajax: "{{ route('wallet') }}",
                  columns: [
                      {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                      {data: 'amount', name: 'amount'},
                      {data: 'btc_amount', name: 'btc_amount'},
                      {data: 'reason', name: 'reason'},
                      {data: 'btc_add', name: 'btc_add'},
                      {data: 'status', name: 'status'},
                      {data: 'created_at', name: 'created_at'},
                  ]
});

});
          </script>
  @endsection