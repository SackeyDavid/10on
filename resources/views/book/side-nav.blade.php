<div id="mySidenav" class="sidenav" style="background-image: url({{URL::to('images/3.jpg')}});opacity: 0.;">
                <a href="javascript:void(0)" style="font-size: 25px;font-weight: 900;color: #fff;" class="closebtn top-right" onclick="
                document.getElementById('mySidenav').style.width = '0';">&times;</a>
                <div class="col-md-12" style="color: #fff;font-weight: 700;font-size: 20px;">
                    <hr>
                    My Trips <br>
                    <hr>
                    <a href="{{ route('search.trips') }}" style="color: #fff;cursor: pointer;">Book a drive</a> <br>
                    <hr>
                    @php 
                    $pretext = sprintf('%06d', mt_rand(100000,999999));
                    $posttext = sprintf('%06d', mt_rand(100000,999999));
                    @endphp
                    <a href="{{ route('oneway.drive.status', ['pretext' => $pretext,'booking_id' => $booking->id, 'posttext' => $posttext]) }}" style="color: #fff;cursor: pointer;">
                    Drive Status</a> <br>
                    <hr>
                    <a href="{{ URL::to('/home') }}" style="color: #fff;cursor: pointer;">
                    My Account</a> <br>
                    <hr>
                    Notifications <br>
                    <hr>
                    <br><br>
                    <div class="col-md-12">
                    <a class="btn btn-sm" style="background-color: #ff3345;color: #fff;" href="{{ route('user.logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">Log out</a>
                    <form id="logout-form" action="{{ route('user.logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    </div>
                </div>
            </div>