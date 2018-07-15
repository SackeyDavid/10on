<div class="well tab-pane " id="returnTab">
 
<form method="GET"  action="{{ route('search.trips.return.find') }}" style="padding: 0%;">
  @csrf
<input type="text" id="departure_station" name="departure_location"  class="form-control search-trip-bar" placeholder="Departure Station" required>

<div class="modal" id="searchstation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding: 1%;">
        <div class="col-md-12" style="padding: 1%;">
                <div>
                    <ul class="list-inline" style="padding-bottom: 0%;">
                        <li><span class="title-center" style="margin-top: -3%;">Select departure station</span></li>
                        <li><span class="top-left1 links"><a href="#" data-dismiss="modal"> <i class="fas fa-times" style="font-size: 15px;"></i> </a></span></li>
                    </ul> 
                </div>

            </div>  
        
        
      </div>
      <div class="modal-body" style="padding: 0%;">
        
        <div class="custom-templates" style="margin-left: 0%; width:100%; padding: 0%;">
            <input style="border: none; box-shadow: none; border-bottom: 1px solid #ccc; border-top: 1px solid #ccc;min-width: 17em;" type="text" id="search_departure_station"  autocomplete="off" class="typeahead form-control search-trip-bar" placeholder="Departure Station">
        </div>
        <div class="col-md-12" style="width: 100%;">




        </div>

            
       
      </div>
      <div id="departure-submit" class="modal-footer btn btn-lg" style="border-radius: 0;background-color: #ccc;">
                <center><span style="font-size: 18px;height: inherit; font-weight: 500;color: #fff;"><strong>continue</strong></span></center>
      </div>
    </div>
  </div>
</div>

<br>
<input type="text" id="arrival_station" name="arrival_location" class="form-control search-trip-bar" placeholder="Arrival Station" required>

<div class="modal" id="search-arrival-station" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding: 1%;">
        <div class="col-md-12" style="padding: 1%;">
                <div>
                    <ul class="list-inline" style="padding-bottom: 0%;">
                        <li><span class="title-center" style="margin-top: -3%;">Select arrival station</span></li>
                        <li><span class="top-left1 links"><a href="#" data-dismiss="modal"> <i class="fas fa-times" style="font-size: 15px;"></i> </a></span></li>
                    </ul> 
                </div>

            </div>  
        
        
      </div>
      <div class="modal-body" style="padding: 0%;">
        
        <div class="custom-templates" style="margin-left: 0%; width:100%; padding: 0%;">
            <input style="border: none; box-shadow: none; border-bottom: 1px solid #ccc; border-top: 1px solid #ccc;min-width: 17em;" type="text" id="search_arrival_station"  autocomplete="off" class="typeahead form-control search-trip-bar" placeholder="Arrival Station">
        </div>
        <div class="col-md-12" style="width: 100%;">
           </div>

            
       
      </div>
      <div id="arrival-submit" class="modal-footer btn btn-lg" style="border-radius: 0;background-color: #ccc;">
                <center><span style="font-size: 18px;height: inherit; font-weight: 500;color: #fff;"><strong>continue</strong></span></center>
      </div>
    </div>
  </div>
</div>

<br>

<center>
<ul class="list-inline">
    <li>
<button id="passenger_num_minus" type="button" class="passenger_num_buttons" style="border-radius: 50%;"><i class="fas fa-minus"></i></button>
</li>
    <li style="width: 60%;">
        <input type="text" id="passenger_num" name="passenger_num" class="form-control" value="1" style="height: 4vh;font-size: 18px;text-align: center;color: #000;padding: 0%;" readonly required><span id="passenger_label" style="font-size: 15px;color: #000;">passenger</span>
    </li>

    <li>
<button id="passenger_num_plus" type="button" class="passenger_num_buttons" style="border-radius: 50%;"><i class="fas fa-plus"></i></button>
</li>
</ul>
</center>

<br>
<a href="#selectDates" class="" data-toggle="modal" style="width: 100%;font-weight: 600; height: 13vh; background-color: #D3D3D3;"><span id="" class="btn btn-lg" style="width: 100%;font-weight: 600; height: 12vh; background-color: #D3D3D3;"><div class="clearfix">
    @php
    echo '<span style="font-size: 14px;" class="float-left">DEPARTING</span><br>';
    echo  '<span class="float-left"><ul class="list-inline" style="font-size: 12px;margin-top: -15%;"><li id="ow_day"><span style="font-size: 38px;">' . date('d') . '</span></li><li><ul class="list-unstyled"><li id="ow_mnt_year"><span>' . date('M Y') . '</span></li><li style="margin-left: -65%;" id="week_day"><span>&nbsp;&nbsp;' . date('D') . '</span></li></ul></li></ul></span>';

    echo '<span style="font-size: 14px;margin-top: -8%;" class="float-right">RETURNING</span><br>';
    echo  '<span class="float-right"><ul class="list-inline" style="font-size: 12px;margin-top: -35%;"><li id="ow_day"><span style="font-size: 38px;">' . date('d') . '</span></li><li><ul class="list-unstyled"><li id="ow_mnt_year"><span>' . date('M Y') . '</span></li><li style="margin-left: -65%;" id="week_day"><span>&nbsp;&nbsp;' . date('D') . '</span></li></ul></li></ul></span>';
    @endphp
    
</div></span>
</a>
<br><br>
<div id="resultsBtn1" type="submit" class="modal-footer btn btn-lg" style="border-radius: 0;background-color: #ccc;width: 100%;">
    <center><span style="font-size: 16px;height: inherit; font-weight: 500;color: #fff;"><strong>See results<br></strong></span></center>
</div>
    
<div class="modal slide" id="selectDates" tabindex="-1">
    <div class="modal-dialog" id="selectDates-dialog">
        <div class="modal-content">
            <div class="modal-header" style="padding-bottom: 1%;">
            <div class="col-md-12">
                <div>
                    <ul class="list-inline" style="padding-bottom: 0%;">
                        <li><span class="top-center" style="margin-top: -5%;">Travel dates</span></li>
                        <li><span class="top-left links"><a href="#" data-dismiss="modal"> <i class="fas fa-arrow-left" style="font-size: 15px;"></i> </a></span></li>
                    </ul> 
                </div>

            </div>                                      
            </div>

            <div class="modal-body" id="select-dates-modal-body" style="margin-top: 1%; padding-left: 0%; padding-right: 0%;">
                
            

            <div class="col-md-12" style="margin-top: -4%; width: 100%;padding-left: 0%;padding-right: 0%;">
                <div class="tab-heading"> 
                        <!-- Nav tabs -->
                        
                        <ul class="nav nav-tabs nav-justified" id="my2ndTab" role="tablist">
                          
                          <li id="selectDates-left-item" class="nav-item">
                            <a href="#" id="depart_tab" data-toggle="tab" style="border-bottom: 4px solid #ff3345;padding: 5%;margin: 0%;border-radius: none;color: #000;font-size: 23px;"><span>Leaving</span>
                                <br>
                                <ul class="list-inline">
                               <li id="depart_day" style="border:none;font-size: 16px;color: #000;"><span></span> </li>
                               <li id="depart_month" style="border:none;">
                                
                                <span style="font-size: 12px;color: #484848; opacity: 0.5;">Select your date</span>
                               
                                </li> 
                            </ul>
                             </a>
                            
                            
                          </li id="selectDates-right-item">
                          <li class="nav-item">
                            <a href="#" data-toggle="tab" id="return_tab" style="padding: 5%;margin: 0%;border-radius: none;color: #000;font-size: 23px;"><span>Returning</span> <br>
                                <ul class="list-inline">
                               <li id="return_day" style="border:none;font-size: 16px;color: #000;"><span></span></li>
                               <li id="return_month" style="border:none;">
                                
                                <span style="font-size: 12px;color: #484848; opacity: 0.5;">Select your date</span>
                               
                                </li> 
                            </ul></a>
                          </li>
                          
                        </ul>
                </div>
                <center>
                <div class="input-group input-daterange">
                    <input id="from" name="departure_date" value="" type="text" class="form-control" autofocus required>
                    <div class="input-group-addon">to</div>
                    <input id="to" name="return_date" value="" type="text" class="form-control">
                </div>
                <!-- <input type="hidden" id="my_hidden_input"> -->
                </center>
                
            <div class="col-md-12" style="margin-top: 90%;">
                <ul class="list-inline" style="">
                <li>
                <span>
                    <ul class="list-unstyled">
                    
                    <li><span style="font-size: 18px;font-weight: 300">&nbsp;&nbsp; Trip duration:</span></li>
                    <li><span style="font-size: 24px;"></span></li>
                    </ul>
                </span>
                </li>
                <li><div id="trip-duration">&nbsp;&nbsp;&nbsp;

                 <span id="number" style="font-size: 22px;color: black;font-weight: 900"></span></div></li>
                </ul>
            </div>
            </div>
            </div>
            <div id="resultsBtn" type="submit" class="modal-footer btn btn-lg" style="border-radius: 0;background-color: #ccc;">
                <center><span style="font-size: 16px;height: inherit; font-weight: 500;color: #fff;"><strong>See results<br></strong></span></center>
            </div>
        </div>
    </div>
</div>
</form>

</div>
