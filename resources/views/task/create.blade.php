@extends('layouts.nav')

@section('content');
{{ Form::model($tasks, ['route' => 'tasks.store']) }}
<div class="flex flex-col mt-4">    
    @include('task.form')
    {{ Form::submit(__('trans.task.create')) }}
</div>
{{ Form::close() }}
@endsection