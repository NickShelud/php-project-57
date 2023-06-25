@section('header')
@extends('layouts.nav')
@endsection

@section('content')

@include('flash::message')

    @auth
    <a href="{{route('task_statuses.create')}}">{{__('trans.create')}}</a>
    @endauth
    <div class="grid col-span-full">
        <h1 class="mb-5 flex grow h-14">{{__('trans.nav.statuses')}}</h1>
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
            @endauth

        @auth
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