
@if(!$transport_company)
    No transport company
@else
    
Hello {{ $transport_company->name }},
<p>Thank you for joining 10ondrives!</p>
<p>You can login to our client system at <a style="text-decoration: none;" href="http://localhost:8000/client/login">http://localhost:8000/client/login,</a> using the username and password below</p>
    @if(!$customer)
    no client
    @else
<span>Username :    {{ $customer->username }}</span><br>
<span>Password :    {{ $password }}</span>

<p>Thank You, </p>

<p><em>10ondrives</em></p>
    @endif
@endif


