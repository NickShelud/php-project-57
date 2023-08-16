@extends('layouts.nav')

@section('content')

    @auth
        <div>
            <a href="{{route('labels.create')}}" 
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2" >{{__('trans.label.create')}}</a>  
        </div>
    @endauth
    <div class="grid col-span-full">
        <div>
            <h1 class="mb-5 text-5xl max-w-screen-xl">{{__('trans.nav.label')}}</h1>
        </div>
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

                        @auth
                            <td class="border-b border-dashed text-left">
                            <a href="{{ route('labels.edit', ['label' => $label->id]) }}">{{__('trans.edit')}}</a>
                            <a href="{{ route('labels.destroy', ['label' => $label->id]) }}" 
                                data-confirm="{{__('trans.dataConfirm')}}" 
                                data-method="delete" 
                                rel="nofollow">
                                        {{__('trans.delete')}}       
                            </a>
                            </td>
                        @endauth
                    </tr>
                </tbody>
            @endforeach
        </table>
    </div>
@endsection