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
                <div class="card mb-3">
                    <div class="card-body text-center">
                        <h2 class="display-4">Garage</h2>

                        <br>

                        <p><b>Total cars:</b> {{ $count }}</p>
                        <p><b>Total car value:</b> {{ number_format($garagevalue->value, 0, ',', '.') }} Cr</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <table class="table table-striped table-hover">
                    <caption>Cars - {{ $count }} results</caption>
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-left" style="width: 15%">Make</th>
                        <th scope="col" class="text-left" style="width: 45%">Name</th>
                        <th scope="col" class="text-left" style="width: 5%">#</th>
                        <th scope="col" class="text-left" style="width: 10%">Ct</th>
                        <th scope="col" class="text-right" style="width: 5%">HP</th>
                        <th scope="col" class="text-right" style="width: 10%">Price</th>
                        <th scope="col" class="text-left" style="width: 10%">Drive</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i = 0; $i < count($cars); $i++)
                        <tr>
                            <td class="text-left">{{ $cars[$i]->make }}</td>
                            <td class="text-left"><a href="{{ route('cars.view', ['id' => $cars[$i]->id]) }}">{{ $cars[$i]->name }}</a></td>
                            <td class="text-left">{{ $cars[$i]->car_count }}</td>
                            <td class="text-left">{{ $cars[$i]->category }}</td>
                            <td class="text-right">{{ $cars[$i]->power }}</td>
                            <td class="text-right">{{ number_format($cars[$i]->price, 0, ',', '.') }}</td>
                            <td class="text-left">{{ $cars[$i]->drive }}</td>
                        </tr>
                    @endfor
                    </tbody>
                </table>
                {{ $cars->links() }}
            </div>
        </div>
    </div>
@endsection