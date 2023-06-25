@extends('layouts.nav')

@section('content')

    @auth
    <a href="{{route('tasks.create')}}">{{__('trans.create')}}</a>
    @endauth

    <div class="grid col-span-full">
        <h1 class="mb-5 flex grow h-14">{{__('trans.nav.tasks')}}</h1>
    <table class="mt-4">
        <thead class="border-b-2 border-solid border-black text-left">
        <th>{{__('trans.id')}}</th>
        <th>{{__('trans.task.status')}}</th>
        <th>{{__('trans.name')}}</th>
        <th>{{__('trans.task.author')}}</th>
        <th>{{__('trans.task.performer')}}</th>
        <th>{{__('trans.date')}}</th>
        <th></th>
        </thead>
    @foreach ($tasks as $task)
    
    <tbody>
    <tr>
        <td class="border-b border-dashed text-left">{{$task->id}}</td>
        <td class="border-b border-dashed text-left">{{$task->status}}</td>
        <td class="border-b border-dashed text-left"><a href="{{ route('tasks.show', ['task' => $task->id]) }}">{{$task->name}}</a></td>
        <td class="border-b border-dashed text-left">{{$task->author}}</td>
        <td class="border-b border-dashed text-left">{{$task->performer}}</td>
        <td class="border-b border-dashed text-left">{{$task->created_at->format('d.m.Y')}}</td>

        @auth
        <td class="border-b border-dashed text-left">
        <a href="{{ route('tasks.edit', ['task' => $task->id]) }}">{{__('trans.edit')}}</a>
        @can('delete', $task)
        <a href="{{ route('tasks.destroy', ['task' => $task->id]) }}" 
            data-confirm="Вы уверены?" 
            data-method="delete" 
            rel="nofollow">
                    {{__('trans.delete')}}       
        </a>
        @endcan

        </td>
        @endauth
    </tr>

    </tbody>
    @endforeach
    </table>
    </div>
@endsection