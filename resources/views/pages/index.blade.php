@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row text-center align-items-center">
            <div class="col-md-2 mb-3">
                <img src="http://www.pngmart.com/files/3/Gran-Turismo-Logo-Transparent-PNG.png" alt=""
                     class="card-img-top">
            </div>
            <div class="col-md-8 mb-3">
                <h1 class="display-4">Welcome</h1>
                <p class="lead">Personal GT Sport manager</p>
            </div>
            <div class="col-md-2 mb-3">
                <img src="https://s3.amazonaws.com/freebiesupply/large/2x/playstation-logo-png-transparent.png" alt=""
                     class="card-img-top">
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <ul class="list-group mb-3">
                    <li class="list-group-item"><h1>Recent Updates</h1></li>
                    <li class="list-group-item"><b>v1.4</b> - Edit cars</li>
                    <li class="list-group-item"><b>v1.3</b> - Add cars</li>
                    <li class="list-group-item"><b>v1.2</b> - Garage view update</li>
                    <li class="list-group-item"><b>v1.1</b> - Stats</li>
                    <li class="list-group-item"><b>v1.0</b> - Beta stage</li>
                    <li class="list-group-item"><b>v0.*</b> - Alpha stage</li>
                </ul>
            </div>
            <div class="col-md-6">
                <ul class="list-group mb-3">
                    <li class="list-group-item"><h1>Last updated cars</h1></li>
                    @foreach($latest_cars as $car)
                        <li class="list-group-item">{{ $car->make }} ♦ {{ $car->name }}</li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
@endsection

