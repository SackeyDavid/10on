 <link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
@if($owbookings->count() > 0 || $search_history)

<div class="card card-default" style="margin: 1%;">
<div class="card-header">
  Found {{$owbookings->count()}} search results for '{{$search_history}}'
</div>
@foreach($owbookings as $ow)
<div class="card-body" style="padding: 1%;font-size: 12.5px;">

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
@endforeach
</div>

      <center  style="padding-bottom: 0%;">
    
      </center >

@else


<div class="col-md-12 row">
  
    
        <center><b> No search result found.</b></center>
</div>    
  
@endif