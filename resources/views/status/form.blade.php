<div class="flex flex-col w-50">
    {{ Form::label('name', __('trans.taskStatus.name'), ['class' => 'pt-2 pb-2']) }}
    {{ Form::text('name') }}
    @if ($errors->has('name'))
        <div class="text-red-500">{{ str_replace('name', __('trans.taskStatus.status'), $errors->first('name')) }}</div>
    @endif
</div>