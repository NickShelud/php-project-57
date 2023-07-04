{{ Form::label('name', __('trans.taskStatus.name')) }}
{{ Form::text('name') }}
@if ($errors->has('name'))
    <div class="alert-danger">{{ $errors->first('name') }}</div>
@endif