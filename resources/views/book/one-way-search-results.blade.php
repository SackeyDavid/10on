@if($trips->count())

@foreach($trips as $trip)
<form method="POST"  action="{{route('oneway.trip.found', ['trip_id' => $trip->id, 'passenger_num' => $passenger_num])}}">
      @csrf
  <!-- This form is expected to have a document.form index of 1 as it is the second form on the search-trips.blade.php, the first is the returnTab form. So I used an unaltered loop->iteration which value is starts at one-->
<a href="javascript:void(0)" onclick="document.forms[{{ $loop->iteration }}].submit();"> 
<div class="card-body" style="padding: 1%;background-color: #fff;border-radius: 3px;margin-bottom: 2%;border: 1px solid #e0e0e0;">
            <ul class="list-inline" style="margin-bottom: 0%;">
            <li style="width: 35%"> 
                <ul class="list-inline">
                    <li>
               <ul class="list-unstyled">
                   <li><span style="font-size: 20px;">{{ $trip->departure_time }}</span></li>
                   <li>{{ $trip->arrival_time }}</li>
               </ul>
                    </li>
                    <li style="font-size: 30px;"><b style="border-right: solid 1px #ccc;height: 150px;"></b></li>
                    
                </ul>
            </li>
            
            <li style="width: 43%"> 
               <ul class="list-unstyled">
                   <li><span style="color: #777;">{{ $trip->via }} <span style="font-weight: 100;">|</span> {{ $trip->trip_duration_in_hrs }}</span></li>
                   <li>{{ $trip->departure_location }}</li>
                   <li>
                    <ul class="list-inline">
                    <li> {{ $trip->arrival_location }}</li>
                    <li class="float-right">{{ $trip->host->username }}</li>
                    </ul>
                   </li>
               </ul>
            </li>
            <li class="float-right" style="width: 25%;margin-top: 6%;margin-right: -5%;color: #ff3345;"> 
               <ul class="list-unstyled">
                   <li></li>
                   <li><span style="font-size: 11px;">GHS</span> <span style="font-size: 27px;">{{ $trip->trip_fare }}</span></li>
               </ul>
            </li>
            </ul>
            <hr style="border-top: dotted 1px;margin-bottom: 1%;margin-top: 0%;color: #ccc;" />
            <span style="font-weight: 400; font-family: Corbel;color: #777;">{{ $trip->remaining_seats }} seats left.</span>
            </div>
            </a>
          </form>
            
@endforeach

      <center  style="padding-bottom: 0%;">
      {{ $trips->links() }}
      </center >

@else


<div class="col-md-12 row">
  
    
        <b>Oops, {{ $departure }} to {{ $search_item }} not found. Try another search.</b>
</div>    
  
@endif