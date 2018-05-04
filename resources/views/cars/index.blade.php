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
                <table class="table table-striped table-hover">
                    <caption>Cars - XXX results</caption>
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-left" style="width: 15%">Make</th>
                        <th scope="col" class="text-left" style="width: 33%">Name</th>
                        <th scope="col" class="text-left" style="width: 7%">Ct</th>
                        <th scope="col" class="text-right" style="width: 5%">S</th>
                        <th scope="col" class="text-right" style="width: 5%">A</th>
                        <th scope="col" class="text-right" style="width: 5%">B</th>
                        <th scope="col" class="text-right" style="width: 5%">C</th>
                        <th scope="col" class="text-right" style="width: 5%">S</th>
                        <th scope="col" class="text-right" style="width: 5%">HP</th>
                        <th scope="col" class="text-right" style="width: 10%">Price</th>
                        <th scope="col" class="text-left" style="width: 5%">Drive</th>
                    </tr>
                    </thead>
                    <tbody>
                    @for($i = 0; $i < count($cars); $i++)
                        <tr>
                            <td class="text-left">{{ $cars[$i]->make }}</td>
                            <td class="text-left"><a href="">{{ $cars[$i]->name }}</a></td>
                            <td class="text-left">{{ $cars[$i]->category }}</td>
                            <td class="text-right">{{ $cars[$i]->speed }}</td>
                            <td class="text-right">{{ $cars[$i]->acceleration }}</td>
                            <td class="text-right">{{ $cars[$i]->braking }}</td>
                            <td class="text-right">{{ $cars[$i]->cornering }}</td>
                            <td class="text-right">{{ $cars[$i]->stability }}</td>
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