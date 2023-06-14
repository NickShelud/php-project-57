@section('header')
@extends('layouts.nav')
@endsection

@section('content')

@include('flash::message')

    @auth
    <a href="{{route('task_statuses.create')}}">create</a>
    @endauth
    <table class="mt-4">
        <thead>
        <th class="border border-slate-300">ID</th>
        <th class="border border-slate-300">Имя</th>
        <th class="border border-slate-300">Дата создания</th>
        <th class="border border-slate-300"></th>
        </thead>
    @foreach ($statuses as $status)
    <tbody>
    <tr>
        <td class="border border-slate-300">{{$status->id}}</td>
        <td class="border border-slate-300">{{$status->name}}</td>
        <td class="border border-slate-300">{{$status->created_at}}</td>
        <td class="border border-slate-300">
            @auth
            <a href="{{ route('task_statuses.edit', ['task_status'=>$status->id]) }}">Edit</a>
            @endauth

        @auth
        <a href="{{ route('task_statuses.destroy', ['task_status'=>$status->id]) }}" 
            data-confirm="Вы уверены?" 
            data-method="delete" 
            rel="nofollow">
                Delete
        </a>
        @endauth
    </td>
    </tr>

    </tbody>
    @endforeach
    </table>

@endsection