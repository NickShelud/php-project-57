{{ Form::label('name', 'Название') }}
{{ Form::text('name') }}
{{ Form::label('description', 'Описание') }}
{{ Form::textarea('description')}}
{{ Form::label('status_id', 'Статус') }}
{{ Form::select('status_id', $statuses, $tasks->status_id, ['placeholder' => "----------"]) }}
{{ Form::label('assigned_to_id', 'Исполнитель') }}
{{ Form::select('assigned_to_id', $performers, $tasks->assigned_to_id, ['placeholder' => "----------"]) }}