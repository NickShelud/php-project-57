@extends('layouts.nav');

@section('content')
<br>
<br>
{{ Form::model($status, ['route' => ['task_statuses.update', $status], 'method' => 'PATCH']) }}
    @include('status.form')
    <div>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    {{ Form::submit(__('trans.update')) }}
{{ Form::close() }}
@endsection