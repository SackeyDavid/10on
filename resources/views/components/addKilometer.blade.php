
<div class="card card-default">
                <div class="card-header">
                    <ul class="list-inline">
                        <li class="list-inline-item">Add Kilometer</li>
                        <li class="list-inline-item float-right"><i style="cursor: pointer;font-size: 16px;" class="fas fa-chevron-down" onclick='
                        if (this.parentNode.parentNode.parentNode.children[1].style.display === "none") {
                            this.parentNode.parentNode.parentNode.children[1].style.display = "block";
                        } else {
                            this.parentNode.parentNode.parentNode.children[1].style.display = "none";
                        }
                        '></i></li>
                    </ul> 
                    
                    <div style="display: none;">
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col" class="text-warning">From</th>
                          <th scope="col" class="text-success">To</th>
                          <th scope="col" class="text-danger">Via</th>
                          <th scope="col">kilometers</th>
                          <th scope="col">duration using automobile</th>
                          <th scope="col">Action</th>
                        </tr>
                      </thead>
                     
                </table>
                        @if (!$kilometers->count())
                        There are no kilometers saved
                        @else
                        @foreach ($kilometers as $kilometer)
                        <form id="formq_{{$kilometer->id}}" method="POST" action="{{route('kilometer.delete', ['id' =>$kilometer->id, 'for_trip' => $kilometer->for_trip])}}">
                            {{ csrf_field() }} 
                        <table class="table">
                        <tbody>   
                        <tr>
                          <th scope="row">{{ $loop->iteration }}</th>
                          <td class="text-warning">{{ $kilometer->from }}</td>
                          <td class="text-success">{{ $kilometer->to }}</td>
                          <td class="text-danger">{{ $kilometer->via }}</td>
                          <td>{{ $kilometer->kilometers }}</td>
                          <td>{{ $kilometer->duration_via_automobile }}</td>
                          <td><button class="btn btn-danger btn-sm" onclick="document.forms[{{ $loop->iteration }}+2].submit();">X</button></td>
                        </tr>
                         </tbody>
                         </table>
                        </form>
                        @endforeach
                        @endif
                      
                    {{ $kilometers->links() }}
                    </div>
                   
                </div>

                
                <div class="card-body">
                    
                    {{ csrf_field() }}
                    <div class="row col-md-12">

                     
                     

                    @if(!$trips_without_kilometers->count() || !$kilometers)
                    no trips without kilometers
                    @else
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col" class="text-warning">From</th>
                          <th scope="col" class="text-success">To</th>
                          <th scope="col" class="text-danger">Via</th>
                          <th scope="col">Kilometers</th>
                          <th scope="col">Duration using Car</th>
                          <th scope="col" class="text-primary"><i class="fas fa-cogs"></i> Action </th>
                        </tr>
                      </thead>
                    </table>
                      
                        @foreach($trips_without_kilometers as $trip)
                        
                        <form id="form_{{$trip->id}}" method="POST" action="{{route('kilometer.add', [$trip->id])}}">
                            {{ csrf_field() }}

                         <table class="table table-striped">
                         <tbody>

                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" name="from_user" value="{{ Auth::user()->id }}">
                        <!-- <input name="_method" type="hidden" value="PUT"> -->
                        <input type="hidden" name="from" value="{{ $trip->departure_location }}">
                        <input type="hidden" name="to" value="{{ $trip->arrival_location }}">
                        <input type="hidden" name="via" value="{{ $trip->via }}">
                        <tr>
                          <th scope="row">{{ $loop->iteration }}</th>
                          <td class="text-warning">{{ $trip->departure_location }}</td>
                          <td class="text-success">{{ $trip->arrival_location }}</td>
                          <td class="text-danger">{{ $trip->via }}</td>
                          <td><div class="input-group"><input type="number" min="0" name="kilometers" style="border: none; border-bottom: 1px solid #000;" class="form-control" value="0" required><div class="input-group-append"><span class="input-group-text">km</span></div></div></td>
                          <td>
                            <div class="input-group"><input type="number" min="0" style="border: none; border-bottom: 1px solid #000;" name="duration_via_automobile_hrs"  value="0" class="form-control" required>
                                <div class="input-group-append"><span class="input-group-text">hr(s)</span></div><input type="number" min="0" style="border: none; border-bottom: 1px solid #000;" name="duration_via_automobile_mins" value="0" class="form-control" required>
                                <div class="input-group-append"><span class="input-group-text">min(s)</span></div>
                            </div>
                          </td>
                          <td><button onclick="document.forms[{{ $loop->iteration }}+{{$kilometers->count()}}+2].submit();" class="btn btn-primary">Save</button></td>
                        </tr>

                        </tbody>
                        </table>
                        </form>
                        
                        @endforeach
                        
                      {{ $trips_without_kilometers->links() }}
                    @endif
                
            </div>
            </div>
                <div class="card-footer">                    
                    <ul class="list-inline">
                        @if(!$trips_without_kilometers->count() || !$trips->count())
                        no trips without kilometers
                        @else
                        <li class="list-inline-item">{{ $trips_without_kilometers->count() }} trips </li>
                        <li class="list-inline-item float-right">{{ $trips_without_kilometers->count() }} / {{ $trips->count() }}</li>
                        @endif
                    </ul>
                </div>
        
               
            </div>
