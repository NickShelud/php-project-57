@extends('layouts.nav')

@section('content')
{{ Form::model($task, ['route' => 'tasks.store']) }}
<div class="flex flex-col w-50"> 
<h1 class="mb-5 text-5xl max-w-screen-xl">
    {{ __('trans.task.createTask') }}
</h1>   
    @include('task.form')
    {{ Form::submit(__('trans.create'), ['class' => 'bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mt-2']) }}
</div>
{{ Form::close() }}
@endsection