@extends('layouts.main')
@section('content')
    <div class="container">
        <h2>Список студентов</h2>
        <div class="col-md-12" style="display: flex">
            <div class="col-md-4" style="margin: 10px 0">
                <a href="{{ route('students.create') }}" class="btn btn-success">Добавить нового студента</a>
            </div>
            <div class="col-md-8" style="margin: 10px 0">
                <input type="text" class="form-control" id="search" placeholder="Начните вводить текст для поиска по фамилии...">
            </div>
        </div>
        <div class="col-md-12">
            <div id="table">
        @include('students._table', [
        'students' => $students])
        </div>
        </div>
    </div>
    @endsection
@push('scripts')

    <script>
        $(document).ready(function () {
            $('.delete-student').click(function (e) {
                e.preventDefault();
                if(confirm('Действительно удалить этого студента?')) {
                    let id = this.dataset.id;
                    $.get('/students/delete/'+id, function (data) {
                        alert('Студент успешно удалён');
                        window.location.reload();
                    });
                };
            })

            $('#search').change(function (e) {
                $.post('/students/search', {
                    'q': $('#search').val(),
                    '_token': '{{ csrf_token() }}'
                }, function (data) {
                   $('#table').html(data);
                })
            })
        })
    </script>
    <script>
        function sortTable(n) {
            var table, rows, switching, i, x, y, shouldSwitch, dir, switchcount = 0;
            table = document.getElementById("sortable");
            switching = true;
            // Set the sorting direction to ascending:
            dir = "asc";
            /* Make a loop that will continue until
            no switching has been done: */
            while (switching) {
                // Start by saying: no switching is done:
                switching = false;
                rows = table.rows;
                /* Loop through all table rows (except the
                first, which contains table headers): */
                for (i = 1; i < (rows.length - 1); i++) {
                    // Start by saying there should be no switching:
                    shouldSwitch = false;
                    /* Get the two elements you want to compare,
                    one from current row and one from the next: */
                    x = rows[i].getElementsByTagName("TD")[n];
                    y = rows[i + 1].getElementsByTagName("TD")[n];
                    /* Check if the two rows should switch place,
                    based on the direction, asc or desc: */
                    if (dir == "asc") {
                        if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                            // If so, mark as a switch and break the loop:
                            shouldSwitch = true;
                            break;
                        }
                    } else if (dir == "desc") {
                        if (x.innerHTML.toLowerCase() < y.innerHTML.toLowerCase()) {
                            // If so, mark as a switch and break the loop:
                            shouldSwitch = true;
                            break;
                        }
                    }
                }
                if (shouldSwitch) {
                    /* If a switch has been marked, make the switch
                    and mark that a switch has been done: */
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                    // Each time a switch is done, increase this count by 1:
                    switchcount ++;
                } else {
                    /* If no switching has been done AND the direction is "asc",
                    set the direction to "desc" and run the while loop again. */
                    if (switchcount == 0 && dir == "asc") {
                        dir = "desc";
                        switching = true;
                    }
                }
            }
        }
    </script>
    @endpush