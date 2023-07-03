{{ Form::label('name', __('trans.name')), ['class' => 'mt-2'] }}
{{ Form::text('name')}}
{{ Form::label('description', __('trans.task.description')), ['class' => 'mt-2'] }}
{{ Form::textarea('description')}}
{{ Form::label('status_id', __('trans.task.status')), ['class' => 'mt-2'] }}
{{ Form::select('status_id', $statuses, $tasks->status_id, ['placeholder' => "----------"]) }}
{{ Form::label('assigned_to_id', __('trans.task.performer')), ['class' => 'mt-2'] }}
{{ Form::select('assigned_to_id', $users, $tasks->assigned_to_id, ['placeholder' => "----------"]) }}
{{ Form::label('label_id', __('trans.nav.label')), ['class' => 'mt-2'] }}
{{ Form::select('label_id', $labels, $tasks->label_id, ['placeholder' => '        ']) }}