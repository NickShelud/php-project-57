@extends('layouts.nav')

@section('content')
    {{ Form::model($task, ['route' => ['tasks.update', $task], 'method' => 'PATCH']) }}
    <div class="flex flex-col w-50">
        @include('task.form')
        {{ Form::submit(__('trans.task.update'))}}
    </div>
    {{ Form::close() }}

@endsection