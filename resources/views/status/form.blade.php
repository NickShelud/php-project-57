{{ Form::label('name', __('trans.taskStatus.name')) }}
{{ Form::text('name') }}
@if ($errors->has('name'))
    <div class="text-red-500">{{$errors->first('name') }}</div>
@endif