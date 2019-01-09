<div id="addNewPhotosForm">
    <form method="post" action="{{route('apartments.uploadPhotos', ['id' => $apartmentId])}}" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group">
            @if($errors->has('uploaded_images')) <span class="text-danger pull-left">{{ $errors->first('uploaded_images') }}</span> @endif
            <input type="file" name="uploaded_images[]" id="select_file" multiple>
            <button type="submit" class="btn btn-primary btn-lg d-block">Zapisz</button>
        </div>
    </form>
</div>
