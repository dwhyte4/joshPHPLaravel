@extends('base')

@section('main')
<div class="row">
<div class="col-sm-12">
    <h1 class="display-3">Daily Task</h1>
    <p>
    <a style="margin: 19px;" href="{{ route('tasks.create') }}" class="btn btn-primary">Create New Task</a>
  </p>
  <table class="table table-striped">
    <thead>
        <tr>
          <td>ID</td>
          <td>User ID</td>
          <td>Name</td>
          <td>Completed?</td>
          <td>Created at</td>
          <td>Updated at</td>
          <td colspan = 2>Actions</td>
        </tr>
    </thead>
    <tbody>
        @foreach($tasks as $task)
        <!--explanation needed-->
        <tr>
            <td>{{$task->id}}</td>
            <td>{{$task->user_id}}</td>
            <td>{{$task->name}}</td>
            <td>
              <form method="post" action="/tasks/{{ $task->id }}">
                @csrf
                @method('PATCH')
                <input type="checkbox" name="completed" value="1" onchange="this.form.submit()" @if($task->completed) checked @endif>
                <input type="hidden" name="name" value="{{ $task->name }}">
              </form>
            </td>
            <td>{{$task->created_at}}</td>
            <td>{{$task->updated_at}}</td>
            <td>
                <a href="{{ route('tasks.edit',$task->id)}}" class="btn btn-primary">Edit</a>
            </td>
            <td>
                <form action="{{ route('tasks.destroy', $task->id)}}" method="post">
                  @csrf <!--To validate request, a hidden token-->
                  @method('DELETE')
                  <button class="btn btn-danger" type="submit">Delete</button>
                </form>
            </td>
        </tr>
        @endforeach
    </tbody>
  </table>
  <div class="col-sm-12">

  @if(session()->get('success'))
    <div class="alert alert-success">
      {{ session()->get('success') }}
    </div>
  @endif
</div>

@endsection
