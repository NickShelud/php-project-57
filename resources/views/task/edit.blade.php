@extends('layouts.nav')

@section('content')
    {{ Form::model($task, ['route' => ['tasks.update', $task], 'method' => 'PATCH']) }}
    <div>
        <h1 class="mb-5 text-5xl max-w-screen-xl">{{__('trans.task.update')}}</h1>
    </div>
    <div class="flex flex-col w-50">
        @include('task.form')
    </div>
    {{ Form::submit(__('trans.update'), ['class' => "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2 mt-2" ]) }}
    {{ Form::close() }}

@endsection