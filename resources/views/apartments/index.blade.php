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
                        <td class="ta-center"><a class="btn btn-info" href="{{route('apartments.edit', ['id'=>$apartment->apartament_id])}}">a</a></td>
                        <td class="ta-center"><a class="btn btn-info" href="{{route('apartments.photos', ['id'=>$apartment->apartament_id])}}">a</a></td>
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