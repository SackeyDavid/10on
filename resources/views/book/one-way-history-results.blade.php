 <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
@if($owbookings->count() > 0 || $search_history)

<div class="card card-default" style="margin: 1%;">
<div class="card-header">
  Found {{$owbookings->count()}} search results for '{{$search_history}}'
</div>
@foreach($combined_booking_dates as $dates)
  
  @foreach($owbookings as $ow)
  @if (date('Ymd', strtotime(explode(" ", $ow->created_at)[0])) != $dates)
  @continue

  @else
<div class="card-body" style="padding: 1%;font-size: 12.5px;">
<center>{{$ow->trip->departure_date}}</center>
<table class="table" style="margin-bottom: 1%;">

<tbody>
<tr>
  <th scope="row" style="border-top-style: none;" class="text-success"> {{$ow->trip->departure_time}} - {{$ow->trip->arrival_time}}</th>
  <td style="border-top-style: none;">{{$ow->trip->departure->name}}( {{$ow->trip->departure->abbreviation}}) to {{$ow->trip->arrival->name}}( {{$ow->trip->arrival->abbreviation}}) via {{$ow->trip->via}}</td>
  <td style="border-top-style: none;">GHS {{$ow->trip->trip_fare}}</td>
  <td style="border-top-style: none;">
    <div class="dropdown dropleft float-right">
    <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
      
    
    <div class="dropdown-menu">
      <a class="dropdown-item" href="#" style="cursor: ;">More from this trip</a>
      <div class="dropdown-divider"></div>
      <a class="dropdown-item" style="cursor: pointer;"><span class="delete_history" data-pointid="{{$ow->id}}"> Remove from history</span></a>
    </div>
  </div>
    </td>
</tr>    
        </tbody>
    </table>
</div> 
  @endif  
  @endforeach  

  <!-- return bookings -->
  @foreach($rtbookings as $rt)
  @if (date('Ymd', strtotime(explode(" ", $rt->created_at)[0])) != $dates)
  @continue

  @else
<div class="card-body" style="padding: 1%;font-size: 12.5px;">
<center>{{$ow->trip->departure_date}}</center>
<table class="table" style="margin-bottom: 1%;">

<tbody>
<!-- rt departing trip -->
  <tr>
    <th scope="row" style="" class="text-warning"> {{$rt->departing->departure_time}} - {{$rt->departing->arrival_time}}</th>
    <td style="">{{$rt->departing->departure->name}}( {{$rt->departing->departure->abbreviation}}) to {{$rt->departing->arrival->name}}( {{$rt->departing->arrival->abbreviation}}) via {{$rt->departing->via}}</td>
    <td style="">GHS {{$rt->departing->trip_fare}}</td>
    <td style="">
      <div class="dropdown dropleft float-right">
      <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
        
      
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#" style="cursor: ;">More from this trip</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" style="cursor: pointer;"><span class="delete_history" data-pointid="{{$ow->id}}"> Remove from history</span></a>
      </div>
    </div>
      </td>
  </tr>
  
  <tr>
    <th scope="row" style="border-top-style: none;" class="text-warning"> {{$rt->returning->departure_time}} - {{$rt->returning->arrival_time}}</th>
    <td style="border-top-style: none;">{{$rt->returning->departure->name}}( {{$rt->returning->departure->abbreviation}}) to {{$rt->returning->arrival->name}}( {{$rt->returning->arrival->abbreviation}}) via {{$rt->returning->via}}</td>
    <td style="border-top-style: none;">GHS {{$rt->returning->trip_fare}}</td>
    <td style="border-top-style: none;">
      <div class="dropdown dropleft float-right">
      <i class="fas fa-ellipsis-v" data-toggle="dropdown"></i>
        
      
      <div class="dropdown-menu">
        <a class="dropdown-item" href="#" style="cursor: ;">More from this trip</a>
        <div class="dropdown-divider"></div>
        <a class="dropdown-item" style="cursor: pointer;"><span class="delete_history" data-pointid="{{$ow->id}}"> Remove from history</span></a>
      </div>
    </div>
      </td>
  </tr>    
              </tbody>
    </table>
</div> 
  @endif  
  @endforeach       
@endforeach
</div>

      <center  style="padding-bottom: 0%;">
    
      </center >

@else


<div class="col-md-12 row">
  
    
        <center><b> No search result found.</b></center>
</div>    
  
@endif