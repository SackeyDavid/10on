<link rel="stylesheet" type="text/css" href="{{ asset('css/bootstrap.min.css') }}">
@if(!$receiver)
    No receiver of trip reminder
@else
    
<b>Hello {{ $receiver->first_name }},</b>
<p style="color: teal;font-size: 30px;">Your bus will be leaving in {{$days_left}}</p>
<p>You can check-in online when you are seated in the bus <a style="text-decoration: none;" href="{{route('bus.info')}}">http://localhost:8000/traveler/bus/</a> or by  clicking the button below</p>
<center><a href="{{route('bus.info')}}"><button class="btn btn-lg">Checki-in</button></a></center>
    @if(!$receiver->kilometers)
   
    @else
<span>Kilometers :    {{ $receiver->kilometers }}</span><br>
<span>Membership_number :    {{ $receiver->membership_number }}</span>
	@endif
<br>
<p>Thank You, </p>

<p><em>10ondrives.com </em></p>
<p>For issues, please contact us: 0246692117 / 0245004247</p>
    
@endif


