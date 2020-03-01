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
      <div class="row">
          
        <div  class="col s4">
         <div class="card padding-4 animate fadeLeft">
            <div class="row">
               <div class="col s5 m5">
                  <h5 class="mb-0">{{count($members)}}</h5>
                  <p class="no-margin"></p>
                  <p class="mb-0 pt-8">Total Members For Loyality</p>
               </div>
               <div class="col s7 m7 right-align">
                  <i class="material-icons background-round mt-5 mb-5 gradient-45deg-purple-amber gradient-shadow white-text">perm_identity</i>
                  <p class="mb-0"></p>
               </div>
            </div>
         </div>
        </div>
        <div  class="col s4">
         <div class="card padding-4 animate fadeLeft">
            <table>
                <tr>
                    <th>Total Members in HEXA MASTER</th> <td>{{$plan_1}}</td>
                </tr>
                <tr>
                    <th>Total Members in HEXA ROYAL</th> <td>{{$plan_2}}</td>
                </tr>
               
            </table>
            
         </div>
        </div>
        <div  class="col s4">
         <div class="card padding-4 animate fadeLeft">
            <table>
               
                <tr>
                    <th>Total Members in HEXA DIAMOND</th> <td>{{$plan_3}}</td>
                </tr>
                <tr>
                    <th>Total Members in HEXA CROWN</th> <td>{{$plan_4}}</td>
                </tr>
            </table>
            
         </div>
        </div>
        <div class="col s12">
            <div class="card padding-4 animate fadeLeft">
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
                <form action="{{route('send_loyality')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="input-field col s12">
                            <label>Amount</label>
                            <input id="tt_amount" type="number" name="tt_amount" required>
                        </div>
                        <div class="input-field col s12">
                          <button type="submit" class="btn btn-primary btn-sm">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col s8">
            <div class="card padding-4">
                <table>
                    <tr>
                        <th>##</th>
                        <th>User Id</th>
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                    @if(count($total_loyal)>0)
                    <?php $i=0;?>
                    @foreach($total_loyal as $tot)
                     <tr>
                        <td>{{++$i}}</td>
                        <?php $usertt = DB::table('users')->where('id',$tot->user_id)->first();?>
                        <td>{{$usertt->memberid}}</td>
                        <td>{{$tot->amount}}</td>
                        <td>{{$tot->created_at}}</td>
                    </tr>
                    @endforeach
                    @endif
                </table>
                
            </div>
        </div>
        <div class="col s4">
            <div class="card padding-4">
                <h4>List Of Users for Loyality</h4>
                <table>
                    <tr>
                        <th>##</th>
                        <th>User Id</th>
                    </tr>
                    @if(count($members)>0)
                    <?php $i=0;?>
                    @foreach($members as $tot)
                     <tr>
                        <td>{{++$i}}</td>
                        <td>{{$tot}}</td>
                        
                    </tr>
                    @endforeach
                    @endif
                </table>
               
            </div>
        </div>
      </div>

@endsection