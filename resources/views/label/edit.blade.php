@extends('layouts.nav')

@section('content')
    {{ Form::model($label, ['route' => ['labels.update', $label], 'method' => 'patch']) }}
        @include('label.form')
        {{ Form::submit(__('trans.update')) }}
    {{ Form::close() }}
@endsection