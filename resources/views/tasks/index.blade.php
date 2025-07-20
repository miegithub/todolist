@extends('layouts.app')

@section('content')
<h2>Todo List</h2>
<a href="{{ route('tasks.create') }}" class="btn btn-primary mb-2">+ Add Task</a>
@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<ul class="list-group">
    @forelse ($tasks as $task)
        <li class="list-group-item d-flex justify-content-between">
            <div>
                <strong>{{ $task->title }}</strong> <br>
                <small>{{ $task->description }}</small>
            </div>
            <div>
                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                    @csrf @method('DELETE')
                    <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this task?')">Delete</button>
                </form>
            </div>
        </li>
    @empty
        <li class="list-group-item">No tasks found.</li>
    @endforelse
</ul>
@endsection
