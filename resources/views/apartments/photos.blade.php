@extends('layout')

@section('content')

    <div class="ta-center">
        <div class="d-inline-block">
            <h1>Zdjęcia</h1>
        </div>
        <a class="btn btn-lg btn-success pull-right" href="{{ route('apartments.photosNew', ['id' => $apartmentId]) }}"><img style="max-width: 12px" src="{{ asset("images/Apartment/add.png") }}"> Dodaj nowe</a>
    </div>

    @if($photos !== null)
        {!! Form::open(['action' => 'ApartmentsController@savePhotos', 'method' => 'POST']) !!}
        <input type="hidden" name="apartmentId" value="{{$apartmentId}}">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="w-25 ta-center">Miniatura</th>
                    <th>Nazwa</th>
                    <th class="w-25px ta-center">Główne</th>
                    <th class="w-25px ta-center">Góra</th>
                    <th class="w-25px ta-center">Dół</th>
                    <th class="w-25px ta-center">Usuń</th>
                </tr>
            </thead>
            <tbody>
                @foreach($photos as $photo)
                    <tr>
                        <input type="hidden" name="{{$photo->id}}" value="{{$photo->photo_link}}">
                        <td class="ta-center"><img class="img-fluid" src="{{ "http://dev.otozakopane.com"."/images/apartaments/$apartmentId/$photo->photo_link" }}" alt="{{$photo->photo_link}}"></td>
                        <td>{{$photo->photo_link}}</td>
                        <td class="ta-center"><input name="mainPhoto" type="radio" value="{{$photo->id}}" @if($mainPhotoId == $photo->id) checked="checked" @endif></td>
                        <td class="ta-center"><a class="up btn btn-primary"><img class="icon" src="{{ asset("images/Apartment/Arrow_up.png") }}"></a></td>
                        <td class="ta-center"><a class="down btn btn-primary"><img class="icon" src="{{ asset("images/Apartment/Arrow_down.png") }}"></a></td>
                        <td class="ta-center"><a class="delete btn btn-danger"><img class="icon" src="{{ asset("images/Apartment/delete.png") }}"></a></td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <div class="ta-center">
            <div class="d-inline-block">
                <button type="submit" class="btn btn-primary btn-lg">Zapisz</button>
                {{-- $photos->links() --}}
            </div>
        </div>
        {!! Form::close() !!}
    @endif

@endsection

@section('js-scripts')
<script>
    $(document).ready(function(){
        $(".up,.down").click(function(){
            let row = $(this).parents("tr:first");
            if ($(this).is(".up")) {
                row.insertBefore(row.prev());
            } else {
                row.insertAfter(row.next());
            }
        });

        $(".delete").click(function(){
            let row = $(this).parents("tr:first");
            row.remove();
        });
    });
</script>
@endsection
