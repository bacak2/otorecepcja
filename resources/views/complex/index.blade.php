@extends('layout')

@section('content')

    @if($apartments !== null)
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="w-25px">Id</th>
                    <th>Nazwa</th>
                    <th class="w-25px ta-center">Edycja</th>
                    <th class="w-25px ta-center">Zdjęcia</th>
                </tr>
            </thead>
            <tbody>
                @foreach($apartments as $apartment)
                    <tr>
                        <td>{{$apartment->apartament_id}}</td>
                        <td>{{$apartment->apartament_name}}</td>
                        <td class="ta-center"><a class="btn btn-outline-custom" href="{{route('complex.edit', ['id'=>$apartment->apartament_id])}}"><img class="icon" src="{{ asset("images/Apartment/Pencil.png") }}"></a></td>
                        <td class="ta-center"><a class="btn btn-outline-custom" href="{{route('complex.photos', ['id'=>$apartment->apartament_id])}}"><img class="icon" src="{{ asset("images/Apartment/Images.png") }}"></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="ta-center">
            <div class="d-inline-block">
                {{ $apartments->links() }}
            </div>
        </div>
    @endif

@endsection