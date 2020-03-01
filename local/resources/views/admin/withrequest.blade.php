@extends('layouts.app')
@section('content')
<style>
  .dataTables_empty,.dataTables_processing
  {
    text-align: center;
  }
  
</style>

<div id="check_withdrow_details" class="modal modal-fixed-footer">
    <div class="modal-content ">
      <h4>Withdraw Information</h4>
      <div class="with_draw_data"></div>
            <form method="POST" id="with_data_form" action=""> @csrf {{method_field("PUT")}}
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
                  <th>Amount</th>
                  <th>BTC</th>
                  <th>Name</th>
                  <th>Member ID</th>
                  <th>BTC Address</th>
                  <th>Status</th>
                  <th>Date</th>
                 <th>Action</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>
        </div>
      </div>
        <script type="text/javascript">
        
    $(document).on('click','.click_withdrow_details',function(e){
        e.preventDefault();
        $('#check_withdrow_details .with_draw_data').html('');
        var id = $(this).data('id');
        $.ajax({
            url:"{{route('withdawinfo')}}",
            method:'GET',
            data:{
                'id':id,
                '_token':'{{csrf_token()}}',
            },
            success:function(succ){
                if(succ.data){
                    // console.log(succ.data);
                    if(succ.data.status==0){
                        var stat = 'NEW';
                    }else if(succ.data.status==1){
                        var stat = 'PAID';
                    }else
                    {
                        var stat = 'REJECTED';
                    }
                    var newdata = "<table>"+
                                    "<tr><th>Name<th><td>"+succ.data.name+"<td></tr>"+
                                    "<tr><th>Memberid<th><td>"+succ.data.memberid+"<td></tr>"+
                                    "<tr><th>BTC ADDRESS<th><td>"+succ.data.btc_add+"<td></tr>"+
                                    "<tr><th>BTC Amount<th><td>"+succ.data.btc_amount+"<td></tr>"+
                                    "<tr><th>Amount<th><td>"+succ.data.amount+"<td></tr>"+
                                    "<tr><th>Status<th><td>"+stat+"<td></tr>"+
                                    "</table>";
                 var withurl = '{{url("royal/withdawinfo_update/")}}/'+id;
                 $('#with_data_form').attr('action',withurl);
                    $('#check_withdrow_details .with_draw_data').html(newdata);
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
                  ajax: "{{ route('wallet_requests') }}",
                  columns: [
                      {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                      {data: 'amount', name: 'amount'},
                      {data: 'btc_amount', name: 'btc_amount'},
                      {data: 'name', name: 'name'},
                      {data: 'memberid', name: 'memberid'},
                      {data: 'btc_add', name: 'btc_add'},
                      {data:'status',name:'status'},
                      
                      {data: 'created_at', name: 'created_at'},
                      {data: 'action', name: 'action'},
                  ]
});

});
          </script>
  @endsection