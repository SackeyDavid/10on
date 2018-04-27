<link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome-all.css') }}">
<div class="card card-default">
                <div class="card-header">
                <ul class="list-inline">
                        <li class="list-inline-item">Add Trip Fare Breakdown</li>
                        <li class="list-inline-item float-right"><i style="cursor: pointer;font-size: 16px;" class="fas fa-chevron-down" onclick='
                        if (this.parentNode.parentNode.parentNode.children[1].style.display === "none") {
                            this.parentNode.parentNode.parentNode.children[1].style.display = "block";
                        } else {
                            this.parentNode.parentNode.parentNode.children[1].style.display = "none";
                        }
                        $(this).toggleClass("fa-chevron-up fa-chevron-down");
                        '></i></li>
                    </ul> 
                    
                    <div style="display: none;">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col" class="text-warning">Trip ID</th>
                          <th scope="col" class="text-success">Road fare</th>
                          <th scope="col" class="text-danger">Carrier imposed charges</th>
                          <th scope="col">Total tax</th>
                          <th scope="col">Total per passenger</th>
                          <th scope="col" class="text-primary">Action</th>
                        </tr>
                      </thead>
                     
                </table>
                        @if (!$ones_fares->count())
                        You have no fares saved
                        @else
                        @foreach ($ones_fares as $fare)
                        <form id="formq_{{$fare->id}}" method="POST" action="{{route('fare.delete', ['id' =>$fare->id, 'for_trip' => $fare->for_trip])}}">
                            {{ csrf_field() }} 
                        <table class="table">
                        <tbody>   
                        <tr>
                          <th scope="row">{{ $loop->iteration }}</th>
                          <td class="text-warning">{{ $fare->for_trip }}</td>
                          <td class="text-success">{{ $fare->road_fare }}</td>
                          <td class="text-danger">{{ $fare->carrier_imposed_charges }}</td>
                          <td>{{ $fare->total_tax }}</td>
                          <td>{{ $fare->total_per_passenger }}</td>
                          <td><button class="btn btn-primary btn-sm" onclick="document.forms[{{ $loop->iteration }}+2].submit();">X</button></td>
                        </tr>
                         </tbody>
                         </table>
                        </form>
                        @endforeach
                        @endif
                      
                    {{ $ones_fares->links() }}
                </div>
                </div>

                <form class="form-horizontal"  role="form" method="POST" action="{{ route('fare.add') }}">

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


                    

                    <div class="col-sm-5">
                    <label for="career">Select Trip </label>
                    <div class="input-group">
                        @if(!$ones_trips->count())
                        <span style="color: #ff3345;">you haven't saved any trips yet</span>
                        @else

                            <select id="fare_trip_id" type="text" class="form-control" name="trip_id"  required>
                            @foreach($ones_trips as $trip)
                            @if($trip->fare_id != null)
                            
                            @continue

                            @endif
                            <option value="{{ $trip->id }}">{{$trip->departure_location}} to {{$trip->arrival_location}} with {{$trip->bus->bus_number}} leaving at {{$trip->departure_time}} - GH&#8373; {{$trip->trip_fare}}</option>
                            @endforeach
                            </select>
                         
                            
                        @endif
                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-suitcase"></i></span>
                            </div>
                    </div>
                    </div>
                
{{-------------------------------------------------}}
                    
                    <div class="col-sm-4">
                        
                            
                            <label for="occupation">Road fare
                        </label>
                        <div class="input-group">
                            <input type="number" min="0" step=".01" class="form-control" name="road_fare" onchange="this.value = parseFloat(this.value).toFixed(2);" placeholder="0.00">
                            
                            <div class="input-group-append">
                                <span class="input-group-text">GH&#8373;</span>
                            </div>
                        </div>
                        </div>

{{-------------------------------------------------}}
                        
                        <div class="col-sm-3">
                    
                        <label for="company"> Carrier-imposed Charges
                        </label>
                        <div class="input-group">
                            <input type="number" min="0" step=".01" class="form-control" name="carrier_imposed_charges" onchange="this.value = parseFloat(this.value).toFixed(2);" placeholder="0.00">
                            <div class="input-group-append">
                                <span class="input-group-text">GH&#8373;</span>
                            </div>
                        </div>
                        </div>
                        <br>

{{-------------------------------------------------}}
                        <div class="col-sm-8">
                    
                        <label for="position"> Taxes, Fees, and Charges (<span style="font-size: 11px;">amount must equal total tax to be computed below</span>)
                        </label>
                        <div class="input-group">
                        <input type="number" min="0" step=".01" class="form-control" name="total_tax" onchange="this.value = parseFloat(this.value).toFixed(2);" placeholder="0.00">
                            
                            <div class="input-group-append">
                                <span class="input-group-text">GH&#8373;</span>
                            </div>
                        </div>
                        </div>
{{-------------------------------------------------}}
                        <div class="col-sm-4">
                    
                        <label for="position"> Total fare per passenger
                        </label>
                        <div class="input-group">
                            <input type="number" min="0" step="0.01" class="form-control" name="total_per_passenger" onchange="this.value = parseFloat(this.value).toFixed(2);" placeholder="0.00" readonly>
                            <div class="input-group-append">
                                <span class="input-group-text">GH&#8373;</span>
                            </div>

                        </div>
                        </div>

                        <br>
                        </div>

                        

                    
 
                </div>

                <div class="card-footer">
                    <center>
                        <button class="btn btn-primary" id="fare_btn_submit">Save</button>
                        
                    </center>
                </div>
                </form>
            </div>