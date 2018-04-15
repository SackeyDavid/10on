@extends('layouts.admin-app')

@section('content')

       
<div class="col-md-12">
    <div class="row">
        <div class="col-md-2" style="">
            <ul class="list-unstyled" style="padding: 15%;">
                <li><a href="#"> Transport Companies</a> <span class="badge-success" style="border-radius: 5px;">113</span></li>
                <li><a href="#">Clients</a></li>
                <li><a href="#"></a></li>
                <li><a href="#"></a></li>
            </ul>
        </div>
        <div class="col-md-8">
            @component('components.addTransportCompany')
            @endcomponent
            
            <br>
            @component('components.addClient')
            @endcomponent

            <br>
            @component('components.addKilometer')
            @endcomponent
        </div>
        <div class="col-md-2" style="">
            <ul class="list-unstyled" style="padding: 15%;">
                <li><STRONG>Admin attributes:</STRONG> </li>
                <li>@if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    @component('components.who')
                    @endcomponent
                </li>
                
            </ul>
        </div>
    </div>
</div>

@endsection
