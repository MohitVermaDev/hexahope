
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
              <h5 class="breadcrumbs-title mt-0 mb-0"><span>Buy Package</span></h5>
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
        <div class="col s12">
           <div class="container">
                <div class="section">
                    <div class="card">
                        <div class="card-content">
                            <h4 class="card-title">Topup Wallet Balance : {{intval(Auth::User()->wallets[1]->amount)}}</h4>
                            <div class="input-field col s12">
                                <input type="text" id="memberid" name="memberid" class="validate" required="">
                                <label for="memberid">Enter Partner ID</label>
                                <div id="membererror"></div>
                            </div>
                            <div class="row" id="card-stats">
    <div class="col s12 m6  card-width animate fadeRight hexap1">
          <div class="card animate fadeLeft">
               <div class="card-content accent-2 white-text" style="background-image: radial-gradient(circle, #6bd1b3, #70d5b4, #75dab5, #7adeb5, #7fe2b6, #86e5b3, #8de7b1, #94eaae, #9feca8, #aaeea2, #b6ef9c, #c2f097);min-height: 170px;">
                  <h5 class=" white-text">Hexa Master </h5>
                  <h4 class=" white-text"><b>10$</b></h4>
                      <div id="error_data1"></div>   
                      <div id="this_data1"></div>   
                      
                                   </div>
              
            </div>
       
      </div>
      <div class="col s12 m6  card-width animate fadeRight hexap2">
          <div class="card animate fadeLeft">
               <div class="card-content accent-2 white-text" style="background-image: radial-gradient(circle, #eaa258, #eca657, #eeab55, #f0af54, #f1b453, #f1b755, #f1b957, #f1bc59, #f0bd5f, #efbe65, #edbe6a, #ecbf70);min-height: 170px;">
                  <h5 class=" white-text">Hexa Royal </h5>
                  <h4 class=" white-text"><b>15$</b></h4>
                  <div id="error_data2"></div>   
                    <div id="this_data2"></div>
                                   </div>
              
            </div>
     
      </div>
      <div class="col s12 m6  card-width animate fadeLeft hexap3">
            <div class="card animate fadeLeft">
               <div class="card-content accent-2 white-text" style="background-image: radial-gradient(circle, #69d1e8, #6ed3e7, #73d5e7, #78d7e6, #7dd9e6, #7dd9e4, #7ed8e3, #7ed8e1, #7ad5de, #75d2db, #71cfd8, #6cccd5);min-height: 170px;">
                  <h5 class=" white-text">Hexa Diamond </h5>
                  <h4 class=" white-text"><b>50$</b></h4>
                  <div id="error_data3"></div>   
                  <div id="this_data3"></div>
                                   </div>
              
            </div>
      
      </div>
      <div class="col s12 m6  card-width  animate fadeLeft hexap4" >
            <div class="card animate fadeLeft">
               <div class="card-content accent-2 white-text" style="background-image: radial-gradient(circle, #ede768, #eee862, #efe95c, #efe955, #f0ea4e, #f0e94c, #efe74a, #efe648, #ede34b, #ebdf4d, #e9dc50, #e7d952);min-height: 170px;">
                  <h5 class=" white-text">Hexa Crown </h5>
                  <h4 class=" white-text"><b>75$</b></h4>
                  <div id="error_data4"></div>   
                   <div id="this_data4"></div>
                           </div>
              
            </div>
      

      </div>
</div>
                           
                        </div>
                    </div>
                </div><!-- START RIGHT SIDEBAR NAV -->

            </div>
        </div>
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
                  <th>Name</th>
                  <th>Partner ID</th>
                  <th>Plan</th>
                  <th>Amount</th>
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
     function activation(userid,plan){
         $('#submit_1').attr('disabled',true);
         $('#submit_2').attr('disabled',true);
         $('#submit_3').attr('disabled',true);
         $('#submit_4').attr('disabled',true);
         $.ajax({
             url:'{{route("check_my_balance")}}',
            method:'POST',
            data:{
                '_token':'{{csrf_token()}}',
                'plan':plan,
                'userid':userid
            },
            success:function(sc)
            {
                if(sc.success){
                    $('#error_data'+plan).html(sc.success);
                    $.ajax({
                        url:'{{route("activate_downline_now")}}',
                        method:'POST',
                        data:{
                            '_token':'{{csrf_token()}}',
                            'plan':plan,
                            'userid':userid
                        },
                        success:function(sc)
                        {
                            if(sc.success){
                                alert(sc.success);
                                // $('#thisreload').load(' #main');
                                location.reload();
                            }
                           else
                           {
                             $('#submit_1').attr('disabled',false);
                             $('#submit_2').attr('disabled',false);
                             $('#submit_3').attr('disabled',false);
                             $('#submit_4').attr('disabled',false);
                            $('#error_data'+plan).html(sc.error);
                            return false;
                           }
                        },
                        error:function(err)
                        {
                          $('#error_data'+plan).html('Something Went Wrong');
                          console.log(err);
                          return false;
                        }
                    });
                return true;

                }
               else
               {
                $('#error_data'+plan).html(sc.error);
                return false;
               }
            },
            error:function(err)
            {
              $('#error_data'+plan).html('Something Went Wrong');
              console.log(err);
              return false;
            }
         });
       
      }
       $(document).on('click','#submit_1',function(e){
           e.preventDefault();
           var userid = $('#memberid').val();
           swal({
          title: "Are you sure?",
          text: "You Want to Buy Hexa Master (10$)",
          buttons: {
              cancel: true,
              delete: 'Yes, I am sure!'
            },
          dangerMode: true,
        }).then(function(isConfirm) {
          if (isConfirm) {
           activation(userid,1);
          }
        });
       });
       $(document).on('click','#submit_2',function(e){
           e.preventDefault();
           var userid = $('#memberid').val();
           swal({
          title: "Are you sure?",
          text: "You Want to Buy Hexa Royal (15$)",
          buttons: {
              cancel: true,
              delete: 'Yes, I am sure!'
            },
          dangerMode: true,
        }).then(function(isConfirm) {
          if (isConfirm) {
           activation(userid,2);
       }
        });
       });
       $(document).on('click','#submit_3',function(e){
           e.preventDefault();
           var userid = $('#memberid').val();
           swal({
          title: "Are you sure?",
          text: "You Want to Buy Hexa Diamond (50$)",
          buttons: {
              cancel: true,
              delete: 'Yes, I am sure!'
            },
          dangerMode: true,
        }).then(function(isConfirm) {
          if (isConfirm) {
           activation(userid,3);
          }
        });
       });
       $(document).on('click','#submit_4',function(e){
           e.preventDefault();
           var userid = $('#memberid').val();
           swal({
          title: "Are you sure?",
          text: "You Want to Buy Hexa Crown (75$)",
          buttons: {
              cancel: true,
              delete: 'Yes, I am sure!'
            },
          dangerMode: true,
        }).then(function(isConfirm) {
          if (isConfirm) {
           activation(userid,4);
          }
        });
       });
           $(document).ready(function() {
               $('#memberid').change(function(e){
                   e.preventDefault();
                   $('#this_data1').html('');
                               $('#this_data2').html('');
                               $('#this_data3').html('');
                               $('#this_data4').html('');
                   var thisid = $(this).val();
                   $.ajax({
                       url:'{{route("activate_downline_user_info")}}',
                       method:'POST',
                       data:{
                           '_token':'{{csrf_token()}}',
                           'user_nameid':thisid,
                       },
                       success:function(data){
                           if(data.success){
                               if(data.success.plan_id == 0){
                                   
                                   $('#this_data1').html('<input type="hidden" class="choosen_plan" value="1"><button class="btn" id="submit_1" data-id="1">Buy</button>');
                                //   $('.hexap1').css('display','');
                                //   $('.hexap2').css('display','none');
                                //   $('.hexap3').css('display','none');
                                //   $('.hexap4').css('display','none');
                               }else if(data.success.plan_id >= 1)
                               {
                                   $('#this_data1').html('<span class=" users-view-status chip  green lighten-5 green-text ">Active </span>');
                                   $('.hexap1').css('display','none');
                               }
                               if(data.success.plan_id == 1){
                                   $('#this_data2').html('<input type="hidden" class="choosen_plan" value="2"><button class="btn" id="submit_2" data-id="2">Buy</button>');
                                //   $('.hexap1').css('display','none');
                                //   $('.hexap2').css('display','');
                                //   $('.hexap3').css('display','none');
                                //   $('.hexap4').css('display','none');
                               }else if(data.success.plan_id >= 2)
                               {
                                   $('.hexap2').css('display','none');
                                   $('#this_data2').html('<span class=" users-view-status chip  green lighten-5 green-text ">Active </span>');
                               }
                               if(data.success.plan_id == 2){
                                   $('#this_data3').html('<input type="hidden" class="choosen_plan" value="3"><button class="btn" id="submit_3" data-id="3">Buy</button>');
                                //   $('.hexap1').css('display','none');
                                //   $('.hexap2').css('display','none');
                                //   $('.hexap3').css('display','');
                                //   $('.hexap4').css('display','none');
                               }else if(data.success.plan_id >= 3)
                               {
                                   $('.hexap3').css('display','none');
                                   $('#this_data3').html('<span class=" users-view-status chip  green lighten-5 green-text ">Active </span>');
                               }
                               if(data.success.plan_id == 3){
                                   $('#this_data4').html('<input type="hidden" class="choosen_plan" value="4"><button class="btn" id="submit_4" data-id="4">Buy</button>');
                                //   $('.hexap1').css('display','none');
                                //   $('.hexap2').css('display','none');
                                //   $('.hexap3').css('display','none');
                                //   $('.hexap4').css('display','');
                               }else if(data.success.plan_id == 4)
                               {
                                   
                                   $('#this_data4').html('<span class=" users-view-status chip  green lighten-5 green-text ">Active </span>');
                                //   $('.hexap1').css('display','');
                                //   $('.hexap2').css('display','');
                                //   $('.hexap3').css('display','');
                                //   $('.hexap4').css('display','');
                               }
                               $('#membererror').css('color','green').css('font-weight','800').html(data.success.name+' @ '+data.success.memberid);
                           }else if(data.error){
                               $('#membererror').css('color','red').css('font-weight','800').html(data.error);
                            //   $('#this_data1').html('');
                            //   $('#this_data2').html('');
                            //   $('#this_data3').html('');
                            //   $('#this_data4').html('');
                           }
                       }
                   });
               });
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
                  ajax: "{{ route('member_activation') }}",
                  columns: [
                      {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                      {data: 'name', name: 'name'},
                      {data: 'memberid', name: 'memberid'},
                      {data: 'plan', name: 'plan'},
                      {data: 'amount', name: 'amount'},
                      {data: 'created_at', name: 'created_at'},
                  ]
});

});
          </script>
  @endsection