<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test task</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <style>
        .app{
            margin-top: 20px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <ul class="navbar-nav mr-auto">
        <li class="nav-items">
            <a href="{{ route('students.view') }}" class="nav-link">Список студентов</a>
        </li>
        <li class="nav-items">
            <a href="{{ route('students.create') }}" class="nav-link">Добавить нового студента</a>
        </li>
        <li class="nav-items">
            <a href="{{ route('marks.create') }}" class="nav-link">Создать отметку</a>
        </li>
    </ul>
</nav>
<div class="app">
    @yield('content')
</div>
<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
    @stack('scripts')
</body>
</html>