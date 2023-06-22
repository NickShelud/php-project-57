@extends('layouts.nav')

@section('content')

<div class="grid col-span-full">
    <h2 class="mb-5">
        Просмотр задачи: {{$tasks->name}}        <a href="{{ route('tasks.edit', ['task' => $tasks->id]) }}">⚙</a>
        </h2>
        <p><span class="font-black">Имя:</span> {{ $tasks->name }}</p>
        <p><span class="font-black">Статус:</span> {{ $status[0] }}</p>
        <p><span class="font-black">Описание:</span> {{ $tasks->description }}</p>
                <p><span class="font-black">Метки:</span></p>
</div>

@endsection