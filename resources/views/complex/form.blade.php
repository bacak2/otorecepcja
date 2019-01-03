@extends('layout')

@section('content')
    @if($request->is('*/new'))
    <div class="ta-center">
        <div class="d-inline-block">
            <h1>Dodawanie</h1>
        </div>
    </div>
    {!! Form::open(['action' => 'ComplexesController@insert']) !!}
    @else
    <div class="ta-center">
        <div class="d-inline-block">
            <h1>Edycja</h1>
        </div>
    </div>
    {!! Form::model($apartment, ['action' => 'ComplexesController@update']) !!}
    @endif

    {{ Form::hidden('apartament_id', $apartment->apartament_id ?? null) }}
    {{ Form::hidden('mergedIds', $mergedIds ?? null) }}

    <div class="form-group row">
        {!! Form::label('apartament_name', 'Nazwa *', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            @if($errors->has('apartament_name')) <span class="text-danger">{{ $errors->first('apartament_name') }}</span> @endif
            {!! Form::text('apartament_name', $apartment->apartament_name ?? null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_link', 'Adres url *', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            @if($errors->has('apartament_link')) <span class="text-danger">{{ $errors->first('apartament_link') }}</span> @endif
            {!! Form::text('apartament_link', $apartment->apartament_link ?? null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_description_begin', 'Początek opisu *', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            @if($errors->has('apartament_description_begin')) <span class="text-danger">{{ $errors->first('apartament_description_begin') }}</span> @endif
            @if(isset($apartment->apartament_description_begin))
                {!! Form::textarea('apartament_description_begin', str_replace('<br />', "\n", $apartment->apartament_description_begin), ['class' => 'form-control', 'rows' => 3]) !!}
            @else
                {!! Form::textarea('apartament_description_begin', null, ['class' => 'form-control', 'rows' => 3]) !!}
            @endif
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_description_else', 'Dalszy ciąg opisu', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            @if($errors->has('apartament_description_else')) <span class="text-danger">{{ $errors->first('apartament_description_else') }}</span> @endif
            @if(isset($apartment->apartament_description_else))
                {!! Form::textarea('apartament_description_else', str_replace('<br />', "\n", $apartment->apartament_description_else), ['class' => 'form-control', 'rows' => 5]) !!}
            @else
                {!! Form::textarea('apartament_description_else', null, ['class' => 'form-control', 'rows' => 5]) !!}
            @endif
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_additional_information', 'Dodatkowe informacje', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            @if($errors->has('apartament_additional_information')) <span class="text-danger">{{ $errors->first('apartament_additional_information') }}</span> @endif
            {!! Form::text('apartament_additional_information', $apartment->apartament_additional_information ?? null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_geo_lat', 'Szerokość geograficzna *', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            @if($errors->has('apartament_geo_lat')) <span class="text-danger">{{ $errors->first('apartament_geo_lat') }}</span> @endif
            {!! Form::text('apartament_geo_lat', $apartment->apartament_geo_lat ?? null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_geo_lan', 'Długość geograficzna *', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            @if($errors->has('apartament_geo_lan')) <span class="text-danger">{{ $errors->first('apartament_geo_lan') }}</span> @endif
            {!! Form::text('apartament_geo_lan', $apartment->apartament_geo_lan ?? null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_gps', 'Współrzędne GPS *', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            @if($errors->has('apartament_gps')) <span class="text-danger">{{ $errors->first('apartament_gps') }}</span> @endif
            {!! Form::text('apartament_gps', $apartment->apartament_gps ?? null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_address', 'Adres *', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            @if($errors->has('apartament_address')) <span class="text-danger">{{ $errors->first('apartament_address') }}</span> @endif
            {!! Form::text('apartament_address', $apartment->apartament_address ?? null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_address_2', 'Kod pocztowy *', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            @if($errors->has('apartament_address_2')) <span class="text-danger">{{ $errors->first('apartament_address_2') }}</span> @endif
            {!! Form::text('apartament_address_2', $apartment->apartament_address_2 ?? null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_city', 'Miasto', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            {!! Form::select('apartament_city', apartaments_cities(), $apartment->apartament_city ?? 'Zakopane') !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_district', 'Dzielnica', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            {!! Form::select('apartament_district', apartaments_districts(), $apartment->apartament_district ?? '') !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartments', 'Apartamenty', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            @if($errors->has('apartments')) <div class="text-danger">{{ $errors->first('apartments') }}</div> @endif
            {!! Form::select('apartments[]', $availableApartments, $selectedApartments, array('multiple' => true)) !!}
        </div>
    </div>

    <div class="ta-center">
        <div class="d-inline-block">
            <button type="submit" class="btn btn-primary btn-lg">Zapisz</button>
        </div>
    </div>
    {!! Form::close() !!}

@endsection