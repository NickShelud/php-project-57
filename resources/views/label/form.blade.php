{{Form::label('name', __('trans.name'))}}
{{Form::text('name')}}
@if ($errors->has('name'))
    <div class="alert-danger">{{ str_replace('name', __('trans.label.label'), $errors->first('name')) }}</div>
@endif
{{Form::label('description', __('trans.task.description'))}}
{{Form::textarea('description')}}