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
                    <div class="card-header text-center">
                        <h2>{{ $car->name }}</h2>
                    </div>
                    <div class="card-body">
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
                            <div class="col-md">{{ number_format($car->price, 0, ',', '.') }} Cr.</div>
                        </div>

                        <div class="row">
                            <div class="col-md-4"><b>Drive:</b></div>
                            <div class="col-md">{{ $car->drive }}</div>
                        </div>

                        <hr>

                        <div class="row">
                            <div class="col-md-4"><b>Garage:</b></div>
                            <div class="col-md">{{ $car->car_count }}</div>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <div class="row">
                            <div class="col-md-6">
                                <a href="{{ route('cars.edit', ['id' => $car->id]) }}" class="btn btn-primary btn-block">Edit</a>
                            </div>
                            <div class="col-md-6">
                                <form method="POST" action="{{ route('cars.view', ['id' => $car->id]) }}">
                                    {{ csrf_field() }}
                                    <button type="submit" class="btn btn-info btn-block">Compare</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection