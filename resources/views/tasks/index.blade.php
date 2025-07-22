@extends('layouts.app')

@section('content')

<h2>Things Todo List</h2>
<a href="{{ route('tasks.create') }}" class="btn btn-dark mb-2">Add Task</a>
<!-- 
@if (session('success'))
 <div class="alert alert-success"> {{ session('success') }} </div>
 @endif -->

 <table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th>Task ID</th>
            <th>Title</th>
            <th>Description</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($tasks as $task)
           <tr>
            <td>{{ $task->id }}</td>
            <td>{{ $task->title }}</td>
            <td>{{ $task->description }}</td>
            <td>
                <a href="{{ route('tasks.edit', $task) }}" class="btn btn-sm btn-dark"><i class="fas fa-edit"></i></a>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger" onclick="return confirm('Delete this task?')"><i class="fas fa-trash"></i></button>
           </form>
            </td>
           </tr>
        @empty
            <tr>
                <td colspan="4" class="text-center">No tasks found.</td>
            </tr>
        @endforelse
    </tbody>
 </table>
@endsection
