<!-- One Way trips -->
<div class="well tab-pane active" id="onewayTab">
    
<input type="text" id="ow_departure_station" name="ow_departure_station"  class="form-control search-trip-bar" placeholder="From" required>

<br>

<div class="modal" id="ow_searchstation" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding: 1%;">
        <div class="col-md-12" style="padding: 1%;">
                <div>
                    <ul class="list-inline" style="padding-bottom: 0%;">
                        <li><span class="title-center" style="margin-top: -3%;left: 40%;font-weight: 900;left: 38%;">Select station</span></li>
                        <li><span class="top-left1 links"><a href="#" data-dismiss="modal"> <i class="fas fa-times" style="font-size: 15px;"></i> </a></span></li>
                    </ul> 
                </div>

            </div>  
        
        
      </div>
      <div class="modal-body" style="padding: 0%;">
        
        <div class="custom-templates" style="margin-left: 0%; width:100%; padding: 0%;">
            <input style="border: none; box-shadow: none; border-bottom: 1px solid #ccc; border-top: 1px solid #ccc;min-width: 17em;" type="text" id="ow_search_departure_station"  autocomplete="off" class="typeahead form-control search-trip-bar" placeholder="Departure Station">
        </div>
        <div class="col-md-12" style="width: 100%;">




        </div>

            
       
      </div>
      <div id="ow_departure-submit" class="modal-footer btn btn-lg" style="border-radius: 0;background-color: #ccc;">
                <center><span style="font-size: 18px;height: inherit; font-weight: 500;color: #fff;"><strong>continue</strong></span></center>
      </div>
    </div>
  </div>
</div>


<center>
<ul class="list-inline">
    <li>
<button id="ow_passenger_num_minus" type="button" class="passenger_num_buttons" style="border-radius: 50%;"><i class="fas fa-minus"></i></button>
</li>
    <li style="width: 60%;">
        <input type="text" id="ow_passenger_num" name="ow_passenger_num" class="form-control" value="1" style="height: 4vh;font-size: 18px;text-align: center;color: #000;padding: 0%;" readonly required><span id="ow_passenger_label" style="font-size: 15px;color: #000;">passenger</span>
    </li>

    <li>
<button id="ow_passenger_num_plus" type="button" class="passenger_num_buttons" style="border-radius: 50%;"><i class="fas fa-plus"></i></button>
</li>
</ul>
</center>

<input type="hidden" id="ow_date" name="ow_date" value="">

<br>
<a href="#selectDates2" class="btn btn-lg" data-toggle="modal" style="width: 100%;font-weight: 600; height: 8vh; background-color: #D3D3D3;"><div class="clearfix">
    @php
    echo '<span style="font-size: 14px;" class="float-left">DEPARTURE</span><br>';
    echo  '<ul class="list-inline" style="font-size: 12px;margin-top: -9%;"><li id="ow_day"><span style="font-size: 38px;">' . date('d') . '</span></li><li><ul class="list-unstyled"><li id="ow_mnt_year"><span>' . date('M Y') . '</span></li><li style="margin-left: -65%;" id="week_day"><span>' . date('D') . '</span></li></ul></li></ul>';
    @endphp
    <br>
</div></a>
<br>
<br>
<input type="text" id="ow_arrival_station" name="ow_arrival_location"  class="form-control search-trip-bar" placeholder="To" required>

<div class="modal" id="ow_search_results" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding: 1%;">
        <div class="col-md-12" style="padding: 1%;">
                <div>
                    <ul class="list-inline" style="padding-bottom: 0%;">
                        <li><span class="title-center" style="margin-top: -3%;left: 0%;font-weight: 900;">
            <input style="border: none; box-shadow: none; font-size: 20px; min-width: 17em;" type="text" id="ow_search_arrival_station" name="ow_arrival_station" class="form-control" height="50px" width="90%" placeholder="Arrival Station" autofocus>

            <!-- <input  type="text" id="search_arrival_station" name="ow_arrival_station"  autocomplete="off" class="form-control" placeholder="" > -->
        
                        </span></li>
                        <li><span class="top-left1 links"><a href="#" data-dismiss="modal"> <i class="fas fa-times" style="font-size: 15px;"></i> </a></span></li>
                    </ul> 
                </div>

            </div>  
        
        
      </div>
      <div class="modal-body" style="padding: 0%;background-color: #f8f8f8;">
        <div class="tab-heading" style="margin-top: 0%;margin-bottom: 2%; background-color: #ff3345;"> 
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist">
                      
                      <li class="nav-item">
                        <a href="#previousDay" data-toggle="tab">Apr 22</a>
                      </li>
                      <li class="nav-item active">
                        <a href="#selectedDay" data-toggle="tab">Mon, Apr 23 &nbsp;&nbsp;<i class="fas fa-calendar"></i></a>
                      </li>
                      <li class="nav-item"> 
                        <a href="#nextDay" data-toggle="tab">Apr 24</a>
                      </li>
                    </ul>

                    

            </div>
<div class="tab-content">
        <div class="card-body tab-pane" id="previousDay" style="background-color: #fff;margin: 1%;">
            <div class="col-sm-4">
                asdlkf
            </div>
            <div class="col-sm-8">
                alfklsa
            </div>

        </div>

        <div class="well tab-pane results active" id="selectedDay" style="margin: 1%;background-color: #f8f8f8; padding: 1%;border: 1px solid #fafafa;border-radius: 3px;">
            
            
            <div class="card-body" style="padding: 1%;background-color: #fff;border-radius: 3px;">
            <ul class="list-inline" style="margin-bottom: 0%;">
            <li style="width: 30%"> 
                <ul class="list-inline">
                    <li>
               <ul class="list-unstyled">
                   <li><span style="font-size: 25px;">09:00</span></li>
                   <li>13:28</li>
               </ul>
                    </li>
                    <li style="font-size: 30px;"><b style="border-right: solid 1px #ccc;height: 150px;"></b></li>
                    
                </ul>
            </li>
            
            <li style="width: 40%"> 
               <ul class="list-unstyled">
                   <li><span style="color: #777;">N1 <span style="font-weight: 100;">|</span> 4h28m</span></li>
                   <li>Tudu</li>
                   <li>
                    <ul class="list-inline">
                    <li> Koforidua</li>
                    <li class="float-right">VIP</li>
                    </ul>
                   </li>
               </ul>
            </li>
            <li class="float-right" style="width: 20%;margin-top: 6%;margin-right: -6%;color: #ff3345;"> 
               <ul class="list-unstyled">
                   <li></li>
                   <li><span style="font-size: 11px;">GHS</span> <span style="font-size: 30px;">5</span></li>
               </ul>
            </li>
            </ul>
            <hr style="border-top: dotted 1px;margin-bottom: 1%;margin-top: 0%;color: #ccc;" />
            <span style="font-weight: 400; font-family: Corbel;color: #777;">4 seats left.</span>
            </div>


            
        </div>

        <div class="card-body tab-pane" id="nextDay" style="background-color: #fff;margin: 1%;">
            <div class="col-sm-4">
                asdlkf
            </div>
            <div class="col-sm-8">
                alfklsa
            </div>

        </div>

</div>
            
       
      </div>
      <!-- <div id="departure-submit" class="modal-footer btn btn-lg" style="border-radius: 0;background-color: #ccc;">
                <center><span style="font-size: 18px;height: inherit; font-weight: 500;color: #fff;"><strong>continue</strong></span></center>
      </div> -->
    </div>
  </div>
</div>

    
<div class="modal slide" id="selectDates2" tabindex="-1">
    <div class="modal-dialog" id="selectDates-dialog2">
        <div class="modal-content">
            <div class="modal-header" style="padding-bottom: 1%;">
            <div class="col-md-12">
                <div>
                    <ul class="list-inline" style="padding-bottom: 0%;">
                        <li><span class="top-center" style="margin-top: -5%;">Travel date</span></li>
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
                            <a href="#" data-toggle="tab">
                                Outbound<br>
                                <span style="font-size: 12px;color: #484848; opacity: 0.5;">Select your date</span>
                            </a>
                          </li id="selectDates-right-item">
                          
                        </ul>
                </div>
                <center>
                <div class="input-group input-daterange">
                    <input id="from2" name="departure_date" type="text" class="form-control" autofocus>
                </div>
                <!-- <input type="hidden" id="my_hidden_input"> -->
                </center>
                
            <div class="col-md-12" style="margin-top: 90%;">
                <ul class="list-inline" style="">
                <!-- <li><div id="trip-duration"> <span id="number" style="font-size: 32px;"></span></div></li>
                <li>
                <span>
                    <ul class="list-unstyled">
                    <li><span style="font-size: 12px;"> Trips duration</span></li>
                    <li><span style="font-size: 24px;">Days</span></li>
                    </ul>
                </span> -->
                <!-- </li> -->
                </ul>
            </div>
            </div>
            </div>
            <div id="resultsBtn2" class="modal-footer btn btn-lg" style="border-radius: 0;background-color: #ccc;">
                <center><span style="font-size: 16px;height: inherit; font-weight: 500;color: #fff;"><strong>See results</strong></span></center>
            </div>
        </div>
    </div>
</div>


</div>