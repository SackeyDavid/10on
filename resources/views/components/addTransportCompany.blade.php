    <script src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript">
        
        // $("#btn-save").click(function(e) {
        //         var name = $("#name").val();
        //         var photo = $("#photo").val();
        //         var token = $("#token").val();
                
        //         $.ajax({
        //             type : 'POST',
        //             data : "name=" + name + "&photo=" + photo + "&_token" + token,
        //             url  : "{{ route('transport.company.add') }}",
        //             success:function(data) {
        //                 alert('welcome');
        //                 console.log(data);
        //             }
        //         });
        //         e.preventDefault();
        //     });
        // //  alert('welcome');
        // $('#addTransportCompany').on('submit', function(event){
        //     event.preventDefault();
        //     var form_data = $(this).serialize();
        //     $.ajax({
        //             method : "POST",
        //             data : form_data,
        //             dataType : "json",
        //             url  : "{{ route('transport.company.add') }}",
        //             success:function(data) {
        //                 if(data.error.length > 0)
        //                 {

        //                 }
        //                 else
        //                 {

        //                 }
        //             }
        //         });
        // });
    </script>
    @if(Session::has('msg'))
    <div class="alert alert-info" >
    <a href="#" data-dismiss="alert" class="close">&times;</a>
    <p class=""><center> {{ Session::get('msg') }}</center></p>
    </div>
    @endif
<div class="card card-default">
                <div class="card-header">Add Transport Company</div>
                <form class="form-horizontal" method="post" action="{{ route('transport.company.add') }}" enctype="multipart/form-data">
                <div class="card-body">
                    
                    {{ csrf_field() }}
                    <div class="row col-md-12">

                     <input type="hidden" id="token" name="_token" value="{{ csrf_token() }}">
                     <input type="hidden" name="from_developer" value="{{ Auth::user()->id }}">


                    

                    <div class="col-sm-4">
                        <label for="occupation">Name
                        </label>
                        <div class="input-group">
                            <input type="text" name="name" class="form-control">
                            
                            <div class="input-group-append">
                                <span class="input-group-text"></span>
                            </div>
                        </div>
                        </div>
                

                    
                    <div class="col-sm-4">
                        
                            
                        <label for="occupation">Logo
                        </label>
                        <div class="input-group">
                            <input type="file" name="photo" class="form-control">
                            
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
                        <button type="submit" id="btn-save" class="btn btn-primary">Save</button>
                        
                    </center>
                </div>
                </form>
            </div>