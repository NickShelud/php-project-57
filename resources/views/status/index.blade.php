@section('header')
@extends('layouts.nav')
@endsection

@section('content')

@include('flash::message')

    @auth
        <div>
        <a href="{{route('task_statuses.create')}}" 
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2" 
                onclick="event.preventDefault(); document.getElementById('create-form').submit();">{{__('trans.taskStatus.create')}}</a>

            <form id="create-form" action="{{route('task_statuses.create')}}" method="GET" style="display: none;">
                @csrf
            </form>    
        </div>
    @endauth
    <div class="grid col-span-full">
        <div>
            <h1 class="mb-5 text-5xl max-w-screen-xl">{{__('trans.nav.statuses')}}</h1>
        </div>
    <table class="mt-4">
        <thead class="border-b-2 border-solid border-black text-left">
        <th>{{__('trans.id')}}</th>
        <th>{{__('trans.name')}}</th>
        <th>{{__('trans.date')}}</th>
        <th></th>
        </thead>
    @foreach ($statuses as $status)
    <tbody>
    <tr>
        <td class="border-b border-dashed text-left">{{$status->id}}</td>
        <td class="border-b border-dashed text-left">{{$status->name}}</td>
        <td class="border-b border-dashed text-left">{{$status->created_at}}</td>
        <td class="border-b border-dashed text-left">
    @auth
        <a href="{{ route('task_statuses.edit', ['task_status'=>$status->id]) }}">{{__('trans.edit')}}</a>
        <a href="{{ route('task_statuses.destroy', ['task_status'=>$status->id]) }}" 
            data-confirm="Вы уверены?" 
            data-method="delete" 
            rel="nofollow">
                {{__('trans.delete')}}
        </a>
    @endauth
    </td>
    </tr>

    </tbody>
    @endforeach
    </table>
    </div>

@endsection