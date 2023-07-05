{{ Form::label('name', __('trans.taskStatus.name')) }}
{{ Form::text('name') }}
@if ($errors->has('name'))
    <div class="text-red-500">{{ str_replace('name', __('trans.taskStatus.status'), $errors->first('name')) }}</div>
@endif