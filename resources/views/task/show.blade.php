@extends('layouts.nav')

@section('content')

<div class="grid col-span-full">
    <h2 class="mb-5">
        {{__('trans.task.viewTask')}}: {{$tasks->name}}        <a href="{{ route('tasks.edit', ['task' => $tasks->id]) }}">⚙</a>
        </h2>
        <p><span class="font-black">{{__('trans.name')}}:</span> {{ $tasks->name }}</p>
        <p><span class="font-black">{{__('trans.task.status')}}:</span> {{ $status[0] }}</p>
        <p><span class="font-black">{{__('trans.task.description')}}:</span> {{ $tasks->description }}</p>
        <p><span class="font-black">{{__('trans.nav.label')}}:</span> {{ $label[0] }}</p>
</div>

@endsection