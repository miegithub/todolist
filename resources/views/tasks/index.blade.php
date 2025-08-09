@extends('layouts.app')

@section('content')
<style>
   body {
    background: linear-gradient(
        to bottom,
        #ffe4ec,  
        #e0f7ff,  
        #f0e6ff,  
        #ffffff   
    );
    background-repeat: no-repeat;
    background-attachment: fixed;
    min-height: 100vh; 
}



    .container {
        background: white;
        border-radius: 12px;
        box-shadow: 0px 4px 20px rgba(0,0,0,0.05);
        padding: 2rem;
    }

    h2 {
        font-weight: bold;
        color: #343a40;
    }

    .list-group-item {
        border: none;
        border-bottom: 1px solid #f1f1f1;
        padding: 12px 16px;
        transition: background 0.2s ease;
    }

    .list-group-item:hover {
        background: #f8f9fa;
    }

    .btn-primary {
        background: #4f46e5; 
        border: none;
    }

    .btn-primary:hover {
        background: #4338ca;
    }
</style>

<div class="container mt-5">
    <h2 class="mb-4 text-center">📝 Things Todo List</h2>

    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">+ Add Task</a>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <ul class="list-group">
        @forelse ($tasks as $task)
            <li class="list-group-item d-flex align-items-center justify-content-between">
                <div class="form-check">
                    <form action="{{ route('tasks.toggle', $task) }}" method="POST" id="toggleForm-{{ $task->id }}">
                        @csrf
                        @method('PATCH')
                        <input 
                            type="checkbox" 
                            class="form-check-input me-2" 
                            onchange="document.getElementById('toggleForm-{{ $task->id }}').submit();" 
                            {{ $task->is_done ? 'checked' : '' }}>
                        
                        <label class="form-check-label {{ $task->is_done ? 'text-decoration-line-through text-muted' : '' }}">
                            {{ $task->title }}
                        </label>
                    </form>
                </div>

                <div>
                    <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-outline-dark">Edit</a>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this task?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-sm btn-outline-danger">Delete</button>
                    </form>
                </div>
            </li>
        @empty
            <li class="list-group-item text-center text-muted">No tasks found</li>
        @endforelse
    </ul>
</div>
@endsection
