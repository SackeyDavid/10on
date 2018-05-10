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
<span id="select-oneway-date" class="btn btn-lg" style="width: 100%;font-weight: 600; height: 9vh; background-color: #D3D3D3;"><div class="clearfix">
    @php
    echo '<span style="font-size: 14px;" class="float-left">DEPARTURE</span><br>';
    echo  '<ul class="list-inline" style="font-size: 12px;margin-top: -9%;"><li id="ow_day"><span style="font-size: 38px;">' . date('d') . '</span></li><li><ul class="list-unstyled"><li id="ow_mnt_year"><span>' . date('M Y') . '</span></li><li style="margin-left: -65%;" id="week_day"><span>&nbsp;&nbsp;' . date('D') . '</span></li></ul></li></ul>';
    @endphp
    
</div></span>
<br>
<br>
<input type="text" id="ow_arrival_station" name="ow_arrival_location"  class="form-control search-trip-bar" placeholder="To" required>

<style type="text/css">
   #arrival-tabs .nav-tabs{
  background-color:#fff;
}
   #arrival-tabs  .tab-content{
    background-color:#B22222;
    color:#fff;
    padding:5px
}
    #arrival-tabs .nav-item {
        margin-top: 1%;
    }
   #arrival-tabs .nav-tabs > li > a{
  border: medium none;
}
   #arrival-tabs .nav-tabs > li > a:hover{
  background-color: #E61F1F !important;
    border: medium none;
    border-radius: 5px;
    color:#fff;
}
    #arrival-tabs .nav-tabs .active a {
    background-color: #fff;

    }

    .top-right-search {
        position: absolute;
        right: 20%;
        top: 20%;
    }

</style>

<div class="modal" id="ow_search_results" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="padding: 1%;">
        <div class="col-md-12" style="padding: 1%;">
                <div>
                    <ul class="list-inline" style="padding-bottom: 0%;">
                        <li><span class="title-center" style="margin-top: -3%;left: 0%;font-weight: 900;">
            <div class="custom-templates">
            <input style="border: none; box-shadow: none; font-size: 20px; min-width: 17em;" type="text" id="ow_search_arrival_station" name="ow_arrival_station" class="typeahead form-control" height="50px" width="90%" placeholder="Arrival Station" autofocus>
            </div>

            <!-- <input  type="text" id="search_arrival_station" name="ow_arrival_station"  autocomplete="off" class="form-control" placeholder="" > -->
        
                        </span></li>
                        <li><span id="oneway-search" class="top-right-search btn btn-sm" style="background-color: #fff;color: #fff;"><i class="fas fa-search"></i> search</span></li>
                        <li><span class="top-left1 links"><a href="#" data-dismiss="modal"> <i class="fas fa-times" style="font-size: 15px;"></i> </a></span></li>
                    </ul> 
                </div>

            </div>  
        
        
      </div>
      <div class="modal-body" id="oneway-results-modal-body" style="padding: 0%;background-color: #fff;">
        <div id="arrival-tabs" class="tab-heading" style="margin-top: 0%;margin-bottom: 0%;height: 6vh; background-color: #ff3333;"> 
                    <!-- Nav tabs -->

                    <ul class="nav nav-tabs nav-justified" id="myTab" role="tablist" style="font-size: 12px;">
                      
                      <li class="nav-item">
                        <a href="#previousDay" id="previous_day_tab" data-toggle="tab"><span style="color: #fff;"></span></a>
                      </li>
                      <li class="nav-item active" style="margin-bottom: 0%;">
                        <a href="#selectedDay" id="selected_day_tab" data-toggle="tab" style="border-color: #ff3333;padding-left: 0%; padding-right: 0%;"><span style="color: #fff;"></span> &nbsp;&nbsp;<i class="fas fa-calendar" style="color: #fff;"></i></a>
                      </li>
                      <li class="nav-item"> 
                        <a href="#nextDay" id="next_day_tab" data-toggle="tab"><span style="color: #fff;"></span></a>
                      </li>
                    </ul>
                    
                    

            </div>
<div class="tab-content" style="padding-top: 2%;">

        <div class="card-body tab-pane" id="previousDay" style="background-color: #fff;margin: 1%;">
            <div class="col-sm-4">
                asdlkf
            </div>
            <div class="col-sm-8">
                alfklsa
            </div>

        </div>

        <div class="well tab-pane results active" id="selectedDay" style="margin: 1%;background-color: #fff; padding: 1%;border: 1px solid #fafafa;border-radius: 3px;font-family: Arial">
            
            
            


            
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
                <center><span style="font-size: 16px;height: inherit; font-weight: 500;color: #fff;"><strong>Continue</strong></span></center>
            </div>
        </div>
    </div>
</div>


</div>