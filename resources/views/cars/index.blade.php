@extends('layouts.master')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md">
                @include('partials.message')
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <form class="form-horizontal" method="GET" action="{{ route('cars.index') }}">
                    {{ csrf_field() }}

                    <div class="row form-group">
                        <div class="col-md-2">
                            <select id="make" class="form-control" name="make">
                                <option selected></option>
                                @foreach($makes as $make)
                                    <option value="{{ $make->make }}">{{ $make->make }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <select id="category" class="form-control" name="category">
                                <option selected></option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->category }}">{{ $category->category }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <input id="name" type="text" class="form-control" name="name" placeholder="name" value="">
                        </div>

                        <div class="col-md-2">
                            <button type="submit" class="btn btn-dark btn-block">
                                Filter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <table class="table table-striped table-hover">
                    <caption>Cars - {{ $count }} results - <a href="{{ route('cars.new') }}">new</a> </caption>
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-left" style="width: 15%">Make</th>
                        <th scope="col" class="text-left" style="width: 50%">Name</th>
                        <th scope="col" class="text-left" style="width: 10%"></th>
                        <th scope="col" class="text-left" style="width: 10%">Ct</th>
                        <th scope="col" class="text-right" style="width: 5%">HP</th>
                        <th scope="col" class="text-right" style="width: 10%">Price</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i = 0; $i < count($cars); $i++)
                        <tr>
                            <td class="text-left">{{ $cars[$i]->make }}</td>
                            <td class="text-left"><a href="{{ route('cars.view', ['id' => $cars[$i]->id]) }}">{{ $cars[$i]->name }}</a></td>
                            <td class="text-left"><span class="badge badge-primary">{{ $cars[$i]->car_count }}</span></td>
                            <td class="text-left">{{ $cars[$i]->category }}</td>
                            <td class="text-right">{{ $cars[$i]->power }}</td>
                            <td class="text-right">{{ number_format($cars[$i]->price, 0, ',', '.') }}</td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
                {{ $cars->links() }}
            </div>
        </div>
    </div>
@endsection