@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if($msg)
            <div class="alert alert-info" >
            <a href="#" data-dismiss="alert" class="close">&times;</a>
            <p class=""><center> {{ $msg }}</center></p>
            </div>
            @endif
            <div class="card card-default">
                <div class="card-header"><i class="fas fa-cedit-card"></i> Register Payment Details</div>

                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('payment.register') }}">
                        @csrf

                        <div class="form-group{{ $errors->has('card_number') ? ' has-error' : '' }}">
                            <label for="card_number" class="col-md-4 control-label">Card number</label>

                            <div class="col-md-6">
                                <input id="card_number" type="text" class="form-control" name="card_number" value="{{ old('card_number') }}" required autofocus>

                                @if ($errors->has('card_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('card_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('security_code') ? ' has-error' : '' }}">
                            <label for="security_code" class="col-md-4 control-label">Security code(CVC/CVV)</label>

                            <div class="col-md-6">
                                <input id="security_code" type="text" class="form-control" name="security_code" required>

                                @if ($errors->has('security_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('security_code') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('expiry_date') ? ' has-error' : '' }}">
                            <label for="expiry_date" class="col-md-4 control-label">Expiry date(mm/yy)</label>

                            <div class="col-md-6">
                                <input id="expiry_date" type="text" class="form-control" name="expiry_date" value="{{ old('expiry_date') }}" required>

                                @if ($errors->has('expiry_date'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('expiry_date') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('first_name') ? ' has-error' : '' }}">
                            <label for="first_name" class="col-md-4 control-label">First name</label>

                            <div class="col-md-6">
                                <input id="first_name" type="text" class="form-control" name="first_name" value="{{Auth::user()->first_name}}" required>

                                @if ($errors->has('first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('first_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('last_name') ? ' has-error' : '' }}">
                            <label for="last_name" class="col-md-4 control-label">Last name</label>

                            <div class="col-md-6">
                                <input id="last_name" type="text" class="form-control" name="last_name" value="{{Auth::user()->last_name}}" required>

                                @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('country') ? ' has-error' : '' }}">
                            <label for="country" class="col-md-4 control-label">Country</label>

                            <div class="col-md-6">
                                <input id="country" type="text" class="form-control" name="country" value="{{Auth::user()->country}}" required>

                                @if ($errors->has('country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('country') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>    

                        <div class="form-group{{ $errors->has('address_line_1') ? ' has-error' : '' }}">
                            <label for="address_line_1" class="col-md-4 control-label">Address Line 1</label>

                            <div class="col-md-6">
                                <input id="address_line_1" type="text" class="form-control" name="address_line_1" required>

                                @if ($errors->has('address_line_1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address_line_1') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>   

                        <div class="form-group{{ $errors->has('address_line_2') ? ' has-error' : '' }}">
                            <label for="address_line_2" class="col-md-4 control-label">Address Line 2</label>

                            <div class="col-md-6">
                                <input id="address_line_2" type="text" class="form-control" name="address_line_2" required>

                                @if ($errors->has('address_line_2'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address_line_2') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>                        

                        <div class="form-group{{ $errors->has('address_line_3') ? ' has-error' : '' }}">
                            <label for="address_line_3" class="col-md-4 control-label">Address Line 3</label>

                            <div class="col-md-6">
                                <input id="address_line_3" type="text" class="form-control" name="address_line_3">

                                @if ($errors->has('address_line_3'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('address_line_3') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>     
                        <br>
                        
                        <div class="col-md-offset-4">
                            <center>
                                <button type="submit" class="col-md-6 btn btn-lg" style="background-color: #ff3345;color: #fff;">
                                    Done
                                </button>
                            </center>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
