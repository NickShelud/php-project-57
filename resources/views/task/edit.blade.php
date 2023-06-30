@extends('layouts.nav')

@section('content')
    {{ Form::model($tasks, ['route' => ['tasks.update', $tasks], 'method' => 'PATCH']) }}
    <div class="flex flex-col">
        @include('task.form')
        {{ Form::submit(__('trans.task.update'))}}
    </div>
    {{ Form::close() }}

@endsection