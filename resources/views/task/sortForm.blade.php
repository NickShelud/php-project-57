{{ Form::open(['route' => 'tasks.index', 'method' => 'GET']) }}
    {{ Form::select('filter[status_id]', $statuses, $filter['status_id'] ?? null, ['placeholder' => __('trans.task.status')]) }}
    {{ Form::select('filter[created_by_id]', $users, $filter['created_by_id'] ?? null, ['placeholder' => __('trans.task.author')]) }}
    {{ Form::select('filter[assigned_to_id]', $users, $filter['assigned_to_id'] ?? null, ['placeholder' => __('trans.task.performer')]) }}
    {{ Form::submit(__('trans.submit')) }}
{{ Form::close() }}