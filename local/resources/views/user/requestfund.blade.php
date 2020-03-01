@extends('layouts.app')
@section('content')


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
      <div class="col s12">
        <div class="container">
            <div class="section">
                <div class="card">
                    <div class="card-content">
                        <h5>Top-up Balance : {{Auth::User()->wallets[1]->amount}}</h5>
                        <br>
                        @if(count($errors) > 0)
                        @foreach($errors->all() as $error)
                            <div class="card-alert card gradient-45deg-red-pink">
                                <div class="card-content white-text">
                                {{$error}}
                            </div> </div>
                        @endforeach
                    @endif

                        @if(session('success'))
                        <div class="card-alert card gradient-45deg-green-teal">
                            <div class="card-content white-text">
                                {{session('success')}}
                            </div>
                        </div>
                        
                        @endif
                        
                        @if(session('error'))
                            <div class="card-alert card gradient-45deg-red-pink">
                                <div class="card-content white-text">
                                    {{session('error')}}
                                </div>

                            </div>
                        @endif
                    </div>
                </div>
            </div><!-- START RIGHT SIDEBAR NAV -->

        </div>
    </div>
    <div class="col s12 l6">
            <div class="container">
                <div class="section">
                    <div class="card">
                        <div class="card-content">
                            <h5 class="center-align">Send Payment To</h5>
                            <div class="row">
                            <div class="col m4">
                                <?php
                                $getqr = DB::table('admin_settings')->where('setting_name','btc_qr')->first();
                                $getbtc = DB::table('admin_settings')->where('setting_name','btc_address')->first();
                                ?>
                                <img src="{{asset('images/'.$getqr->setting_value)}}" style="width:100%">
                            </div>
                            <div class="col m8">
                                <div class="btcprice">1 BTC = <?php $tha = file_get_contents("https://blockchain.info/ticker"); $newdata = json_decode($tha); echo $newdata->USD->buy;?> USD</div>
                                <div id="totalbtc"></div>
                                <div ><b>BTC Address:<b> <br> <div id="copybtc" onclick="copyToClipboard('#copybtc');" >{{$getbtc->setting_value}}</div></div>
                            </div>
                            </div>
                        </div>
                    </div>
                </div><!-- START RIGHT SIDEBAR NAV -->

            </div>
        </div>
        <div class="col s12 l6">
            <div class="container">
                <div class="section">
                    <div class="card">
                        <div class="card-content">
                        <form action="{{route('newsend_fund_requests')}}" onsubmit="return Validate(this);" method="POST" enctype="multipart/form-data" id="newsend_fund_requests">
                            @csrf
                            <div class="row">
                            <div class="input-field col s12 l6">
                                <input type="number" id="amount" name="amount" class="validate" required>
                                <label for="amount">Enter USD</label>
                              </div>
                              <div class="input-field col s12 l6">
                                <input type="text" id="btc" name="btc" placeholder="BTC" readonly class="validate" required>
                                
                              </div>
                              <div class="input-field col s12 l6">
                                <input type="text" id="trans_id" name="trans_id" class="validate" required>
                                <label for="trans_id">BTC Transaction ID</label>
                              </div>
                              <div class="input-field col s12 l6">
                                <input type="text" id="sender_address" name="sender_address" class="validate" required>
                                <label for="sender_address">Your BTC Address</label>
                              </div>
                              <div class="input-field col s12 l12">
                                <input type="file" id="transaction_file" name="transaction_file" class="validate" required>
                                
                              </div>
                              <div class="input-field col s12 l12">
                                <textarea name="remarks" id="remarks" style="border: none; border-bottom: 1px solid #bbb;"></textarea>
                                 <label for="remarks">Remarks</label>
                              </div>
                            </div>
                              <button class="btn waves-effect waves-light block_btn" type="submit" name="action">Submit
                                  <i class="material-icons right">send</i>
                              </button>
                            </form>
                        </div>
                    </div>
                </div><!-- START RIGHT SIDEBAR NAV -->

            </div>
        </div>
        
        <div class="col s12 m12 l12">
            <style>
  .dataTables_empty,.dataTables_processing
  {
    text-align: center;
  }
  
</style>

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
                  <th>Sender Address</th>
                  <th>Name</th>
                  <th>Transaction ID</th>
                  <th>Transaction Doc</th>
                  <th>Amount</th>
                  <th>Status</th>
                  <th>Remarks</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
          
          
        </div>
        <div class="content-overlay"></div>
    </div>
    <script>
               
           $(document).ready(function() {
               $('#amount').change(function(e){
                   e.preventDefault();
                   if($(this).val() == '' || isNaN($(this).val()))
                   {
                         $('#totalbtc').html('Total BTC: ');
                           $('#btc').val('');
                   }
                   $.ajax({
                       url:'https://blockchain.info/tobtc?currency=USD&value='+$(this).val(),
                       success:function(ss){
                           $('#totalbtc').html('Total BTC: '+ss);
                           $('#btc').val(ss);
                       }
                   });
               });
               $('.search-toggle').click(function(e) {
                   e.preventDefault();
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
                  ajax: "{{ route('send_fund_requests') }}",
                  columns: [
                      {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                      {data: 'sender_address', name: 'sender_address'},
                      {data: 'name', name: 'name'},
                      {data: 'transaction_id', name: 'transaction_id'},
                      {data: 'transaction_file', name: 'transaction_file'},
                      {data: 'amount', name: 'amount'},
                      {data: 'status',name:'status'},
                      {data: 'admin_remarks',name:'admin_remarks'},
                      {data: 'created_at', name: 'created_at'},
                  ]
});

});

    var _validFileExtensions = [".jpg", ".jpeg", ".bmp", ".gif", ".png",".pdf"];    
function Validate(oForm) {
    var arrInputs = oForm.getElementsByTagName("input");
    for (var i = 0; i < arrInputs.length; i++) {
        var oInput = arrInputs[i];
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }
                
                if (!blnValid) {
                    alert("Sorry, " + sFileName + " is invalid, allowed extensions are: " + _validFileExtensions.join(", "));
                    return false;
                }
            }
        }
    }
  
    return true;
}
$('form').submit(function(){
    $('.btn').attr('disabled',true);
});

    </script>
  @endsection