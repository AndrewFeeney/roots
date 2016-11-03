@extends('layouts.app')

@section('content')
    <div class="container">
        <h3> Add Person </h3>
        {!! Form::open(['route' => 'person.store']) !!}
            <div class="form-group">
                {!! Form::label('first_name', 'First Name') !!}
                {!! Form::text('first_name', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('second_name', 'Middle Names') !!}
                {!! Form::text('second_name', null, ['class' => 'form-control']) !!}
                {!! Form::text('third_name', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('last_name', 'Last Name') !!}
                {!! Form::text('last_name', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('date_of_birth', 'Date of Birth') !!}
                {!! Form::date('date_of_birth', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('place_of_birth_id', 'Place of Birth') !!}
                {!! Form::select('place_of_birth_id', $places, null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('date_of_death', 'Date of Death') !!}
                {!! Form::date('date_of_death', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('place_of_death_id', 'Place of Birth') !!}
                {!! Form::select('place_of_death_id', $places, null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('father_id', 'Father') !!}
                {!! Form::select('father_id', $people, null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('mother_id', 'Mother') !!}
                {!! Form::select('mother_id', $people, null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::submit('Add Person') !!}
            </div>
        {!! Form::close() !!}
    </div>
@endsection
