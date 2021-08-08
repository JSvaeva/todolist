<!--

    Don't forget to run
    "create database todolist"
    and 
    "php artisan migrate"
    before opening site
    to create the db and table.

-->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>To-Do List</title>

        <!-- Styles -->
        <link href="/css/app.css" rel="stylesheet">
    </head>

    <body>
        <div class="block">
            <h1>To-Do List</h1>

            <form class="task-row" action="/save" method="POST">
                @csrf
                <input type="submit" class="btn add-button" value="+"></input>
                <input type="text" id="task" name="task" class="save-input" maxlength="20" required></input>
            </form>

            <div class="tasks-list">

            @foreach ($tasks as $task)
                @if ($task['is_done'])
                <div class="task-row done-text">
                @else
                <div class="task-row" method="POST">
                @endif
                    <form action="/changestatus/{{ $task->id }}" method="POST">
                    @csrf
                    @if ($task['is_done'])
                        <input type="submit" class="btn done-button" value="✓"></input>
                    @else
                        <input type="submit" class="btn not-done-button" value="!!!"></input>
                    @endif
                    </form>

                    <form action="/editname/{{ $task->id }}" method="POST">
                    @csrf
                    @if ($task['is_editing'])
                        <input type="submit" class="btn edit-button editing" value="✎"></input>
                        <form action="/delete/{{ $task->id }}" method="POST">
                        <input type="text" value="{{$task->task}}" name="new_task" class="input-editing" maxlength="20" required></input>
                    @else
                        <input type="submit" class="btn edit-button" value="✎"></input>
                        <form action="/delete/{{ $task->id }}" method="POST">
                        {{$task['task']}}
                    @endif
                    </form>
                    
                    @csrf
                    @method('DELETE')
                    <input type="submit" class="btn del-button" value="x"></input>
                    </form>
                </div>
            @endforeach
            
            @if (count($tasks) == 0)
                <p>No tasks found.</p>
            @endif
            </div>
        </div>
    </body>
</html>
