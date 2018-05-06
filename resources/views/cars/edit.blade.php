@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                @include('partials.message')
            </div>
        </div>
        <div class="row">
            <div class="col-md-8 offset-md-2">
                <div class="card">
                    <div class="card-header">
                        <h1>Edit car</h1>
                        <p>{{ $car->make }} - {{ $car->name }}</p>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('cars.edit', ['id' => $car->id]) }}">
                            {{ csrf_field() }}

                            <div class="row form-group">
                                <label for="car_count" class="col-md-2 offset-md-1 control-label">Car count</label>

                                <div class="col-md-8">
                                    <input id="car_count" type="number" class="form-control" name="car_count" value="{{ old('car_count') == "" ? $car->car_count : old('car_count') }}">

                                    @if ($errors->has('car_count'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('car_count') }}</strong>
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="row form-group">
                                <div class="col-md-4 offset-md-3">
                                    <button type="submit" class="btn btn-dark btn-block">
                                        Update car
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <a href="{{ route('cars.view', ['id' => $car->id]) }}">Cancel</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection