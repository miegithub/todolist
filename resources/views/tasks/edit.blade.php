@extends('layouts.app')

@section('content')
    <h2>Edit Task</h2>

    

    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT') 
       
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" value="{{ old('title', $task->title) }}" class="form-control" required>
            
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control">{{ old('description', $task->description) }}</textarea>
       

        </div>

       <div class="text-end">
        <button type="submit" class="btn btn-dark">Update Task</button>
        <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
    </form>
    </div>
@endsection
