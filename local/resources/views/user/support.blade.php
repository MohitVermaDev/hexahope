
@extends('layouts.app')
@section('content')

<style>
  .dataTables_empty,.dataTables_processing
  {
    text-align: center;
  }
  
</style>

  <div id="viewsupportstat" class="modal">
    <div class="modal-content">
      <h4>Support Status</h4>
      <div id="supportstat"></div>
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
                <a class="waves-effect waves-light btn modal-trigger right" href="#fundtrans">Add Support</a>
               <div id="fundtrans" class="modal">
                <div class="modal-content">
                  <h5>Support Message</h5>
                  
                    <form action="{{route('add_support')}}" method="POST" id="add_support" enctype="multipart/form-data">
                        @csrf
                        <div class="input-field col s12">
                            <input type="text" required name="title" id="title" required>
                            <label>Title</label>
                        </div>
                        <div class="input-field col s12">
                            <input type="file"  name="upload_support" id="upload_support">
                            
                        </div>
                        <div class="input-field col s12">
                            <textarea name="description" id="description" required style="border: none; border-bottom: 1px solid #bbb;"></textarea>
                            <label>Description</label>
                        </div>
                         <div class="input-field col s12">
                          <button class="btn" id="thisfundsubmit" type="submit">Submit</button>
                        </div>
                    </form>
                </div>
              
              </div>
               
            </div>
       
          </div>
        </div>
      </div>
      <div class="row">
      
        <div id="admin" class="col s12">
          <div class="card material-table">
            <div class="table-header">
              <span class="table-title">{{$title}} History</span>
              <div class="actions">
                <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
              </div>
            </div>
            <table id="datatable">
              <thead>
                <tr>
                  <th>Sr</th>
                  <th>Title</th>
                  <th>Message</th>
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
       $(document).on('click','.viewsupportstat',function(e){
           e.preventDefault();
           var id = $(this).data('id');
           $('#supportstat').html('');
           $.ajax({
               url:"{{route('get_support_status')}}",
               method:'POST',
               data:{
                   'id':id,
                   '_token':'{{csrf_token()}}',
               },
               success:function(suc){
                   if(suc.success){
                      var sup = '';
                      var stat = 'PENDING';
                        if(suc.success.status==0){
                            stat = 'PENDING';
                        }
                        if(suc.success.status==1){
                            stat = 'PROCESSING';
                        }
                        if(suc.success.status==2){
                            stat = 'COMPLETED';
                        }
                       if(suc.success.upload_support != '' && suc.success.upload_support != null){
                           var urls = '{{url("/images")}}';  
                            sup = '<a href="'+urls+'/'+suc.success.upload_support+'" target="_blank">Download</a>';
                       }
                        var tabledata = '<table>'+
                            '<tr><th>Title</th><td>'+suc.success.title+'</td></tr>'+
                            '<tr><th>Messege</th><td>'+suc.success.description+'</td></tr>'+
                            '<tr><th>Admin Remarks</th><td>'+suc.success.admin_remarks+'</td></tr>'+
                            '<tr><th>Docs</th><td>'+sup+'</td></tr>'+
                            '<tr><th>Status</th><td>'+stat+'</td></tr>'+
                            '</table>';
                            $('#supportstat').html(tabledata);
                   }else if(suc.error)
                   {
                       $('#supportstat').html(suc.error);
                   }
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
                  ajax: "{{ route('support') }}",
                  columns: [
                      {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                      {data: 'title', name: 'title'},
                      {data: 'description', name: 'description'},
                      {data: 'status', name: 'status'},
                      {data: 'created_at', name: 'created_at'},
                      {data: 'view', name: 'view'},
                  ]
});

});
          </script>
  @endsection