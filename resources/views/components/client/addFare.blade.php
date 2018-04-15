<link rel="stylesheet" type="text/css" href="{{ asset('css/fontawesome-all.css') }}">
<div class="card card-default">
                <div class="card-header">Add Fare</div>

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
                    <label for="career">Start <i class="fas fa-arrow-right"></i> Destination </label>
                    <div class="input-group">
                        @if(!$stations->count())
                        <span style="color: #ff3345;">no stations saved</span>
                        @else

                            <select type="text" class="form-control" name="start_point"  required>
                            @foreach($stations as $station)
                            <option value="{{ $station->name }}">{{ $station->name }}</option>
                            @endforeach
                            </select>
                         
                            <div class="input-group-append"><span class="input-group-text">to</span></div>
                            <select type="text" class="form-control" name="destination"  required> 
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
                        
                            
                            <label for="occupation">Road fare
                        </label>
                        <div class="input-group">
                            <input type="text" name="road_fare" class="form-control" value="{{ old('occupation') }}">
                            
                            <div class="input-group-addon">
                                <span class="fa fa-"></span>
                            </div>
                        </div>
                        </div>

{{-------------------------------------------------}}
                        
                        <div class="col-sm-3">
                    
                        <label for="company"> Carrier-imposed Charges
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="carrier_imposed_charges">
                            <div class="input-group-addon">
                                <span class="fa fa-" id="add-more-program"></span>
                            </div>
                        </div>
                        </div>
                        <br>
{{-------------------------------------------------}}
                        <div class="col-sm-5">
                    
                        <label for="position"> Total tax
                        </label>
                        <div class="input-group">
                        <input id="section" type="text" class="form-control" name="total_tax" required>
                            
                            <div class="input-group-append">
                                <span class="input-group-text">GH&#8373;</span>
                            </div>
                        </div>
                        </div>
{{-------------------------------------------------}}
                        <div class="col-sm-5">
                    
                        <label for="position"> Total fare per passenger
                        </label>
                        <div class="input-group">
                            <input type="text" name="total_per_passenger" class="form-control">
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
                        <button type="submit" class="btn btn-primary">Save</button>
                        
                    </center>
                </div>
                </form>
            </div>