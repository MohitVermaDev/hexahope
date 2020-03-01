@extends('layouts.app')
@section('content')
<style>
  .dataTables_empty,.dataTables_processing
  {
    text-align: center;
  }
  input.select-dropdown.dropdown-trigger
  {
      color:#fff;
  }
</style>





      <div class="content-wrapper-before gradient-45deg-indigo-purple"></div>
    <div class="breadcrumbs-dark pb-0 pt-4" id="breadcrumbs-wrapper">
        <!-- Search for small screen-->
        <div class="container">
          <div class="row">
            <div class="col s6 m6 l9">
              <h5 class="breadcrumbs-title mt-0 mb-0"><span>{{$title}}</span></h5>
              <ol class="breadcrumbs mb-0">
              <li class="breadcrumb-item"><a href="{{url('/home')}}">Home</a>
                </li>
              
                <li class="breadcrumb-item active">{{$title}}
                </li>
              </ol>
            </div>
          
            <div class="col s6 m6 l3">
               <select id="searchlevel">
                  <option value="">Partner Type</option>
                  <option value="Active">Active</option>
                  <option value="Not Yet">Non Active</option>
              </select>
            </div>
          </div>
        </div>
      </div>
      <div class="row">
        <div id="admin" class="col s12">
          <div class="card material-table">
            <div class="table-header">
              <span class="table-title">Detailed Report</span>
              
            
              <div class="actions">
                <a href="#" class="search-toggle waves-effect btn-flat nopadding"><i class="material-icons">search</i></a>
              </div>
            </div>
            <table id="datatable">
              <thead>
                <tr>
                  <th>Sr</th>
                  <th>Partner </th>
                  <th style="    min-width: 94px;">Status</th>
                  <th style="min-width: 90px;">Activation</th>
                  <th>Mobile</th>
                  <th>Upline ID</th>
                  
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
var directtable = $('#datatable').DataTable({
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
                  ajax: "{{ route('get_directes') }}",
                  columns: [
                      {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                      {data: 'name_id', name: 'name_id'},
                      {data: 'status', name: 'status'},
                      {data: 'activation_date', name: 'activation_date'},
                      {data: 'mobile', name: 'mobile'},
                      
                      {data: 'upline_id', name: 'upline_id'},
                      
                  ]
});
$('#searchlevel').on( 'change', function () {
    directtable
        .columns( 4 )
        .search( this.value )
        .draw();
} );
});
          </script>
  @endsection