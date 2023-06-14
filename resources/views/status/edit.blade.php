@extends('layouts.nav');

@section('content')
<br>
<br>
{{ Form::model($status, ['route' => ['task_statuses.update', $status], 'method' => 'PATCH']) }}
    @include('status.form')
    {{ Form::submit('Обновить') }}
{{ Form::close() }}
@endsection