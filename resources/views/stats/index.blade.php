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
                        <h2 class="display-4">Stats</h2>
                        <br>
                        <p><b>Total car value:</b> {{ number_format($garagevalue->value, 0, ',', '.') }} Cr</p>
                        <p><b>Cost of remaining cars:</b> {{ number_format($not_owned_cars_price, 0, ',', '.') }} Cr</p>
                        <p><b>Total cars:</b> {{ $count }}
                        <div class="progress">
                            <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                 style="width: {{ $total_prc }}%;">{{ $total_prc }} %
                            </div>
                        </div>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md">
                <table class="table table-striped table-hover">
                    <caption>Stats</caption>
                    <thead class="thead-dark">
                    <tr>
                        <th scope="col" class="text-left" style="width: 30%">Make</th>
                        <th scope="col" style="width: 70%"></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($stat_list as $stat)
                        <tr>
                            <td class="text-left">{{ $stat->make }}</td>
                            <td>
                                @if($stat->prc != 0)
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                             style="width: {{ $stat->prc }}%;">{{ $stat->prc }} %
                                        </div>
                                    </div>
                                @else
                                    You don't own a {{ $stat->make }}
                                @endif
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection