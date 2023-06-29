@extends('layouts.nav')

@section('content')

    @auth
    <a href="{{route('labels.create')}}">{{__('trans.create')}}</a>
    @endauth

    <div class="grid col-span-full">
        <h1 class="mb-5 flex grow h-14">{{__('trans.nav.label')}}</h1>
    <table class="mt-4">
        <thead class="border-b-2 border-solid border-black text-left">
        <th>{{__('trans.id')}}</th>
        <th>{{__('trans.name')}}</th>
        <th>{{__('trans.task.description')}}</th>
        <th>{{__('trans.date')}}</th>
        <th></th>
        </thead>
    @foreach ($labels as $label)
    @include('flash::message')
    <tbody>
    <tr>
        <td class="border-b border-dashed text-left">{{$label->id}}</td>
        <td class="border-b border-dashed text-left">{{$label->name}}</td>
        <td class="border-b border-dashed text-left">{{$label->description}}</td>
        <td class="border-b border-dashed text-left">{{$label->created_at->format('d.m.Y')}}</td>

        
        <td class="border-b border-dashed text-left">
        <a href="{{ route('labels.edit', ['label' => $label->id]) }}">{{__('trans.edit')}}</a>
        <a href="{{ route('labels.destroy', ['label' => $label->id]) }}" 
            data-confirm="Вы уверены?" 
            data-method="delete" 
            rel="nofollow">
                    {{__('trans.delete')}}       
        </a>

        </td>
        
    </tr>

    </tbody>
    @endforeach
    </table>
    </div>
@endsection