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
                       <h5 class="mb-0 mt-0">$ {{$money}}</h5>
                       </div>
                       <div class="col s7 m7 right-align">
                          <a href="{{route('income_ledger')}}" class="btn btn-sm mb-0">Level Income</a>
                       </div>
                    </div>
                 </div>
                
              </div>
            <div class="col s12 m6 l4">
             <div class="card padding-4 animate fadeLeft">
                <div class="row">
                   <div class="col s5 m5">
                        <h5 class="mb-0 mt-0">$ {{$poolmoney}}</h5>
                   </div>
                   <div class="col s7 m7 right-align">
                      <a href="{{route('pool_income_ledger')}}" class="btn btn-sm mb-0">Pool Income</a>
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
                <a href="{{route('fundtransfer')}}" class="waves-effect btn-flat nopadding"><i class="material-icons">swap_horiz</i></a>
              </div>
            </div>
            <table id="datatable">
              <thead>
                <tr>
                  <th>Sr</th>
                  <th>Dated</th>
                   <th>Credited</th>
                  <th style="    padding-left: 28px;">Action</th>                         
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
      </div>
        <div id="income_ledger_report" class="modal">
            <div class="modal-content">
              
            </div>
            <div class="modal-footer">
              <a href="#!" class="modal-close waves-effect waves-green btn-flat" style="display:none">Close</a>
            </div>
        </div>
        <script type="text/javascript">
        var imgsas = '{{asset("dashboard-assets/lodgif.gif")}}';
           $('#income_ledger_report .modal-content').html('<img src="'+imgsas+'" style="width: 100%;height: 200px;object-fit: contain;">');
           $(document).on('click','.get_current_ledger',function(e){
               var imgsas = '{{asset("dashboard-assets/lodgif.gif")}}';
              $('#income_ledger_report .modal-content').html('<img src="'+imgsas+'" style="width: 100%;height: 200px; object-fit: contain;">');
               e.preventDefault();
               var date = $(this).data('id');
               $.ajax({
                   url:'{{route("pool_income_ledger_report")}}',
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
                  ajax: "{{ route('pool_income_ledger') }}",
                  columns: [
                      {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                      {data: 'date', name: 'date'},
                      {data: 'total', name: 'total'},
                      {data: 'action', name: 'action'},
                  ]
});

});
          </script>
  @endsection