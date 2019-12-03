
<table class="table hover" id="sortable">
    <tr>
        <th onclick="sortTable(0)">Фамилия</th>
        <th onclick="sortTable(1)">Имя</th>
        <th onclick="sortTable(2)">Отчество</th>
        <th onclick="sortTable(3)">Дата рождения</th>
        <th>Отметки</th>
        <th>Действия</th>
    </tr>
    @foreach($students as $student)
        <tr>
            <td>{{ $student->surname }}</td>
            <td>{{ $student->name }}</td>
            <td>{{ $student->patronymic }}</td>
            <td>{{ \Carbon\Carbon::parse($student->birthday)->format('d.m.Y')}}</td>
            <td><a href="{{ route('marks.view', [
                        'id' => $student->id]) }}" class="link">Посмотреть</a></td>
            <td>
                <a href="#" class="btn btn-danger delete-student" data-id="{{ $student->id }}">Удалить</a>
                <a href="{{ url(route('students.update', [
                            'id' => $student->id])) }}" class="btn btn-info">Обновить</a>
            </td>
        </tr>
    @endforeach
</table>
    {{ $students->links() }}

