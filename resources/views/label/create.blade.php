@extends('layouts.nav')

@section('content')
    {{ Form::model($label, ['route' => 'labels.store']) }}
    <div>
        <h1 class="mb-5 text-5xl max-w-screen-xl">{{__('trans.label.create')}}</h1>
    </div>
        @include('label.form')
        {{  Form::submit(__('trans.create'), ['class' => "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2" ])  }}
    {{ Form::close() }}
@endsection