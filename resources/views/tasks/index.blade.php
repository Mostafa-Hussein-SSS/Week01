<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Manager</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            background-color: #1b1a31;
            color: #fff;
            font-family: 'Arial', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: grid;
            grid-template-columns: 1fr 2fr 1fr;
            gap: 20px;
        }

        .tasks, .create-task, .completed-tasks, .task-editing {
            background-color: #252439;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0px 4px 15px rgba(0, 0, 0, 0.2);
        }

        .tasks h3, .completed-tasks h3, .task-editing h3 {
            color: #fe5f55;
            font-weight: normal;
            border-bottom: 1px solid #fe5f55;
            padding-bottom: 10px;
        }

        .tasks ul {
            list-style-type: none;
            margin-top: 10px;
        }

        .tasks ul li {
            background-color: #2b2a3f;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
        }

        .create-task h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .create-task input {
            width: 70%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            margin-right: 10px;
        }

        .create-task button {
            padding: 10px 20px;
            background-color: #fe5f55;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
        }

        .completed-tasks .completed-task {
            background-color: #2b2a3f;
            padding: 10px;
            border-radius: 5px;
            margin-top: 10px;
        }

        .completed-tasks .completed-task small {
            display: block;
            margin-top: 5px;
            color: #fe5f55
        ;
        }

        .task-editing input {
            width: 100%;
            padding: 10px;
            border-radius: 5px;
            border: none;
            margin-bottom: 10px;
        }

        .task-editing button {
            padding: 10px 20px;
            background-color: #fe5f55;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            color: #fff;
        }
    </style>
</head>
<body>
<div class="container">

    <!-- Task List -->
    <div class="tasks">
        <h3>Tasks</h3>
        <ul>
            @foreach ($tasks->where('is_completed', false) as $task)
                <li>
                    {{ $task->title }}
                    <form action="{{ route('tasks.complete', $task) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('PATCH')
                        <button type="submit">Complete</button>
                    </form>
                    <form action="{{ route('tasks.edit', $task) }}" method="GET" style="display:inline;">
                        <button type="submit">Edit</button>
                    </form>
                    <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete</button>
                    </form>
                </li>
            @endforeach
        </ul>
    </div>

    <!-- Create Task -->
    <div class="create-task">
        <h2>Create Task</h2>
        <form action="{{ route('tasks.store') }}" method="POST">
            @csrf
            <input type="text" name="title" placeholder="Build a Todo App..." required>
            <button type="submit">Submit</button>
        </form>
    </div>

    <!-- Completed Tasks -->
    <div class="completed-tasks">
        <h3>Completed Tasks</h3>
        @foreach ($tasks->where('is_completed', true) as $task)
            <div class="completed-task">
                <span>✔️ - {{ $task->title }}</span>
                <small>(Finished at: {{ $task->updated_at->format('m/d/Y h:i A') }})</small>
                <form action="{{ route('tasks.incomplete', $task) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PATCH')
                    <button type="submit">Uncomplete</button>
                </form>
                <form action="{{ route('tasks.destroy', $task) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </div>
        @endforeach
    </div>

    <!-- Task Editing -->
    @if (isset($editingTask))
        <div class="task-editing">
            <h3>Editing Task: {{ $editingTask->title }}</h3>
            <form action="{{ route('tasks.update', $editingTask) }}" method="POST">
                @csrf
                @method('PATCH')
                <input type="text" name="title" value="{{ $editingTask->title }}" required>
                <button type="submit">Update</button>
            </form>
        </div>
    @endif

</div>
</body>
</html>
