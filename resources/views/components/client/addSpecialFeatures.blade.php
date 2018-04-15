<div class="card card-default">
                <div class="card-header">Add Special Feature</div>

                <form class="form-horizontal"  role="form" method="POST" action="{{ route('special.add') }}">
                
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


                    @if (!$buses->count())
                         <span style="color: #ff3345;">no bus saved, add a bus first</span>
                @else
                    <div class="col-sm-4">
                    <label for="career">Bus </label>
                    <div class="input-group">
                        
                        
                            
                            <select type="text" name="bus_number" class="form-control">
                                @foreach($buses as $bus)
                                <option value="{{ $bus->bus_number }}">{{ $bus->bus_number }}</option>
                                @endforeach
                            </select>
                            
                        
                        {{ $buses->links() }}
                    </div>
                    </div>
                
{{-------------------------------------------------}}
                    
                    <div class="col-sm-4">
                        
                            
                            <label for="occupation">Fuel
                        </label>
                        <div class="input-group">
                            
                            <select id="section" type="text" class="form-control" name="fuel"  required>
                                <option>Diesel</option>
                                <option>Gasoline</option>
                                <option>Compressed Natural Gas</option>
                                <option>Hybrid drive</option>
                                <option>Electricity</option>
                             </select> 
                            
                            <div class="input-group-append">
                                <span class="input-group-text"></span>
                            </div>
                        </div>
                        </div>
{{-------------------------------------------------}}
                        
                        <div class="col-sm-4">
                    
                        <label for="company"> Articulation
                        </label>
                        <div class="input-group">
                        <select id="section" type="text" class="form-control" name="articulation"  required>
                            <option>No articulation</option>
                            <option>Single articulation</option>
                            <option>Double articulation</option>
                            <option>Triple articulation</option>
                            <option>Multipled articulation</option>
                        </select>
                            
                        </div>
                        </div>
                        
{{-------------------------------------------------}}
                        
                        <div class="col-sm-4">
                    
                        <label for="company"> Decker
                        </label>
                        <div class="input-group">
                        <select id="section" type="text" class="form-control" name="decker"  required>
                            <option>No decker</option>
                            <option>Double decker</option>
                            <option>Multipled decker</option>
                        </select>
                           
                        </div>
                        </div>
                        <br>


{{-------------------------------------------------}}
                        
                        <div class="col-sm-4">
                    
                        <label for="company"> Television
                        </label>
                        <div class="input-group">
                            <input type="checkbox" class="form-control" name="television" value="yes">
                            <!-- <div class="input-group-addon">
                                <span class="fa fa-" id="add-more-program"></span>
                            </div> -->
                        </div>
                        </div>
                        <br>
{{-------------------------------------------------}}
                        <div class="col-sm-4">
                    
                        <label for="position"> WiFi
                        </label>
                        <div class="input-group">
                            <input type="checkbox" name="wifi" class="form-control" value="yes">
                            <!-- <div class="input-group-addon">
                                <span class="fa fa-"></span>
                            </div> -->
                        </div>
                        </div>
{{-------------------------------------------------}}
                        
                        <div class="col-sm-4">
                    
                        <label for="company"> Air Condition
                        </label>
                        <div class="input-group">
                            <input type="checkbox" class="form-control" name="ac" id="" value="yes">
                            <!-- <div class="input-group-addon">
                                <span class="fa fa-" id="add-more-program"></span>
                            </div> -->
                        </div>
                        </div>
                        <br>
{{-------------------------------------------------}}
                        
                        <div class="col-sm-4">
                    
                        <label for="company"> Wheel Lift
                        </label>
                        <div class="input-group">
                            <input type="checkbox" class="form-control" name="wheel_lift"  value="yes">
                            <!-- <div class="input-group-addon">
                                <span class="fa fa-" id="add-more-program"></span>
                            </div> -->
                        </div>
                        </div>
                        <br>
                        @endif
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