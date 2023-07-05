@extends('layouts.nav')

@section('content')
    @include('flash::message')
    @auth
    <div>
        <a href="{{route('tasks.create')}}" 
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2" 
                onclick="event.preventDefault(); document.getElementById('create-form').submit();">{{__('trans.task.create')}}</a>

            <form id="create-form" action="{{route('tasks.create')}}" method="GET" style="display: none;">
                @csrf
            </form>    
        </div>
    @endauth

    <div class="grid col-span-full">
        <div>
            <h1 class="mb-5 text-5xl max-w-screen-xl">{{__('trans.nav.tasks')}}</h1>
        </div>

    @include('task.sortForm')
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
        <td class="border-b border-dashed text-left">{{$task->status->name}}</td>
        <td class="border-b border-dashed text-left"><a href="{{ route('tasks.show', ['task' => $task->id]) }}">{{$task->name}}</a></td>
        <td class="border-b border-dashed text-left">{{$task->creator->name}}</td>
        <td class="border-b border-dashed text-left">{{$task->performer->name}}</td>
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