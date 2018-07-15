 <div class="modal" id="ones_trip_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                            <div class="modal-header">
                                
                                    @if($ones_trips->count())
                                    <h4 class="modal-title">
                                    <span style="font-size: 36px;font-family: Corbel;font-weight: 800;">{{ $ones_trips->count() }}</span> Trips saved
                                    </h4>
                                    @else
                                    <h4 class="modal-title"><span style="font-size: 36px;font-family: Corbel;font-weight: 800;">0</span> Trips saved</h4>
                                    @endif
                                
                                    <br>

                                    <button type="button" class="close" data-dismiss="modal" arial-label="Close" onclick="$('#ones_trip_modal').hide();">x</button>
                            </div>
                        <div class="modal-body container">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col" class="text-warning"><i class="fas fa-arrow-right"></i> station</th>
                          <th scope="col" class="text-success">station <i class="fas fa-arrow-left"></i></th>
                          <th scope="col" class="text-danger"><i class="fas fa-clock"></i>&nbsp; departure</th>
                          <th scope="col"><i class="fas fa-clock"></i>&nbsp; arrival</th>
                          <th scope="col"><i class="fas fa-money-bill-alt"></i> fare (GH&#8373;)</th>
                          <th scope="col" class="text-warning"><i class="fas fa-calendar-alt"></i> &nbsp;departure</th>
                          <th scope="col" class="text-success"><i class="fas fa-calendar-alt"></i> &nbsp;arrival</th>
                          <th scope="col" class="text-danger">via</th>
                          <th scope="col">total fare </th>
                          <th scope="col" class="text-warning"> total tax</th>
                          <th scope="col" class="text-primary">bus</th>
                          <th scope="col" class="text-success">remaining seats</th>
                          <th scope="col" class="text-danger">Action</th>
                        </tr>
                      </thead>
                     
                </table>
                        @if (!$ones_trips->count())
                        You have no trips saved
                        @else
                        @foreach ($ones_trips as $trip)
                        <form id="formq_{{$trip->id}}" method="POST" action="{{route('trip.delete', ['id' => $trip->id])}}">
                            {{ csrf_field() }} 
                        <table class="table">
                        <tbody>   
                        <tr>
                          <th scope="row">{{ $loop->iteration }}</th>
                          <td class="text-warning">
                            @if(!$trip->departure_location)
                            ---
                            @else
                            {{ $trip->departure_location }}
                            @endif
                        </td>
                          <td class="text-success">
                            @if(!$trip->arrival_location)
                            ---
                            @else
                            {{ $trip->arrival_location }}
                            @endif
                        </td>
                          <td class="text-danger">
                            @if(!$trip->departure_time)
                            ---
                            @else
                            {{ $trip->departure_time }}
                            @endif
                        </td>
                          <td>
                            @if(!$trip->arrival_time)
                            ---
                            @else
                            {{ $trip->arrival_time }}
                            @endif
                        </td>
                          <td>
                            @if(!$trip->trip_fare)
                            ---
                            @else
                            {{ $trip->trip_fare }}
                            @endif
                        </td>
                          <td class="text-warning">
                            @if(!$trip->departure_date)
                            ---
                            @else
                            {{ $trip->departure_date }}
                            @endif
                        </td>
                          <td class="text-success">
                            @if(!$trip->arrival_date)
                            ---
                            @else
                            {{ $trip->arrival_date }}
                            @endif
                        </td>
                          <td class="text-danger">
                            @if(!$trip->via)
                            ---
                            @else
                            {{ $trip->via }}
                            @endif
                        </td>
                          <td>
                            @if(!$trip->fare)
                            ---
                            @else
                            @php
                            echo number_format((float)$trip->fare->total_per_passenger, 2);
                            @endphp
                            @endif
                        </td>
                          <td class="text-warning">
                            @if(!$trip->tax)
                            ---
                            @else
                            @php
                            echo number_format((float)$trip->tax->total, 2);
                            @endphp
                            @endif
                        </td>
                          <td class="text-primary">
                            @if(!$trip->bus)
                            ---
                            @else
                            {{ $trip->bus->bus_number }}
                            @endif
                        </td>
                        <td class="text-success">
                            @if(!$trip->remaining_seats)
                            ---
                            @else
                            {{ $trip->remaining_seats }}
                            @endif
                        </td>
                          <td><button class="btn btn-danger btn-sm" onclick="document.forms[{{ $loop->iteration }}+2].submit();" title="Delete this trip">X</button></td>
                        </tr>
                         </tbody>
                         </table>
                        </form>
                        @endforeach
                        @endif
                      
                    {{ $ones_trips->links() }}
                </div>
                <div class="modal-footer">
                    <span style="font-size: 11px;">total fare = total of fare breakdown, total tax = total of tax breakdown</span>
                </div>
                </div>
                </div>
                </div>
 <div class="card card-default">
                <div class="card-header">
                <ul class="list-inline">
                        <li class="list-inline-item">Add Trip </li>
                        <li class="list-inline-item float-right"><i id="chevron" style="cursor: pointer;font-size: 16px;" class="fas fa-chevron-up" onclick='
                        $("#ones_trip_modal").show();
                         $("body").css("overflow", "hidden");
                        // $(this).toggleClass("fa-chevron-up fa-chevron-down");
                        '></i></li>
                    </ul> 
                    
                    
            </div>

                <form class="form-horizontal"  role="form" method="POST" action="{{ route('trip.add') }}">
                <div class="card-body" style="border-bottom: 1px solid #ccc;color: #7f7f7f;">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    {{ csrf_field() }}
                    <div class="row col-md-12">

                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     <input type="hidden" name="from_user" value="{{ Auth::user()->id }}">


                    

                    <div class="col-sm-4">
                    <label for="career">Departure Station </label>
                    <div class="input-group">
                        @if(!$stations->count())
                        <span style="color: #ff3345;">no stations saved</span>
                        @else

                            <select type="text" class="form-control" name="departure_station_id"  required>
                            <option>-can add new bus station below-</option>
                            @foreach($stations as $station)
                            <option value="{{ $station->id }}">{{ $station->name }}</option>
                            @endforeach
                            </select>
                        @endif
                            
                            <div class="input-group-addon">
                                <span class="fa fa-user-o"></span>
                            </div>
                    </div>
                        </div>
                
{{-------------------------------------------------}}
                    
                    <div class="col-sm-4">
                        
                            
                            <label for="occupation">Arrival Station
                        </label>
                        <div class="input-group">
                        @if(!$stations->count())
                        <span style="color: #ff3345;">no stations saved</span>
                        @else

                            <select type="text" class="form-control" name="arrival_station_id"  required>
                            <option>-can add new bus station below-</option>
                            @foreach($stations as $station)
                            <option value="{{ $station->id }}">{{ $station->name }}</option>
                            @endforeach
                            </select>
                        @endif
                            
                            <div class="input-group-addon">
                                <span class="fa fa-"></span>
                            </div>
                        </div>
                        </div>
{{-------------------------------------------------}}                        
                        <div class="col-sm-4">
                    
                        <label for="position"> Departure date / Arrival Date
                        </label>
                        <div class="input-group input-daterange">
                            <input type="text" name="departure_date" class="form-control">
                            <div class="input-group-append"><span class="input-group-text">to</span></div>
                            <input id="to" name="arrival_date" type="text" class="form-control">
                            <!-- <div class="input-group-append">
                                <span class="input-group-text"><i class="far fa-calendar-check"></i></span>
                            </div> -->
                        </div>
                        </div>


{{-------------------------------------------------}}
                        
                        <div class="col-sm-4">
                    
                        <label for="company"> Departure Time
                        </label>
                        <div class="input-group clockpicker">
                            <input type="text" id="departure_time" class="form-control" name="departure_time">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-clock"></i></span>
                            </div>
                        </div>
                        </div>
                        <br>
{{-------------------------------------------------}}
                        <div class="col-sm-4">
                    
                        <label for="position"> Arrival Time
                        </label>
                        <div class="input-group clockpicker">
                            <input type="text" id="arrival_time" name="arrival_time" class="form-control">
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="far fa-clock"></i></span>
                            </div>
                        </div>
                        </div>
{{-------------------------------------------------}}
                        <div class="col-sm-4">
                                            
                        <label for="company"> Trip Duration
                        </label>
                        <div id="trip_duration" class="input-group">
                                <input type="text" class="form-control" name="trip_duration_in_hrs" style="color: #000;" readonly>
                            </div>
                        </div>
{{-------------------------------------------------}}

                    <!-- <div class="col-sm-8">
                    <label for="career">Departure & Arrival Date </label>
                    <div class="input-group input-daterange">
                    <input id="from" name="departure_date" type="text" class="form-control">
                    <div class="input-group-append">
                        <span class="input-group-text">to</span></div>
                    <input id="to" name="arrival_date" type="text" class="form-control">
                    </div>
                    </div> -->
                    
<!-- {{-------------------------------------------------}}
                        
                        <div class="col-sm-4">
                    
                        <label for="company">Use fare breakdown for
                        </label>
                        <div class="input-group">
                        @if(!$ones_fares->count())
                            <span style="color: #ff3345;"><i class="fas fa-exclamation-triangle"></i>  no fare breakdown added</span>
                        @else
                            
                            <select id="trip_cost_id" type="text" class="form-control" name="trip_cost_id">
                                <option></option>
                                @foreach($ones_fares as $fare)
                                <option value="{{ $fare->id }}">{{ $fare->trip->departure_location }} to {{ $fare->trip->arrival_location }}</option>
                                @endforeach
                            </select>
                        @endif    
                            {{$ones_fares->links()}}
                            
                        </div>
                        </div> -->
                        <br>


{{-------------------------------------------------}}

                        <div class="col-sm-4">
                    
                        <label for="position"> Bus
                        </label>
                        <div class="input-group">
                        @if(!$buses->count())
                           <span style="color: #ff3345;"><i class="fas fa-exclamation-triangle"></i> no bus saved, add a bus first </span>
                        @else
                            <select type="text" name="bus_id" class="form-control">
                                @foreach($buses as $bus)
                                <option value="{{ $bus->id }}">{{ $bus->bus_number }}</option>
                                @endforeach
                            </select>
                        @endif
                            {{ $buses->links() }}
                        </div>
                        </div>
{{-------------------------------------------------}}
                        <div class="col-sm-4">
                                            
                        <label for="company"> Number of passenger seats
                        </label>
                        <div id="trip_duration" class="input-group">
                            @if (!$buses->count())
                            please add a bus
                            @else
                            <select type="text" class="form-control" name="remaining_seats" style="color: #000;" readonly>
                                
                                @foreach ($buses as $bus)
                                <option value="{{ $bus->capacity }}">{{ $bus->capacity }} seats - {{ $bus->bus_number }}</option>
                                @endforeach
                            </select>
                                
                            @endif
                            {{ $buses->links() }}
                            </div>
                        </div>                        
{{-------------------------------------------------}}
                        <div class="col-sm-4">
                                            
                        <label for="company"> Trip Fare (<span style="font-size: 11px;">amount must equal total fare to be computed below</span>)
                        </label>
                        <div  class="input-group">
                                <input type="number" min="0" step=".01" name="trip_fare" class="form-control" onchange="this.value = parseFloat(this.value).toFixed(2);" placeholder="0.00" style="color: #000;">
                                <div class="input-group-append">
                                <span class="input-group-text">GH&#8373;</span>
                                </div>
                            </div>
                        </div>
{{-------------------------------------------------}}
                        <div class="col-sm-8">
                                            
                        <label for="company"> Via/Route (<span style="font-size: 11px;">can use multiple tags, must delete values if unapplicable</span>)
                        </label>
                        <div id="" class="input-group">
                                <input type="text" class="form-control bootstrap-tagsinput" value="N1,N4" name="via" style="color: #000;" data-role="tagsinput">
                                <div class="input-group-append">
                                <span class="input-group-text"><i class="fab fa-deviantart"></i></span>
                                </div>
                                
                            </div>
                        </div>


                        </div>

                </div>

                <div class="card-footer">
                    <center>
                        @if(!$buses->count())
                        <button type="submit" class="btn btn-primary" disabled>Save</button>
                        @else
                        <button type="submit" class="btn btn-primary">Save</button>
                        @endif
                        
                    </center>
                </div>
                </form>
            </div>
