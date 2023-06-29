@extends('layouts.nav')

@section('content')
    {{ Form::model($label, ['route' => 'labels.store']) }}
        @include('label.form')
        {{Form::submit(__('trans.create'))}}
    {{ Form::close() }}
@endsection