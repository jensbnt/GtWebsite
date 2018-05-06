@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-6 offset-md-3">
                @include('partials.message')
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card mb-3">
                    <div class="card-body">
                        <h2>{{ $car->make . " - " . $car->name }}</h2>

                        <br>

                        <div class="row">
                            <div class="col-md-4"><b>Make:</b></div>
                            <div class="col-md">{{ $car->make }}</div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><b>Name:</b></div>
                            <div class="col-md">{{ $car->name }}</div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><b>Category:</b></div>
                            <div class="col-md">{{ $car->category }}</div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-4"><b>Speed:</b></div>
                            <div class="col-md">{{ $car->speed }}</div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><b>Acceleration:</b></div>
                            <div class="col-md">{{ $car->acceleration }}</div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><b>Braking:</b></div>
                            <div class="col-md">{{ $car->braking }}</div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><b>Cornering:</b></div>
                            <div class="col-md">{{ $car->cornering }}</div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><b>Stability:</b></div>
                            <div class="col-md">{{ $car->stability }}</div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><b>Average:</b></div>
                            <div class="col-md">{{ $car->average }}</div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-4"><b>Power:</b></div>
                            <div class="col-md">{{ $car->power }} HP</div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><b>Price:</b></div>
                            <div class="col-md">{{ number_format($car->price, 0, ',', '.') }} Cr</div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><b>Drive:</b></div>
                            <div class="col-md">{{ $car->drive }}</div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <span class="text-left">Garage: {{ $car->car_count }}</span> -
                        <a href="{{ route('cars.edit', ['id' => $car->id]) }}">Edit</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection