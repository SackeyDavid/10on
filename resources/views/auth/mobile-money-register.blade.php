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
                <div class="card-header"><i class="fas fa-mobile-alt"></i> Mobile Money Details</div>

                <div class="card-body">
                    <form class="form-horizontal" method="POST" action="{{ route('mobile.details.register') }}">
                        @csrf

                        <div class="form-group{{ $errors->has('phone_number') ? ' has-error' : '' }}">
                            <label for="phone_number" class="col-md-4 control-label">Phone number</label>

                            <div class="col-md-6">
                                <input id="phone_number" type="text" class="form-control" name="phone_number" value="{{ old('phone_number') }}" required autofocus>

                                @if ($errors->has('phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('phone_number') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">Email address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-4 control-label">Name</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('network') ? ' has-error' : '' }}">
                            <label for="network" class="col-md-4 control-label">Network</label>

                            <div class="col-md-6">
                                <select id="network" type="text" class="form-control" name="network" value="{{ old('network') }}" required>
                                    <option></option>
                                </select>

                                @if ($errors->has('network'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('network') }}</strong>
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
