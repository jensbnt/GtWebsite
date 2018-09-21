@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                @include('partials.message')
            </div>
        </div>
        @if(count($cars) < 2)
            <div class="col-md">
                <h1 class="display-4 text-center">
                    Select more cars
                </h1>
                <p class="lead text-center">
                    You selected {{ count($cars) }} car(s), but you need at least 2 cars to compare to eachother...
                </p>
                <p class="text-center">
                    <a href="{{ route('cars.index') }}" class="btn btn-primary">Search cars</a>
                </p>
            </div>
        @else
            <div class="row mb-3">
                <div class="col-md">
                    <form method="POST" action="{{ route('compare.index') }}">
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-secondary btn-block">Reset selection</button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col-md">
                    <div class="row">
                        @foreach($cars as $car)
                            <div class="col-md-{{ 12 / count($cars) }}">
                                <div class="card mb-3">
                                    <div class="card-header text-center text-muted">
                                        Compare
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
                                    <div class="card-footer">
                                        <form method="POST" action="{{ route('compare.index') }}">
                                            {{ csrf_field() }}
                                            <input type="hidden" name="car_id" value="{{ $car->id }}">
                                            <button type="submit" class="btn btn-info btn-block">Remove from selection
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

