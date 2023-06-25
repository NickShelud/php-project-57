{{ Form::label('name', __('trans.name')) }}
{{ Form::text('name') }}
{{ Form::label('description', __('trans.task.description')) }}
{{ Form::textarea('description')}}
{{ Form::label('status_id', __('trans.task.status')) }}
{{ Form::select('status_id', $statuses, $tasks->status_id, ['placeholder' => "----------"]) }}
{{ Form::label('assigned_to_id', __('trans.task.performer')) }}
{{ Form::select('assigned_to_id', $users, $tasks->assigned_to_id, ['placeholder' => "----------"]) }}