@extends('layout')

@section('content')

<div class="ta-center">
    <div class="d-inline-block">
        <h1>Cennik</h1>
    </div>
</div>

@foreach($prices as $price)
    <div>{{$price->date_of_price}} {{$price->price_value}}</div>
@endforeach

<div class="ta-center">
    <div class="d-inline-block">
        {{ $prices->links() }}
        <button type="submit" class="btn btn-primary btn-lg">Zapisz</button>
    </div>
</div>

@endsection