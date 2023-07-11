{{ Form::label('name', __('trans.name')), ['class' => 'mt-2'] }}
{{ Form::text('name')}}
@if ($errors->has('name'))
    <div class="alert-danger">{{ str_replace('name', __('trans.task.task'), $errors->first('name')) }}</div>
@endif
{{ Form::label('description', __('trans.task.description')), ['class' => 'mt-2'] }}
{{ Form::textarea('description')}}
{{ Form::label('status_id', __('trans.task.status')), ['class' => 'mt-2'] }}
{{ Form::select('status_id', $statuses, $task->status_id, ['placeholder' => "----------"]) }}
@if ($errors->has('status_id'))
    <div class="alert-danger">{{ $errors->first('status_id') }}</div>
@endif
{{ Form::label('assigned_to_id', __('trans.task.performer')), ['class' => 'mt-2'] }}
{{ Form::select('assigned_to_id', $users, $task->assigned_to_id, ['placeholder' => "----------"]) }}
{{ Form::label('label_id', __('trans.nav.label')), ['class' => 'mt-2'] }}
{{ Form::select('label_id', $labels, $task->label_id, ['placeholder' => '        ']) }}