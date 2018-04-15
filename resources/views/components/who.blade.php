@if (Auth::guard('web')->check())
  > <span class="text-success">You are logged in as a <strong>user</strong></span><br>
@else
  > <span class="text-danger">You are logged out as a <strong>user</strong></span><br>
@endif


@if (Auth::guard('admin')->check())
  > <span class="text-success">You are logged in as a <strong>admin</strong></span><br>
@else
  > <span class="text-danger">You are logged out as a <strong>admin</strong></span><br>
@endif

@if (Auth::guard('client')->check())
  ><span class="text-success">You are logged in as a <strong>client</strong></span><br>
@else
  ><span class="text-danger">You are logged out as a <strong>client</strong></span><br>
@endif
