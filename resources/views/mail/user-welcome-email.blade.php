
@if(!$name)
    No name
@else
    
Hello {{ $name }},
<p>Thank you for joining 10ondrives!</p>
<p>You can login to our user system at <a style="text-decoration: none;" href="http://localhost:8000/login">http://localhost:8000/login,</a> using the membership number below and password you provided</p>
    @if(!$user)
    no user
    @else
<span>Membership number :    {{ $user->membership_number }}</span><br>


<p>Thank You, </p>

<p><em>10ondrives</em></p>
    @endif
@endif


