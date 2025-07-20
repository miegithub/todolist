@extends('layouts.app')

@section('content')
<h2>{{ isset($task) ? 'Edit Task' : 'Add Task' }}</h2>
<form method="POST" action="{{ isset($task) ? route('tasks.update', $task) : route('tasks.store') }}">
    @csrf
    @if(isset($task))
        @method('PUT')
    @endif

    <div class="mb-3">
        <label class="form-label">Title</label>
        <input type="text" name="title" class="form-control" value="{{ old('title', $task->title ?? '') }}" required>
    </div>

    <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea name="description" class="form-control">{{ old('description', $task->description ?? '') }}</textarea>
    </div>

    <button class="btn btn-success">{{ isset($task) ? 'Update' : 'Create' }}</button>
    <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
</form>
@endsection
