<!-- One Way trips -->
<div class="well tab-pane" id="onewayTab">
    <form role="form" method="GET"  action="" class="navbar-form">

<input type="text" id="search-input" name="departure_location" data-provide="typeahead"  autocomplete="off" class="typeahead form-control search-trip-bar" placeholder="Departure Station">

<br>
<input type="text" id="search-input" name="arrival_location" data-provide="typeahead"  autocomplete="off" class="typeahead form-control search-trip-bar" placeholder="Arrival Station">

<br>
<a href="#selectDates2" class="btn btn-lg" data-toggle="modal" style="width: 100%;font-weight: 600; height: 8vh; background-color: #D3D3D3;">Select dates</a>
    
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
                    <input id="from2" name="departure_date" type="text" class="form-control">
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

</form>
</div>