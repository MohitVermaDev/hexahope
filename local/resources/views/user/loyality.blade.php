
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
        
        <div class="col s12">
            <div class="card padding-4">
                <table>
                    <tr>
                        <th>Sr</th>
                       
                        <th>Amount</th>
                        <th>Date</th>
                    </tr>
                    @if(count($total_loyal)>0)
                    <?php $i=0;?>
                    @foreach($total_loyal as $tot)
                     <tr>
                        <td>{{++$i}}</td>
                        
                        <td>{{$tot->amount}}</td>
                        <td>{{$tot->created_at}}</td>
                    </tr>
                    @endforeach
                    @endif
                </table>
            </div>
        </div>
      </div>

@endsection
