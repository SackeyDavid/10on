 <div class="card card-default">
                <div class="card-header">Add Trip</div>

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

                            <select type="text" class="form-control" name="departure_location"  required>
                            <option></option>
                            @foreach($stations as $station)
                            <option value="{{ $station->name }}">{{ $station->name }}</option>
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

                            <select type="text" class="form-control" name="arrival_location"  required>
                            <option></option>
                            @foreach($stations as $station)
                            <option value="{{ $station->name }}">{{ $station->name }}</option>
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
                    
{{-------------------------------------------------}}
                        
                        <div class="col-sm-4">
                    
                        <label for="company">Use fare for
                        </label>
                        <div class="input-group">
                        @if(!$fares->count())
                            <span style="color: #ff3345;"> no fare saved</span>
                        @else
                            
                            <select id="trip_cost_id" type="text" class="form-control" name="trip_cost_id">
                                <option></option>
                                @foreach($fares as $fare)
                                <option value="{{ $fare->total_per_passenger }}">{{ $fare->start_point }} to {{ $fare->destination }}</option>
                                @endforeach
                            </select>
                        @endif    
                            {{ $fares->links() }}
                            
                        </div>
                        </div>
                        <br>
{{-------------------------------------------------}}
                        <div class="col-sm-4">
                                            
                        <label for="company"> Trip Cost
                        </label>
                        <div  class="input-group">
                                <input type="text" id="trip_cost" class="form-control" name="trip_cost" style="color: #000;">
                                <div class="input-group-append">
                                <span class="input-group-text">GH&#8373;</span>
                                </div>
                            </div>
                        </div>

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
                                <option value="{{ $bus->bus_number }}">{{ $bus->bus_number }}</option>
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
                            <select type="text" class="form-control" name="remaining_seats" value="$" style="color: #000;" readonly>
                                
                                @foreach ($buses as $bus)
                                <option value="{{ $bus->capacity }}">{{ $bus->capacity }} seats- {{ $bus->bus_number }}</option>
                                @endforeach
                            </select>
                                
                            @endif
                            {{ $buses->links() }}
                            </div>
                        </div>                        

{{-------------------------------------------------}}
                        <div class="col-sm-8">
                                            
                        <label for="company"> Via/Route (cap letters, can use multiple tags)
                        </label>
                        <div id="" class="input-group">
                                <input type="text" class="form-control bootstrap-tagsinput" value="" name="via" style="color: #000;" data-role="tagsinput">
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
