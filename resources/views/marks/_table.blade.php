
<table class="table">
    <tr>
        <th onclick="sortTable(0)">Название предемета</th>
        <th onclick="sortTable(1)">Оценка</th>
        <th>Действия</th>
    </tr>
    @foreach($marks as $mark)
        <tr>
            <td>{{ $mark->subject_title }}</td>
            <td>{{ $mark->mark }}</td>
            <td><a href="#" class="btn btn-danger delete-mark" data-id="{{ $mark->id }}">Удалить</a>
                <a href="{{ route('marks.update', [
                            'id' => $mark->id]) }}" class="btn btn-info">Изменить</a>
            </td>
        </tr>
    @endforeach
</table>
    {{ $marks->links() }}