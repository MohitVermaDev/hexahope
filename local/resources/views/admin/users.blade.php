@extends('layouts.app')
@section('content')
<style>
  .dataTables_empty,.dataTables_processing
  {
    text-align: center;
  }
  
</style>


  <div id="viewprofile" class="modal">
    <div class="modal-content">
      <h4>View User</h4>
      <div id="result_user"></div>
      
    </div>
     <div class="modal-footer">
      <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
    </div>
  </div>


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
                  <th>Name</th>
                  <th>Email</th>
                  <th>Phone</th>
                  <th>User-ID</th>
                  <th>Password</th>
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
           
           $(document).on('click','.click_get_user',function(){
               $('#result_user').html('');
               var id = $(this).data('id');
               $.ajax({
                   url:'{{route("check_user")}}',
                   method:'POST',
                   data:{
                       'member':id,
                       '_token':'{{csrf_token()}}',
                   },
                   success:function(succ){
                       if(succ.success){
                          
                           var table_data = '<table>'+
                                                '<tr><th>Name</th><td>'+succ.success.name+'</td></tr>'+
                                                '<tr><th>Member Id</th><td>'+succ.success.memberid+'</td></tr>'+
                                                '<tr><th>Sponser ID</th><td>'+succ.success.sponserid+'</td></tr>'+
                                                '<tr><th>Email</th><td>'+succ.success.email+'</td></tr>'+
                                                '<tr><th>Mobile</th><td>'+succ.success.mobile+'</td></tr>'+
                                                '<tr><th>Profit Wallet</th><td>'+succ.success.wallets[0].amount+'</td></tr>'+
                                                '<tr><th>Joining Wallet</th><td>'+succ.success.wallets[1].amount+'</td></tr>'+
                                                '</table>';
                           $('#result_user').html(table_data);
                       }else if(succ.error){
                          
                           $('#result_user').html(succ.error);
                       }
                   },
                   error:function(err){
                       console.log(err);
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
                  ajax: "{{ route('users.index') }}",
                  columns: [
                      {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                      {data: 'name', name: 'name'},
                      {data: 'email', name: 'email'},
                      {data: 'mobile', name: 'mobile'},
                      {data: 'memberid', name: 'memberid'},
                      {data: 'fake_password', name: 'fake_password'},
                      {data: 'action', name: 'action', orderable: false, searchable: false},
                  ]
});

});
          </script>
  @endsection