@extends('layout')

@section('content')

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
                    <th class="w-25px ta-center">Miniatura</th>
                    <th>Nazwa</th>
                    <th class="w-25px ta-center">Up</th>
                    <th class="w-25px ta-center">Down</th>
                </tr>
            </thead>
            <tbody>
                @foreach($photos as $photo)
                    <tr>
                        <input type="hidden" name="{{$photo->id}}" value="{{$photo->photo_link}}">
                        <td class="ta-center">{{$photo->photo_link}}</td>
                        <td>{{$photo->photo_link}}</td>
                        <td class="ta-center"><a class="up btn btn-info" href="#">UP</a></td>
                        <td class="ta-center"><a class="down btn btn-info" href="#">DOWN</a></td>
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
            var row = $(this).parents("tr:first");
            if ($(this).is(".up")) {
                row.insertBefore(row.prev());
            } else {
                row.insertAfter(row.next());
            }
        });
    });
</script>
@endsection
