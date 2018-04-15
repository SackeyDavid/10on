  <div class="card card-default">
                <div class="card-header">Add Bus</div>

                <form class="form-horizontal"  role="form" method="POST" action="{{ route('bus.add') }}">
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
                    <label for="career">Bus Number </label>
                    <div class="input-group">
                            <input placeholder="alphabets on number plate" type="text" class="form-control" name="bus_number"  required>
                            
                            <div class="input-group-append">
                                <span class="input-group-text"></span>
                            </div>
                    </div>
                    </div>
                
{{-------------------------------------------------}}
                    
                    <div class="col-sm-4">
                        
                            
                            <label for="capacity">Number of passenger seats
                        </label>
                        <div class="input-group">
                            <input placeholder="eg. 50" type="text" name="capacity" class="form-control">
                            
                            <div class="input-group-addon">
                                <span class="fa fa-"></span>
                            </div>
                        </div>
                        </div>

{{-------------------------------------------------}}
                        
                        <div class="col-sm-4">
                    
                        <label for="company"> Photo
                        </label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="photo">
                            
                        </div>
                        </div>
                        <br>
{{-------------------------------------------------}}
                        <div class="col-sm-4">
                    
                        <label for="position"> Brand Name
                        </label>
                        <div class="input-group">
                            <input placeholder="eg. Yutong" id="section" type="text" class="form-control" name="brand_name">
                            
                        
                            <div class="input-group-addon">
                                <span class="fa fa-"></span>
                            </div>
                        </div>
                        </div>
{{-------------------------------------------------}}
                        <div class="col-sm-4">
                    
                        <label for="position"> Driver's Name
                        </label>
                        <div class="input-group">
                            <input placeholder="eg. Mr. Dennis Sarpong" type="text" name="driver" class="form-control">
                            <div class="input-group-addon">
                                <span class="fa fa-"></span>
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