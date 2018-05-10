@if($trips->count())

@foreach($trips as $trip)
<form method="POST"  action="{{route('oneway.trip.found', ['trip_id' => $trip->id, 'passenger_num' => $passenger_num])}}">
      @csrf 
  <!-- This form is expected to have a document.form index of 1 as it is the second form on the search-trips.blade.php, the first is the returnTab form. So I used an unaltered loop->iteration which value is starts at one //border color e0e0e0--> 
<a href="javascript:void(0)" onclick="document.forms[{{ $loop->iteration }}].submit();"> 
<div class="card-body" style="padding: 1%;background-color: #fff;border-radius: 8px;margin-bottom: 2%;border: 1px solid #f8f8f8;color: #686868;">
            <ul class="list-inline" style="margin-bottom: 0%;">
            <li style="width: 35%" style="margin: 0%;padding: 0%;"> 
                <ul class="list-inline">
                    <li>
               <ul class="list-unstyled">
                   <li><span style="font-size: 20px;font-weight: 400;">{{ $trip->departure_time }}</span></li>
                   <li><span style="font-size: 14px;font-weight: 350;">{{ $trip->arrival_time }}</span></li>
               </ul>
                    </li>
                    <li style="font-size: 30px;"><b style="border-right: solid 1px #ccc;height: 150px;"></b></li>
                    
                </ul>
            </li>
            
            <li style="width: 43%"> 
               <ul class="list-unstyled" style="margin: 0%;padding: 0%;">
                   <li><span style="color: #777;font-size: 11px;">{{ $trip->via }} <span style="font-weight: 100;">|</span> {{ $trip->trip_duration_in_hrs }}</span></li>
                   <li><span style="font-size: 15px;font-weight: 300;font-family: Arial;">{{ $trip->departure_location }}</span></li>
                   <li>
                    <ul class="list-inline">
                    <li><span style="font-size: 15px;font-weight: 300;font-family: Arial;"> {{ $trip->arrival_location }}</span></li>
                    <li class="float-right"></li>
                    </ul>
                   </li>
               </ul>
            </li>
            <li class="float-right" style="width: 25%;margin-top: 5%;margin-right: -5%;"> 
               <ul class="list-unstyled">
                   <li style="font-weight: 200;">{{ $trip->host->username }}</li>
                   <li style="color: #ff3345;"><span style="font-size: 10px;">GHS</span> <span style="font-size: 20px;">{{ $trip->trip_fare }}</span></li>
               </ul>
            </li>
            </ul>
            <hr style="border-top: dotted 1px;margin-bottom: 1%;margin-top: 0%;color: #ccc;" />
            <span style="font-weight: 200; font-family: Corbel;color: #777;">{{ $trip->remaining_seats }} seats left.</span>
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