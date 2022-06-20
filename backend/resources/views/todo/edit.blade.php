@extends('layouts.app')

@section('title', 'Edit')

@section('content')
{{--  Copy the form from index page --}}
<h1 class="h4">Edit Task</h1>

<form action="{{ route('update', $task->id)}}" method="post" class="row mb-3">
    @csrf
    @method('PATCH')

    <div class="col-10 pe-0">
        <input type="text" name="task" placeholder="Edit task..." class="form-control" value="{{ old('task', $task->task) }}" autofocus>
    </div>
    <div class="col-2">
        <button type="submit" class="btn btn-warning w-100"><i class="fa-solid fa-check"></i> Update</button>
    </div>
    @error('task')
    <p class="text-danger small">{{ $message }}</p>
    @enderror
</form>
@endsection
