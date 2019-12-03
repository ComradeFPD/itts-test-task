@extends('layouts.main')
@section('content')
    <div class="container">
        <h2>Информация о студенте: {{ $student->createReduction() }}</h2>
        <div class="col-md-12">
            <form action="{{ route('students.update-post') }}" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="surname">Введите фамилию</label>
                    <input type="text" name="surname" class="form-control" id="surname" value="{{ $student->surname }}">
                </div>
                    <div class="form-group">
                        <label for="name">Введите имя</label>
                    <input type="text" name="name" class="form-control" id="name" value="{{ $student->name }}">
                    </div>
                    <div class="form-group">
                        <label for="patronymic">Введите отчество</label>
                    <input type="text" name="patronymic" class="form-control" id="patronymic" value="{{ $student->patronymic }}">
                    </div>
                    <div class="form-group">
                        <label for="birthday">Введите дату рождения</label>
                    <input type="text" onfocus="this.type='date';" name="birthday" id="birthday" class="form-control" placeholder="{{ \Carbon\Carbon::parse($student->birthday)->format('d.m.Y') }}">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-success" type="submit">Изменить</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    @endsection