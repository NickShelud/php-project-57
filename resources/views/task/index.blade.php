@extends('layouts.nav')

@section('content')

    <a href="{{route('tasks.create')}}">create</a>

    <div class="grid col-span-full">
        <h1 class="mb-5 flex grow h-14">Задачи</h1>
    <table class="mt-4">
        <thead class="border-b-2 border-solid border-black text-left">
        <th>ID</th>
        <th>Статус</th>
        <th>Имя</th>
        <th>Автор</th>
        <th>Исполнитель</th>
        <th>Дата создания</th>
        <th></th>
        </thead>
    @foreach ($tasks as $task)
    {{$task}}
    <tbody>
    <tr>
        <td class="border-b border-dashed text-left">{{$task->id}}</td>
        <td class="border-b border-dashed text-left">{{$task->status}}</td>
        <td class="border-b border-dashed text-left"><a href="{{ route('tasks.show', ['task' => $task->id]) }}">{{$task->name}}</a></td>
        <td class="border-b border-dashed text-left">{{$task->author}}</td>
        <td class="border-b border-dashed text-left">{{$task->assigned_to_id}}</td>
        <td class="border-b border-dashed text-left">{{$task->created_at->format('d.m.Y')}}</td>


        <td class="border-b border-dashed text-left">
        <a href="{{ route('tasks.edit', ['task' => $task->id]) }}">Edit</a>
        <a href="{{ route('tasks.destroy', ['task' => $task->id]) }}" 
            data-confirm="Вы уверены?" 
            data-method="delete" 
            rel="nofollow">
                Delete
        </a>

    </td>
    </tr>

    </tbody>
    @endforeach
    </table>
    </div>
@endsection