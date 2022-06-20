@extends('layouts.app')

@section('title', 'Index')

@section('content')
<h1 class="h4">Todo App</h1>

<form action="{{ route('store') }}" method="post" class="row mb-3">
    @csrf
    {{-- cross-site request forgeries : validate the requests --}}

    <div class="col-10 pe-0">
        <input type="text" name="task" placeholder="Create a task" class="form-control" value="{{ old('task')}}" autofocus>
    </div>
    <div class="col-2">
        <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-plus"></i> Add</button>
    </div>
    @error('task')
    <p class="text-danger small">{{ $message }}</p>
    @enderror
</form>

@if ($all_tasks->isNotEmpty())
<ul class="list-group">
    @foreach ($all_tasks as $task)
    <li class="list-group-item d-flex align-items-center">
        <div class="me-auto">
            {{ $task->task}}
        </div>
        <form action="{{ route('destroy', $task->id)}}" method="post">
            @csrf
            @method('DELETE')

            <a href="{{ route('edit', $task->id) }}" class="btn btn-primary btn-sm" title="Edit"><i class="fa-solid fa-pen"></i></a>
            <button type="submit" class="btn btn-danger btn-sm" title="Delete"><i class="fa-solid fa-trash-can"></i></button>
        </form>
    </li>
    @endforeach
</ul>
@endif
@endsection
