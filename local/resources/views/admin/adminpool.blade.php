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
        <div id="admin" class="col s12">
          
          <div class="card material-table">
            <div class="table-header">
              <span class="table-title">{{$title}}</span>
             
            </div>
            <table id="datatable">
              <thead>
                <tr>
                  <th>Level</th>
                  <th>Total</th>           
                </tr>
              </thead>
              <tbody>
                 <?php $i=0; $getpools= make_pool_report(); if(count($getpools)>0) { foreach($getpools as $pool) { ?>
                <tr>
                    <td>{{$i}}</td>
                    <td><?php if (is_array($pool) ) { echo count($pool); } else { print_r($pool); } ?></td>
                </tr>
                <?php $i++; } } ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
        <script type="text/javascript">
           
           
           
           
           $(document).ready(function() {
            
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
});

});
          </script>
  @endsection
