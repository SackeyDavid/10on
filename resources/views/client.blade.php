@extends('layouts.client-app')

@section('content')
<div class="col-md-12">

    <div class="row">
        <div class="col-md-2" style="">
            <ul class="list-unstyled" style="padding: 15%;">
                <li><a href="#"> Trips : </a> <span>{{ $ones_trips->count() }}</span></li>
                <li><a href="#">Buses : </a><span> {{ $buses->count() }}</span> </li>
                <li><a href="#">Special Features : </a><span>{{ $ones_special_features->count() }}</span></li>
                <li><a href="#">Fares : </a><span>{{ $ones_fares->count() }}</span></li>
                <li><a href="#">Stations : </a><span>{{ $ones_stations->count() }}</span></li>
            </ul>
        </div>

        <div class="col-md-8">
             @if(Session::has('msg'))
            <div class="alert alert-info" >
            <a href="#" data-dismiss="alert" class="close">&times;</a>
            <p class=""><center> {{ Session::get('msg') }}</center></p>
            </div>
            @endif
            
            @if ($buses->count() && $fares->count() && $special_features->count() && $stations->count() && !$trips->count())
            
            <br>
            @component('components.client.addTrip')
            @endcomponent

            <br>
            @component('components.client.addBus')
            @endcomponent

            <br>
            @component('components.client.addSpecialFeatures')
            @endcomponent

            <br>
            @component('components.client.addFare')
            @endcomponent

            <br>
            @component('components.client.addStation')
            @endcomponent


            @elseif ($buses->count() && $special_features->count() && $stations->count() && !$fares->count() && !$trips->count())
            @if ($stations->count() >= 2)
            <br>
            @component('components.client.addFare')
            @endcomponent

            @else
            <br>
            @component('components.client.addDestinationStation')
            @endcomponent 

            <br>
            @component('components.client.addFare')
            @endcomponent

            <br>
            @component('components.client.addTrip')
            @endcomponent

            <br>
            @component('components.client.addBus')
            @endcomponent

            <br>
            @component('components.client.addSpecialFeatures')
            @endcomponent


            @endif                    
            

            @elseif ($special_features->count() && $buses->count() && !$stations->count() &&  !$fares->count() &&  !$stations->count() && !$trips->count())
            
            <br>
            @component('components.client.addStation')
            @endcomponent
            <br>
            @component('components.client.addTrip')
            @endcomponent

            <br>
            @component('components.client.addBus')
            @endcomponent

            <br>
            @component('components.client.addSpecialFeatures')
            @endcomponent

            <br>
            @component('components.client.addFare')
            @endcomponent
         

            @elseif ($buses->count() && !$fares->count() && !$special_features->count() && !$stations->count() && !$trips->count())
            <br>
            @component('components.client.addSpecialFeatures')
            @endcomponent


            @elseif (!$buses->count() && !$ones_fares->count() && !$ones_special_features->count() && !$ones_stations->count() && !$ones_trips->count())
            <div class="alert alert-success">
                 <a href="#" data-dismiss="alert" class="close">&times;</a>
                 <p class=""><center>Welcome {{ Auth::user()->username }}! <br>To begin posting your trips, you must first add at least one bus. You may use stations already provided for your trips or add your own stations if your stations are not listed. Fares give additional information about your trip costs, and special features give more information about a bus. <br> This is to provide travelers with pertinent information about the trip. THIS ORDER IS REALLY IMPORTANT</center></p>
            </div>
            <br>
            @component('components.client.addBus')
            @endcomponent

           

            @else
            <br>
            @component('components.client.addTrip')
            @endcomponent
            <br>
            @component('components.client.addFare')
            @endcomponent

            <br>
            @component('components.client.addTax')
            @endcomponent

            <br>
            @component('components.client.addStation')
            @endcomponent         
            
            <br>
            @component('components.client.addBus')
            @endcomponent

            <br>
            @component('components.client.addSpecialFeatures')
            @endcomponent

                        


            @endif

           
          
            
            
        </div>

        <div class="col-md-2" style="">
            <ul class="list-unstyled" style="padding: 15%;">
                <li>Admin attributes</li>
                
            </ul>
        </div>
    </div>
</div>
@endsection
