@extends('layouts.app')
@section('content')
<style>
  .dataTables_empty,.dataTables_processing
  {
    text-align: center;
  }
  
</style>
<div id="check_fund_details" class="modal modal-fixed-footer">
    <div class="modal-content ">
      <h4>Fund Request Information</h4>
      <div class="fund_data"></div>
            <form method="POST" id="fund_data_form" action=""> @csrf {{method_field("PUT")}}
                <div class="row">
                    <div class="input-field col s12">
                        <select required name="new_status">
                            <option value="0">PENDING</option>
                            <option value="1">PAID</option>
                            <option value="2">REJECTED</option>
                        </select>
                        <label>Select Status</label>
                    </div>
                    <div class="input-field col s12">
                        <textarea name="admin_remarks" style="border:0px solid #eee;border-bottom:1px solid #ddd"></textarea>
                        <label>Remarks</label>
                    </div>
                    <div class="input-field col s12">
                       <button type="submit" class="btn">Update</button>
                    </div>
                </div>
            </form>
    </div>
    
  </div>




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
                  <th>##</th>
                  <th>Sender Address</th>
                  <th>Name</th>
                  <th>Member ID</th>
                   <th>Amount</th>
                   <th>BTC</th>
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
        
        $(document).on('click','.click_get_user',function(e){
        e.preventDefault();
        $('#check_fund_details .fund_data').html('');
        $('#fund_data_form').css('display','none');
        var id = $(this).data('id');
        $.ajax({
            url:"{{route('fundinfo')}}",
            method:'GET',
            data:{
                'id':id,
                '_token':'{{csrf_token()}}',
            },
            success:function(succ){
                if(succ.data){
                    // console.log(succ.data);
                    if(succ.data.transaction_status==0){
                        var stat = 'NEW';
                        $('#fund_data_form').css('display','block');
                    }else if(succ.data.transaction_status==1){
                        var stat = 'PAID';
                        $('#fund_data_form').css('display','none');
                    }else
                    {
                        var stat = 'REJECTED';
                        $('#fund_data_form').css('display','none');
                    }
                    var neeurl = '{{url("/")}}/images/';
                    var coptyy = "'#copytrassad'";
                    var newdata = "<table>"+
                                    "<tr><th>Name<th><td>"+succ.data.name+"<td></tr>"+
                                    "<tr><th>Memberid<th><td>"+succ.data.memberid+"<td></tr>"+
                                    "<tr><th>BTC ADDRESS<th><td>"+succ.data.sender_address+"<td></tr>"+
                                    "<tr><th>Transaction ID<th><td ><a href='#' id='copytrassad'  onclick='copyToClipboard("+coptyy+");' >"+succ.data.transaction_id+"</a><td></tr>"+
                                    "<tr><th>Amount<th><td>"+succ.data.amount+"<td></tr>"+
                                    "<tr><th>BTC<th><td>"+succ.data.btc+"<td></tr>"+
                                    "<tr><th>Doc<th><td><a href='"+neeurl+succ.data.transaction_file+"' target='_blank'>Download</a><td></tr>"+
                                    "<tr><th>Status<th><td>"+stat+"<td></tr>"+
                                    "<tr><th>Remarks<th><td>"+succ.data.comments+"<td></tr>"+
                                    "</table>";
                 var withurl = '{{url("royal/fundinfo_data/")}}/'+id;
                 $('#fund_data_form').attr('action',withurl);
                    $('#check_fund_details .fund_data').html(newdata);
                }else
                {
                    swal(succ.error);
                }
            },
            error:function(err){
                console.log(err);
                swal('Something Went Wrong!');
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
                  ajax: "{{ route('member_fund_requests') }}",
                  columns: [
                      {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                      {data: 'sender_address', name: 'sender_address'},
                      {data: 'name', name: 'name'},
                      {data: 'memberid', name: 'memberid'},
                      
                      {data: 'amount', name: 'amount'},
                      {data:'btc',name:'btc'},
                      {data: 'status',name:'status'},
                      {data: 'created_at', name: 'created_at'},
                  ]
});

});
          </script>
  @endsection