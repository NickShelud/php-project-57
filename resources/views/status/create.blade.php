@extends('layouts.nav')
@section('content')
{{ Form::model($status, ['route' => 'task_statuses.store']) }}
    <div>
        <h1 class="mb-5 text-5xl max-w-screen-xl">{{__('trans.taskStatus.create')}}</h1>
    </div>
    @include('status.form')
    {{ Form::submit(__('trans.create'), ['class' => "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2 mt-2" ]) }}
{{ Form::close() }}
@endsection