<div class="card card-default">
                <div class="card-header">Add Tax</div>

                <div class="card-body" style="border-bottom: 1px solid #ccc;color: #7f7f7f;">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form class="form-horizontal"  role="form" method="POST" action="">
                    {{ csrf_field() }}
                    <div class="row col-md-12">

                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     <input type="hidden" name="from_user" value="{{ Auth::user()->id }}">


                    

                    <div class="col-sm-4">
                    <label for="career">From... To... </label>
                    <div class="input-group">
                            <input id="from" name="departure_date" type="text" class="form-control">
                            <div class="input-group-append"><span class="input-group-text">to</span></div>
                            <input id="to" name="return_date" type="text" class="form-control">
                            <div class="input-group-addon">
                                <span class="fa fa-user-o"></span>
                            </div>
                    </div>
                    </div>
                
{{-------------------------------------------------}}
                    
                    <div class="col-sm-4">
                        
                            
                            <label for="occupation">Tax-NTA
                        </label>
                        <div class="input-group">
                            <input type="text" name="occupation" class="form-control" value="{{ old('occupation') }}">
                            
                            <div class="input-group-addon">
                                <span class="fa fa-"></span>
                            </div>
                        </div>
                        </div>

{{-------------------------------------------------}}
                        
                        <div class="col-sm-4">
                    
                        <label for="company"> Passenger Service Charges
                        </label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="company" id="" value="{{ old('company') }}">
                            <div class="input-group-addon">
                                <span class="fa fa-" id="add-more-program"></span>
                            </div>
                        </div>
                        </div>
                        <br>
{{-------------------------------------------------}}
                        <div class="col-sm-4">
                    
                        <label for="position"> Passenger Facilities Charges
                        </label>
                        <div class="input-group">
                        <select id="section" type="text" class="form-control" name="section" value="{{ old('section') }}" style="height: 5vh;" required>
                            <option></option>
                            <option></option>
                            <option></option>
                        </select>
                            <div class="input-group-addon">
                                <span class="fa fa-"></span>
                            </div>
                        </div>
                        </div>
{{-------------------------------------------------}}
                        <div class="col-sm-4">
                    
                        <label for="position"> Advance Passenger Information Fee
                        </label>
                        <div class="input-group">
                            <input type="text" name="position" class="form-control" value="{{ old('position') }}">
                            <div class="input-group-addon">
                                <span class="fa fa-"></span>
                            </div>
                        </div>
                        </div>

                        <div class="col-sm-4">
                    
                        <label for="position"> Station Service Charge
                        </label>
                        <div class="input-group">
                            <input type="text" name="position" class="form-control" value="{{ old('position') }}">
                            <div class="input-group-addon">
                                <span class="fa fa-"></span>
                            </div>
                        </div>
                        </div>


                            <input type="hidden" name="total" class="form-control">


                        <br>





                        </div>

                        

                    </form>
 
                </div>

                <div class="card-footer">
                    <center>
                        <button type="submit" class="btn btn-primary">Save</button>
                        
                    </center>
                </div>
            </div>