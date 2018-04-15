@if (!$transport_companies->count())
    There are no transport companies
    @else
<div class="card card-default">
                <div class="card-header">Add Client</div>

                <form class="form-horizontal" method="post" action="{{ route('client.add') }}">
                <div class="card-body">
                    
                    {{ csrf_field() }}
                    <div class="row col-md-12">

                     <input type="hidden" name="_token" value="{{ csrf_token() }}">
                     <input type="hidden" name="from_user" value="{{ Auth::user()->id }}">


                    <div class="col-sm-4">
                        
                            
                            <label for="occupation">Transport Company
                        </label>
                        <div class="input-group">
                            <select type="text" name="for_transport_company" class="form-control">
                            @foreach ($transport_companies as $transport_company)
                            <option value="{{ $transport_company->id }}">{{ $transport_company->name }}</option>
                            @endforeach

                            </select>
                            {{ $transport_companies->links() }}
                        </div>
                        </div>

                    
                

                    
                    <div class="col-sm-4">
                        
                            
                            <label for="occupation">User Name
                        </label>
                        <div class="input-group">
                            <input type="text" name="username" class="form-control">
                            
                            <div class="input-group-append">
                                <span class="input-group-text"></span>
                            </div>
                        </div>
                        </div>

                    <div class="col-sm-4">
                        
                            
                            <label for="occupation">Email
                        </label>
                        <div class="input-group">
                            <input type="email" name="email" class="form-control">
                            
                            <div class="input-group-append">
                                <span class="input-group-text"></span>
                            </div>
                        </div>
                        </div>

                    <div class="col-sm-4">
                        <label for="occupation">Super-admin
                        </label>
                        <div class="input-group">
                        <input type="checkbox" name="super_admin" class="form-control" value="yes">
                            
                            <!-- <div class="input-group-append">
                                <span class="input-group-text">@brand</span>
                            </div> -->
                        </div>
                        </div>
                    
                    

                    
                    <div class="col-sm-4">
                        
                            
                            <label for="occupation"><!--Password-->
                        </label>
                        <div class="input-group">
                            <input type="hidden" name="password" class="form-control">
                            
                            <!-- <div class="input-group-append">
                                <span class="input-group-text"></span>
                            </div> -->
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
@endif