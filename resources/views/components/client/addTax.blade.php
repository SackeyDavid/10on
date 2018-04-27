<div class="card card-default">
                <div class="card-header">
                <ul class="list-inline">
                        <li class="list-inline-item">Add Tax Breakdown for Trip Fare</li>
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
                          <th scope="col" class="text-success">Tax-NTA</th>
                          <th scope="col" class="text-danger">Passenger Service Charge</th>
                          <th scope="col">Passenger Facilities Charges</th>
                          <th scope="col">Advance Passenger Info. Fee</th>
                          <th scope="col">Station Service Charge</th>
                          <th scope="col">Total</th>
                          <th scope="col" class="text-primary">Action</th>
                        </tr>
                      </thead>
                     
                </table>
                        @if (!$ones_taxes->count())
                        You have no fares saved
                        @else
                        @foreach ($ones_taxes as $tax)
                        <form id="formq_{{$tax->id}}" method="POST" action="{{route('tax.delete', ['id' =>$tax->id, 'for_trip' => $tax->for_trip])}}">
                            {{ csrf_field() }} 
                        <table class="table">
                        <tbody>   
                        <tr>
                          <th scope="row">{{ $loop->iteration }}</th>
                          <td class="text-warning">{{ $tax->for_trip }}</td>
                          <td class="text-success">{{ $tax->tax_NTA }}</td>
                          <td class="text-danger">{{ $tax->passenger_service_charge }}</td>
                          <td>{{ $tax->passenger_facilities_charge }}</td>
                          <td>{{ $tax->advance_passenger_info_fee }}</td>
                          <td>{{ $tax->station_service_charge }}</td>
                          <td>{{ $tax->total }}</td>
                          <td><button class="btn btn-primary btn-sm" onclick="document.forms[{{ $loop->iteration }}+{{$ones_fares->count()}}+5].submit();">X</button></td>
                        </tr>
                         </tbody>
                         </table>
                        </form>
                        @endforeach
                        @endif
                      
                    {{ $ones_fares->links() }}
                </div>
                </div>

                <form class="form-horizontal"  role="form" method="POST" action="{{ route('tax.add') }}">
                    {{ csrf_field() }}
                <div class="card-body" style="border-bottom: 1px solid #ccc;color: #7f7f7f;">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    
                    <div class="row col-md-12">

                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     <input type="hidden" name="from_user" value="{{ Auth::user()->id }}">


                    

                    <div class="col-sm-4">
                    <label for="career">Select Trip </label>
                    <div class="input-group">
                        @if(!$ones_trips->count())
                        you haven't saved any trip yet
                        @else
                            <select id="tax_trip_id" type="number" min="1" class="form-control" name="trip_id">
                                @foreach($ones_trips as $trip)
                                @if($trip->tax_id != null)
                            
                                @continue

                                @endif
                                @if(!$trip->fare)
                                <option value="{{$trip->id}}">{{$trip->departure_location}} to {{$trip->arrival_location}} with {{$trip->bus->bus_number}} leaving at {{$trip->departure_time}} 
                                </option>
                                
                                @else
                                <option value="{{$trip->id}}">{{$trip->departure_location}} to {{$trip->arrival_location}} with {{$trip->bus->bus_number}} leaving at {{$trip->departure_time}} - GH&#8373; {{$trip->fare->total_tax}}</option>

                                @endif
                                
                                @endforeach
                            </select>
                        @endif

                            <div class="input-group-append">
                                <span class="input-group-text"><i class="fas fa-suitcase"></i></span>
                            </div>
                            {{$ones_trips->links()}}
                    </div>
                    </div>
                
{{-------------------------------------------------}}
                    
                    <div class="col-sm-4">
                        
                            
                            <label for="occupation">Tax-NTA (<span style="font-size: 11px;">national transport association</span>)
                        </label>
                        <div class="input-group">
                            <input type="number" min="0" step="0.01" name="tax_NTA" class="form-control" onchange="this.value = parseFloat(this.value).toFixed(2);" placeholder="0.00">
                            
                            <div class="input-group-append">
                                <span class="input-group-text">GH&#8373;</span>
                            </div>
                        </div>
                        </div>

{{-------------------------------------------------}}
                        
                        <div class="col-sm-4">
                    
                        <label for="company"> Passenger Service Charges
                        </label>
                        <div class="input-group">
                            <input type="number" min="0" step="0.01" class="form-control" name="passenger_service_charge" onchange="this.value = parseFloat(this.value).toFixed(2);" placeholder="0.00">
                            <div class="input-group-append">
                                <span class="input-group-text">GH&#8373;</span>
                            </div>
                        </div>
                        </div>
                        <br>
{{-------------------------------------------------}}
                        <div class="col-sm-4">
                    
                        <label for="position"> Passenger Facilities Charges
                        </label>
                        <div class="input-group">
                        <input  type="number" min="0" step="0.01" class="form-control" name="passenger_facilities_charge" onchange="this.value = parseFloat(this.value).toFixed(2);" placeholder="0.00" required>
                            
                            <div class="input-group-append">
                                <span class="input-group-text">GH&#8373;</span>
                            </div>
                        </div>
                        </div>
{{-------------------------------------------------}}
                        <div class="col-sm-4">
                    
                        <label for="position"> Advance Passenger Information Fee
                        </label>
                        <div class="input-group">
                            <input type="number" min="0" step="0.01" name="advance_passenger_info_fee" class="form-control" onchange="this.value = parseFloat(this.value).toFixed(2);" placeholder="0.00">
                            <div class="input-group-append">
                                <span class="input-group-text">GH&#8373;</span>
                            </div>
                        </div>
                        </div>

                        <div class="col-sm-4">
                    
                        <label for="position"> Station Service Charge
                        </label>
                        <div class="input-group">
                            <input type="number" min="0" step="0.01" name="station_service_charge" class="form-control" onchange="this.value = parseFloat(this.value).toFixed(2);" placeholder="0.00">
                            <div class="input-group-append">
                                <span class="input-group-text">GH&#8373;</span>
                            </div>
                        </div>
                        </div>

                        <div class="col-sm-4">
                    
                        <label for="position"> Total Tax
                        </label>
                        <div class="input-group">
                            <input type="number" min="0" step="0.01" name="total" class="form-control" onchange="this.value = parseFloat(this.value).toFixed(2);" placeholder="0.00" readonly>
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
                        <button id="tax_btn_submit" class="btn btn-primary">Save</button>
                        
                    </center>
                </div>
                </form>
            </div>