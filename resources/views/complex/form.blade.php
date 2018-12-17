@extends('layout')

@section('content')
    @if($request->is('*/new'))
    <div class="ta-center">
        <div class="d-inline-block">
            <h1>Dodawanie</h1>
        </div>
    </div>
    {!! Form::open(['action' => 'ApartmentsController@insert']) !!}
    @else
    <div class="ta-center">
        <div class="d-inline-block">
            <h1>Edycja</h1>
        </div>
    </div>
    {!! Form::model($apartment, ['action' => 'ApartmentsController@update']) !!}
    @endif

    {{ Form::hidden('apartament_id', $apartment->apartament_id ?? null) }}

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
        {!! Form::label('final_cleaning_price', 'Koszt sprzątania końcowego *', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-1">
            @if($errors->has('final_cleaning_price')) <span class="text-danger">{{ $errors->first('final_cleaning_price') }}</span> @endif
            {!! Form::text('final_cleaning_price', $apartment->final_cleaning_price ?? null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_persons', 'Max ilość osób', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-1">
            {!! Form::number('apartament_persons', $apartment->apartament_persons ?? null, ['class' => 'form-control', 'min' => '1']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_rooms_number', 'Liczba pokoi', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-1">
            {!! Form::number('apartament_rooms_number', $apartment->apartament_rooms_number ?? null, ['class' => 'form-control', 'min' => '0']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_single_beds', 'Liczba łóżek pojedynczych', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-1">
            {!! Form::number('apartament_single_beds', $apartment->apartament_single_beds ?? null, ['class' => 'form-control', 'min' => '0']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_double_beds', 'Liczba łóżek podwojnych', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-1">
            {!! Form::number('apartament_double_beds', $apartment->apartament_double_beds ?? null, ['class' => 'form-control', 'min' => '0']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_bathrooms', 'Liczba łazienek', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-1">
            {!! Form::number('apartament_bathrooms', $apartment->apartament_bathrooms ?? null, ['class' => 'form-control', 'min' => '0']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_living_area', 'Metraż *', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-1">
            @if($errors->has('apartament_living_area')) <span class="text-danger">{{ $errors->first('apartament_living_area') }}</span> @endif
            {!! Form::text('apartament_living_area', $apartment->apartament_living_area ?? null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_floors_number', 'Liczba pięter', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-1">
            {!! Form::number('apartament_floors_number', $apartment->apartament_floors_number ?? null, ['class' => 'form-control', 'min' => '0']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_levels_number', 'Liczba poziomów', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-1">
            {!! Form::number('apartament_levels_number', $apartment->apartament_levels_number ?? null, ['class' => 'form-control', 'min' => '0']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_spa', 'Spa', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            {!! Form::checkbox('apartament_spa', 1, $apartment->apartament_spa ?? 0) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_animals', 'Akceptacja zwierząt', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            {!! Form::checkbox('apartament_animals', 1, $apartment->apartament_animals ?? 0) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_wifi', 'Wifi', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            {!! Form::checkbox('apartament_wifi', 1, $apartment->apartament_wifi ?? 0) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_parking', 'Parking', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            {!! Form::checkbox('apartament_parking', 1, $apartment->apartament_parking ?? 0) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_tv', 'Telewizor', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            {!! Form::checkbox('apartament_tv', 1, $apartment->apartament_tv ?? 0) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_vaccum_cleaner', 'Odkurzacz', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            {!! Form::checkbox('apartament_vaccum_cleaner', 1, $apartment->apartament_vaccum_cleaner ?? 0) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_fireplace', 'Kominek', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            {!! Form::checkbox('apartament_fireplace', 1, $apartment->apartament_fireplace ?? 0) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_balcony', 'Balkon', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            {!! Form::checkbox('apartament_balcony', 1, $apartment->apartament_balcony ?? 0) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_kid_beds', 'Łóżeczko dla dziecka', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            {!! Form::checkbox('apartament_kid_beds', 1, $apartment->apartament_kid_beds ?? 0) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_fridge', 'Lodówka', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            {!! Form::checkbox('apartament_fridge', 1, $apartment->apartament_fridge ?? 0) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_cooker', 'Dzielnica', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            {!! Form::select('apartament_cooker', apartament_cookers(), $apartment->apartament_cooker ?? '') !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_washing_machine', 'Pralka', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            {!! Form::checkbox('apartament_washing_machine', 1, $apartment->apartament_washing_machine ?? 0) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_electric_kettle', 'Czajnik', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            {!! Form::checkbox('apartament_electric_kettle', 1, $apartment->apartament_electric_kettle ?? 0) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_microvawe_owen', 'Mikrofalówka', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            {!! Form::checkbox('apartament_microvawe_owen', 1, $apartment->apartament_microvawe_owen ?? 0) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_shower_cabin', 'Kabina prysznicowa', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            {!! Form::checkbox('apartament_shower_cabin', 1, $apartment->apartament_shower_cabin ?? 0) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_hair_dryer', 'Suszarka', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            {!! Form::checkbox('apartament_hair_dryer', 1, $apartment->apartament_hair_dryer ?? 0) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_elevator', 'Winda', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            {!! Form::checkbox('apartament_elevator', 1, $apartment->apartament_elevator ?? 0) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_iron', 'Żelazko', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            {!! Form::checkbox('apartament_iron', 1, $apartment->apartament_iron ?? 0) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_toaster', 'Toster', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            {!! Form::checkbox('apartament_toaster', 1, $apartment->apartament_toaster ?? 0) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_washer', 'Zmywarka', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            {!! Form::checkbox('apartament_washer', 1, $apartment->apartament_washer ?? 0) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_bathtub', 'Wanna', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            {!! Form::checkbox('apartament_bathtub', 1, $apartment->apartament_bathtub ?? 0) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_other_equipment', 'Pozostałe wyposażenie (przytrzymaj ctrl by wybrać kilka opcji)', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            @if(isset($apartment->apartament_other_equipment))
                {!! Form::select('apartament_other_equipment[]', apartament_other_equipments(), explode(', ', $apartment->apartament_other_equipment), array('multiple' => true)) !!}
            @else
                {!! Form::select('apartament_other_equipment[]', apartament_other_equipments(), '', array('multiple' => true)) !!}
            @endif
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_other_bathroom_equipment', 'Pozostałe wyposażenie łazienki (przytrzymaj ctrl by wybrać kilka opcji)', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            @if(isset($apartment->apartament_other_bathroom_equipment))
                {!! Form::select('apartament_other_bathroom_equipment[]', apartament_other_bathroom_equipments(), explode(', ', $apartment->apartament_other_bathroom_equipment), array('multiple' => true)) !!}
            @else
                {!! Form::select('apartament_other_bathroom_equipment[]', apartament_other_bathroom_equipments(), '', array('multiple' => true)) !!}
            @endif
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_registration_time', 'Godziny zameldowania *', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-2">
            @if($errors->has('apartament_registration_time')) <span class="text-danger">{{ $errors->first('apartament_registration_time') }}</span> @endif
            {!! Form::text('apartament_registration_time', $apartment->apartament_registration_time ?? null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('apartament_checkout_time', 'Godziny wymeldowania *', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-2">
            @if($errors->has('apartament_checkout_time')) <span class="text-danger">{{ $errors->first('apartament_checkout_time') }}</span> @endif
            {!! Form::text('apartament_checkout_time', $apartment->apartament_checkout_time ?? null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="form-group row">
        {!! Form::label('walk_3d_src', 'Spacer 3D (link)', ['class' => 'col-1 col-form-label pr-0']) !!}
        <div class="col-11">
            {!! Form::text('walk_3d_src', $apartment->walk_3d_src ?? null, ['class' => 'form-control']) !!}
        </div>
    </div>

    <div class="ta-center">
        <div class="d-inline-block">
            <button type="submit" class="btn btn-primary btn-lg">Zapisz</button>
        </div>
    </div>
    {!! Form::close() !!}

@endsection