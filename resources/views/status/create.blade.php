@extends('layouts.nav')
@section('content')
<br>
<br>
{{ Form::model($status, ['route' => 'task_statuses.store']) }}
    @include('status.form')
    {{ Form::submit(__('trans.create')) }}
{{ Form::close() }}
@endsection