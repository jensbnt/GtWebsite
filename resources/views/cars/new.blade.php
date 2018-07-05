@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 offset-md-2">
                @include('partials.message')
            </div>
        </div>
        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="card mb-3">
                    <div class="card-header text-center text-muted">
                        New car
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('cars.new') }}">
                        {{ csrf_field() }}

                        <!-- MAKE -->
                            <div class="form-row form-group">
                                <label for="inputMake" class="col-md-3 col-form-label">Make</label>
                                <div class="col-md-9">
                                    <input type="text" id="inputMake" name="make" class="form-control"
                                           placeholder="Make" value="{{ old('make') != "" ? old('make') : "" }}"
                                           data-toggle="dropdown" aria-haspopup="true"
                                           aria-expanded="false">
                                    <div class="dropdown-menu" id="makes" aria-labelledby="inputMake"></div>
                                </div>
                            </div>

                            <!-- NAME -->
                            <div class="form-row form-group">
                                <label for="inputName" class="col-md-3 col-form-label">Name</label>
                                <div class="col-md-9">
                                    <input type="text" id="inputName" name="name" class="form-control"
                                           placeholder="Name" value="{{ old('name') != "" ? old('name') : "" }}">
                                </div>
                            </div>

                            <!-- CATEGORY -->
                            <div class="form-row form-group">
                                <label for="inputCategory" class="col-md-3 col-form-label">Category</label>
                                <div class="col-md-9">
                                    <input type="text" id="inputCategory" name="category" class="form-control"
                                           placeholder="Category"
                                           value="{{ old('category') != "" ? old('category') : "" }}"
                                           data-toggle="dropdown" aria-haspopup="true"
                                           aria-expanded="false">
                                    <div class="dropdown-menu" id="categories" aria-labelledby="inputCategory"></div>
                                </div>
                            </div>

                            <hr>

                            <!-- SPEED -->
                            <div class="form-row form-group">
                                <label for="inputSpeed" class="col-md-3 col-form-label">Speed</label>
                                <div class="col-md-9">
                                    <input type="number" id="inputSpeed" name="speed" class="form-control" step="0.1"
                                           placeholder="Speed" value="{{ old('speed') != "" ? old('speed') : "" }}">
                                </div>
                            </div>

                            <!-- ACCELERATION -->
                            <div class="form-row form-group">
                                <label for="inputAcceleration" class="col-md-3 col-form-label">Acceleration</label>
                                <div class="col-md-9">
                                    <input type="number" id="inputAcceleration" name="acceleration" class="form-control"
                                           step="0.1" placeholder="Acceleration"
                                           value="{{ old('acceleration') != "" ? old('acceleration') : "" }}">
                                </div>
                            </div>

                            <!-- BRAKING -->
                            <div class="form-row form-group">
                                <label for="inputBraking" class="col-md-3 col-form-label">Braking</label>
                                <div class="col-md-9">
                                    <input type="number" id="inputBraking" name="braking" class="form-control"
                                           step="0.1" placeholder="Braking"
                                           value="{{ old('braking') != "" ? old('braking') : "" }}">
                                </div>
                            </div>

                            <!-- CORNERING -->
                            <div class="form-row form-group">
                                <label for="inputCornering" class="col-md-3 col-form-label">Cornering</label>
                                <div class="col-md-9">
                                    <input type="number" id="inputCornering" name="cornering" class="form-control"
                                           step="0.1" placeholder="Cornering"
                                           value="{{ old('cornering') != "" ? old('cornering') : "" }}">
                                </div>
                            </div>

                            <!-- STABILITY -->
                            <div class="form-row form-group">
                                <label for="inputStability" class="col-md-3 col-form-label">Stability</label>
                                <div class="col-md-9">
                                    <input type="number" id="inputStability" name="stability" class="form-control"
                                           step="0.1" placeholder="Stability"
                                           value="{{ old('stability') != "" ? old('stability') : "" }}">
                                </div>
                            </div>

                            <hr>

                            <!-- POWER -->
                            <div class="form-row form-group">
                                <label for="inputPower" class="col-md-3 col-form-label">Power</label>
                                <div class="col-md-9 input-group">
                                    <input type="number" id="inputPower" name="power" class="form-control"
                                           placeholder="Power" value="{{ old('power') != "" ? old('power') : "" }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">HP</span>
                                    </div>
                                </div>
                            </div>

                            <!-- PRICE -->
                            <div class="form-row form-group">
                                <label for="inputPrice" class="col-md-3 col-form-label">Price</label>
                                <div class="col-md-9 input-group">
                                    <input type="number" id="inputPrice" name="price" class="form-control"
                                           placeholder="Price" value="{{ old('price') != "" ? old('price') : "" }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Cr.</span>
                                    </div>
                                </div>
                            </div>

                            <!-- DRIVE -->
                            <div class="form-row form-group">
                                <label for="inputDrive" class="col-md-3 col-form-label">Drive</label>
                                <div class="col-md-9">
                                    <input type="text" id="inputDrive" name="drive" class="form-control"
                                           placeholder="Drive" value="{{ old('drive') != "" ? old('drive') : "" }}"
                                           data-toggle="dropdown" aria-haspopup="true"
                                           aria-expanded="false">
                                    <div class="dropdown-menu" id="drives" aria-labelledby="inputDrive"></div>
                                </div>
                            </div>


                            <!-- BUTTONS -->
                            <div class="form-row form-group">
                                <div class="col-md-4 offset-md-3">
                                    <button type="submit" class="btn btn-dark btn-block">
                                        Add car
                                    </button>
                                </div>
                                <div class="col-md-4 offset-md-1">
                                    <a href="{{ route('cars.index') }}" class="btn btn-danger btn-block">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            @if ($errors->any())
                <div class="col-md-6 offset-md-3 mb-3">
                    <ul class="list-group">
                        @foreach ($errors->all() as $error)
                            <li class="list-group-item list-group-item-danger">{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
        </div>
    </div>
    <script src="{{ URL::to('js/drives.js') }}"></script>
    <script src="{{ URL::to('js/makes.js') }}"></script>
    <script src="{{ URL::to('js/categories.js') }}"></script>
@endsection