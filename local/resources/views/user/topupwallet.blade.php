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
                
                <a class="waves-effect waves-light btn modal-trigger right" href="#withdraw11">Profit Transfer to Joining Wallet</a>
           
                <div id="withdraw11" class="modal">
                <div class="modal-content">
                  <h5>Transfer Fund in Joining Wallet</h5>
                  <span>Balance: {{Auth::User()->wallets[0]->amount}}</span>
                    <form action="" method="POST" id="joinwidthmoney">
                        @csrf
                        <div id="jointhiserrors"></div>
                        <div class="input-field col s12">
                            <select class="validate" required name="joinfinalamount" id="joinfinalamount">
                                <option value="">--Select USD--</option>
                                @for($i=1;$i<=50;$i++)
                                    <option value="{{$i}}">{{$i*20}}</option>
                                @endfor
                            </select>
                        </div>
                         <div class="input-field col s12">
                          <button class="btn" id="thisjoinsubmit" type="submit">Transfer</button>
                        </div>
                    </form>
                </div>
              
              </div>
             
            </div>
       
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col s12">
            <div class="card">
                <div class="card-content">
                    <h5>Joining Wallet Balance : {{Auth::User()->wallets[1]->amount}}</h5>
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
                  <th>Type</th>
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
    
           function checkmybalance(old,errornew,blockbtn,wallettype)
           {
               $.ajax({
                   url:'{{route("checkmybalance")}}',
                   method:'POST',
                   data:{
                       '_token':'{{csrf_token()}}',
                       'oldamount':old,
                       'wallettype':wallettype
                   },
                   success:function(suc){
                       if(suc.error){
                           $(errornew).html('<span style="color:red;font-weight:800">'+suc.error+'</span>');
                           $(blockbtn).attr('disabled',true);
                           return false;
                       }else if(suc.success){
                            $(errornew).html('');
                            $(blockbtn).attr('disabled',false);
                            return true;
                       }
                   }
               });
            }
           
           $('#joinfinalamount').change(function(e){
               e.preventDefault();
               if($(this).val() == '' || isNaN($(this).val()))
               {
                   $('#jointhiserrors').html('<span style="color:red;font-weight:800">Select Amount First</span>');
                   return false;
               }
               checkmybalance($(this).val(),'#jointhiserrors','#thisjoinsubmit',0);
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
                  ajax: "{{ route('topupwallet') }}",
                  columns: [
                      {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                      {data: 'amount', name: 'amount'},
                      {data: 'reason', name: 'reason'},
                      {data: 'status', name: 'status'},
                      {data: 'created_at', name: 'created_at'},
                  ]
});

});
          </script>
  @endsection