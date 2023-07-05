@extends('layouts.nav');

@section('content')
<br>
<br>
{{ Form::model($taskStatus, ['route' => ['task_statuses.update', $taskStatus->id], 'method' => 'PATCH']) }}
    @include('status.form')
    {{ Form::submit(__('trans.update')) }}
{{ Form::close() }}
@endsection