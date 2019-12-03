@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="col-md-12">
            <h2>Добавить нового студента</h2>
        </div>
        <div class="col-md-12">
            <form action="{{ route('students.create-post') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="surname">Введите фамилию</label>
                    <input type="text" name="surname" class="form-control" id="surname">
                </div>
                <div class="form-group">
                    <label for="name">Введите имя</label>
                    <input type="text" name="name" class="form-control" id="name">
                </div>
                <div class="form-group">
                    <label for="patronymic">Введите отчество</label>
                    <input type="text" name="patronymic" class="form-control" id="patronymic">
                </div>
                <div class="form-group">
                    <label for="birthday">Введите дату рождения</label>
                    <input type="date"  name="birthday" id="birthday" class="form-control">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">Создать</button>
                </div>
        </form>
        </div>
    </div>
    @endsection