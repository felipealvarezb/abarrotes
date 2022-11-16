@extends('layouts.app')
@section('title', $viewData["title"])
@section('content')

<div class="row">
    <div class="container">
        <div class="row">
            <div class="col-md-8">
                <h2>{{ __('Global Weather Search') }}</h2>
                <form action="{{ route('api.search') }}" method="get">
                    @csrf
                    <div class="form-group">
                        <label for="city">
                            {{ __('Introduce the name of the city') }}
                        </label>
                        <input type="text" class="form-control mt-2" name="city" 
                        placeholder="Nombre de la ciudad">
                    </div>

                    <button type="submit" class="btn btn-success mt-3">{{ __('Consult') }}</button>
                </form>
            </div>

            <div class="col-md-4">
                @isset($viewData['ok'])
                <div class="col-md-12">
                    <h5>{{ $viewData['main'] }}</h5>
                    <h1>{{ intval($viewData['temp']) }}&deg;C</h1>
                </div>

            <div class="col-md-12">
                <h3>{{ $viewData['name'] }}, {{ $viewData['country'] }}</h3>
            </div>

        <div class="col-md-12">
        <h4>{{ $viewData['weather'] }}</h4>
    </div>
    @endisset
</div>
@endsection