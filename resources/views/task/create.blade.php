@extends('layouts.app')

@section('content')
    <div class="container">
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                <div class="alert alert-danger" role="alert">
                    {{ $error }}
                </div>
            @endforeach
        @endif
        <div class="card bg-white">
            <div class="card-body">
                <form method="POST" action="{{ $action }}">
                    @csrf
                    @method($method)
                    <div class="mb-3">
                        <label for="input_title" class="form-label">Заголовок</label>
                        <input name="title" class="form-control" id="input_title" value="{{ $task->title ?? old("title") }}">
                    </div>
                    <div class="mb-3">
                        <label for="input_task" class="form-label">Задача</label>
                        <textarea required name="description" class="form-control" id="input_task" rows="10">{{ $task->description ?? old("description") }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="input_users" class="form-label">Испольнитель</label>
                        <select required type="password" name="executor_id" id="input_users" class="form-control">
                            @foreach($users as $user)
                                <option @if((isset($task) && $user->id == $task->executor_id) || ($user->id == old("executor_id"))) selected @endif value="{{ $user->id }}">{{ $user->name }} - {{ $user->email }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="input_date" class="form-label">Дата Окончания</label>
                        <input value="{{ $task->deadline ?? old("deadline") }}" required type="date" name="deadline" class="form-control" id="input_date" >
                    </div>
                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">Добавить</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
