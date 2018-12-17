@extends('layout')

@section('content')

    <div class="ta-center">
        <div class="d-inline-block">
            <h1>Zdjęcie główne</h1>
        </div>
    </div>

    <div class="ta-center">
        <div class="d-inline-block">
            <h1>Zdjęcia</h1>
        </div>
    </div>

    @if($photos !== null)
        {!! Form::open(['action' => 'ApartmentsController@savePhotos', 'method' => 'POST']) !!}
        <input type="hidden" name="apartmentId" value="{{$apartmentId}}">
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th class="w-25 ta-center">Miniatura</th>
                    <th>Nazwa</th>
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
                        <td class="ta-center"><a class="up btn btn-info">UP</a></td>
                        <td class="ta-center"><a class="down btn btn-info">DOWN</a></td>
                        <td class="ta-center"><a class="delete btn btn-danger">X</a></td>
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
