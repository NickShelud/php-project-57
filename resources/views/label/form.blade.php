<div class="flex flex-col w-50 mt-2">
    {{Form::label('name', __('trans.name'))}}
    {{Form::text('name')}}
    @if ($errors->has('name'))
        <div class="alert-danger">{{ str_replace('name', __('trans.label.label'), $errors->first('name')) }}</div>
    @endif
    {{Form::label('description', __('trans.task.description'))}}
    {{Form::textarea('description')}}
    @if ($errors->has('name'))
        <div class="alert-danger">{{ str_replace('name', __('trans.label.description'), $errors->first('description')) }}</div>
    @endif
</div>