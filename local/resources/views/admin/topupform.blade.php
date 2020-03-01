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
                        Enter Client Member ID and Amount You Want to Send.
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
                        <form action="{{route('topup_wallet_now')}}" method="POST" id="submitthe_form">
                            @csrf
                              <div class="input-field col s12 l6">
                                <input type="text" id="memberid" name="memberid" class="validate" required>
                                <label for="memberid">Member ID</label>
                              </div>
                              <div class="input-field col s12 l6">
                                <input type="text" id="amount" name="amount" class="validate" required>
                                <label for="amount">Amount</label>
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
        <div class="col s12 l6">
            <div class="container">
                <div class="section">
                    <div class="card">
                        <div class="card-content">
                            <h5 class="center-align">Client Info</h5>
                            <div class="error_message"></div>
                            <table class="striped">
                               
                                    <tr>
                                        <th><b>Name</b></th>
                                        <td id="membername" class="blue-text right-align"></td>
                                        
                                    </tr>
                                
                                    <tr>
                                        <th><b>Member ID</b></th>
                                        <td id="thismemberid" class="green-text right-align"></td>
                                        
                                    </tr>
                                    <tr>
                                        <th><b>Phone No.</b></th>
                                        <td id="phone_no" class="red-text right-align"></td>
                                        
                                    </tr>
                                    <tr>
                                        <th><b>Email</b></th>
                                        <td id="email_id" class="yellow-text right-align"></td>
                                        
                                    </tr>
                                
                            </table>
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
                  <th>##</th>
                  <th>Name</th>
                  <th>UserID</th>
                  <th>Amount</th>
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
                  ajax: "{{ route('topup_wallet') }}",
                  columns: [
                      {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                      {data: 'name', name: 'name'},
                      {data: 'userid', name: 'userid'},
                      {data: 'amount', name: 'amount'},
                      {data: 'created_at', name: 'created_at'},
                  ]
});

});
        $('#memberid').change(function(e){
            e.preventDefault();
            var memberid = $(this).val();
            check_member(memberid);
        });
        function check_member(id)
        {
            $.ajax({
                url:'{{route("check_user")}}',
                method:'POST',
                data:{
                    'member':id,
                    '_token':'{{csrf_token()}}',
                },
                success:function(suc){
                    if(suc.success)
                    {
                        $('.block_btn').attr('disabled',false);
                        $('.error_message').html('');
                        $('#membername').html(suc.success.name);
                        $('#thismemberid').html(suc.success.memberid);
                        $('#phone_no').html(suc.success.mobile);
                        $('#email_id').html(suc.success.email);
                    }else
                    {
                        $('.block_btn').attr('disabled','disabled');
                        $('#membername').html('');
                        $('#thismemberid').html('');
                        $('#phone_no').html('');
                        $('#email_id').html('');
                        $('.error_message').html('<div class="card-alert card gradient-45deg-red-pink">'+
                '<div class="card-content white-text"><p><i class="material-icons">error</i>'+suc.error+'</p></div>'+
                '</div>');
                    }
                }
            });
        }
    </script>
  @endsection