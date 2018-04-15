
<div class="card card-default">
                <div class="card-header">
                    <ul class="list-inline">
                        <li class="list-inline-item">Add Kilometer</li>
                        <li class="list-inline-item float-right"><i style="font-size: 16px;" class="fas fa-chevron-down" onclick='
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
                          <th scope="col">from</th>
                          <th scope="col">to</th>
                          <th scope="col">via</th>
                          <th scope="col">kilometers</th>
                          <th scope="col">duration using automobile</th>
                        </tr>
                      </thead>
                      <tbody>
                        @if (!$kilometers->count())
                        There are no kilometers saved
                        @else
                        @foreach ($kilometers as $kilometer)
                            
                        <tr>
                          <th scope="row">$loop->iteration</th>
                          <td>{{ $kilometer->from }}</td>
                          <td>{{ $kilometer->to }}</td>
                          <td>{{ $kilometer->via }}</td>
                          <td>{{ $kilometer->kilometers }}</td>
                          <td>{{ $kilometer->duration_via_automobile }}</td>
                        </tr>
                        @endforeach
                        @endif
                      </tbody>
                    </table>
                    {{ $kilometers->links() }}
                    </div>
                   
                </div>

                <form class="form-horizontal" method="post" action="{{ route('client.add') }}">
                <div class="card-body">
                    
                    {{ csrf_field() }}
                    <div class="row col-md-12">

                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     <input type="hidden" name="from_user" value="{{ Auth::user()->id }}">

                    @if(!$trips_without_kilometers->count())
                    no trips without kilometers
                    @else
                    <table class="table table-striped">
                      <thead>
                        <tr>
                          <th scope="col">#</th>
                          <th scope="col">From</th>
                          <th scope="col">To</th>
                          <th scope="col">Via</th>
                          <th scope="col">Kilometers</th>
                          <th scope="col">Duration using Car</th>
                          <th scope="col"><i class="fas fa-cogs"></i> Action </th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($trips_without_kilometers as $trip)
                        <tr>
                          <th scope="row">$loop->iteration</th>
                          <td>{{ $trip->departure_location }}</td>
                          <td>{{ $trip->arrival_location }}</td>
                          <td>{{ $trip->via }}</td>
                          <td><input type="text" name="kilometers" style="border: none; border-bottom: 1px solid #000;" class="form-control"></td>
                          <td><input type="text" style="border: none; border-bottom: 1px solid #000;" name="duration_via_automobile" class="form-control"></td>
                          <td><button type="submit" class="btn btn-primary">Save</button></td>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    @endif
                <div class="card-footer">                    
                    <ul class="list-inline">
                        @if(!$trips_without_kilometers->count() || !$trips->count())
                        @else
                        <li>{{ $trips_without_kilometers->count() }} trips remaining</li>
                        <li class="pull-right">{{ $trips_without_kilometers->count() }} / {{ $trips->count() }}</li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
                </form>
            </div>
