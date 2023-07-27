{{ Form::open(['route' => 'tasks.index', 'method' => 'GET']) }}
    {{ Form::select('filter[status_id]', $statuses, $filter['status_id'] ?? null, ['placeholder' => __('trans.task.status')]) }}
    {{ Form::select('filter[created_by_id]', $users, $filter['created_by_id'] ?? null, ['placeholder' => __('trans.task.author')]) }}
    {{ Form::select('filter[assigned_to_id]', $users, $filter['assigned_to_id'] ?? null, ['placeholder' => __('trans.task.performer')]) }}
    {{ Form::submit(__('trans.submit'), ['class' => "bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded ml-2" ]) }}
{{ Form::close() }}