@extends('layouts.nav')

@section('content')

<div class="grid col-span-full">
    <h2 class="mb-5">
        {{__('trans.task.viewTask')}}: {{$task->name}} <a href="{{ route('tasks.edit', $task) }}">⚙</a>
        </h2>
        <p><span class="font-black">{{__('trans.name')}}:</span> {{ $task->name }}</p>
        <p><span class="font-black">{{__('trans.task.status')}}:</span> {{ $task->status->name }}</p>
        <p><span class="font-black">{{__('trans.task.description')}}:</span> {{ $task->description }}</p>
        <p><span class="font-black">{{__('trans.nav.label')}}:</span> {{ $task->label->name ?? '' }}</p>
</div>

@endsection