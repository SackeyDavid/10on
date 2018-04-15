  <div class="card card-default">
                <div class="card-header">Add Destination</div>

                <form class="form-horizontal"  role="form" method="POST" action="{{ route('station.add') }}">
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
                    <label for="career">Station Name </label>
                    <div class="input-group">
                            <input placeholder="e.g. Koforidua" type="text" class="form-control" name="name"  required>
                            
                            <div class="input-group-append">
                                <span class="input-group-text"></span>
                            </div>
                    </div>
                    </div>
                
{{-------------------------------------------------}}
                    
                    <div class="col-sm-4">
                        
                            
                            <label for="capacity">Abbreviation (3 cap letters)
                        </label>
                        <div class="input-group">
                            <input placeholder="e.g. KFD" type="text" name="abbreviation" class="form-control">
                            
                            <div class="input-group-addon">
                                <span class="fa fa-"></span>
                            </div>
                        </div>
                        </div>

{{-------------------------------------------------}}
                        
                        <div class="col-sm-4">
                    
                        <label for="company"> Town / City
                        </label>
                        <div class="input-group">
                            <input type="text" placeholder="e.g. Koforidua" class="form-control" name="town_or_city">
                            
                        </div>
                        </div>
                        <br>
{{-------------------------------------------------}}
                        <div class="col-sm-4">
                    
                        <label for="position"> Region
                        </label>
                        <div class="input-group">
                            <input placeholder="eg. Eastern Region" id="section" type="text" class="form-control" name="region">
                            
                        
                            <div class="input-group-addon">
                                <span class="fa fa-"></span>
                            </div>
                        </div>
                        </div>

                        </div>
                </div>

                <div class="card-footer">
                    <center>
                        <button type="submit" class="btn btn-primary">Save</button>
                        
                    </center>
                </div>
            </form>
            </div>