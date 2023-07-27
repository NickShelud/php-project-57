@extends('layouts.nav')

@section('content')
    {{ Form::model($label, ['route' => ['labels.update', $label], 'method' => 'patch']) }}
    <div>
        <h1 class="mb-5 text-5xl max-w-screen-xl">{{__('trans.label.update')}}</h1>
    </div>
        @include('label.form')
        <div class="mt-2">
            {{ Form::submit(__('trans.update'), ['class' => "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2" ]) }}
        </div>
    {{ Form::close() }}
@endsection