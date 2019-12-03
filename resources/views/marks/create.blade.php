@extends('layouts.main')
@section('content')
    <div class="container">
        <div class="col-md-12">
            <h2 class="title">
                Добавить оценку
            </h2>
        </div>
        <div class="col-md-12">
            <form action="{{ route('marks.create-post') }}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="student">Выберите студента из списка</label>
                    <select name="student_id" class="custom-select" id="student">
                        @foreach($students as $student)
                            <option value="{{ $student->id }}">{{ $student->createReduction() }}</option>
                            @endforeach
                    </select>
                </div>
                
                <div class="form-group">
                    <label for="subject">Введите название предмета</label>
                    <input type="text" name="subject_title" class="form-control" id="subject" placeholder="Введите название предмета">
                </div>
                <div class="form-group">
                    <label for="mark">Введите оценку</label>
                    <input type="number" min="1" name="mark" class="form-control" id="mark" placeholder="Введите оценку">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">Создать</button>
                </div>
            </form>
        </div>
    </div>
    @endsection