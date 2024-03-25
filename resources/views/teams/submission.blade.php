@extends('layout.account')

@section('title', 'Submissions')

@section('styles')
<link href="https://cdn.datatables.net/v/dt/dt-2.0.3/datatables.min.css" rel="stylesheet">
@endsection('styles')

@section('content')
    <table class="table" id="submissions" style="width:100%">
        <thead>
            <tr>
                <th scope="col" class="text-start">Team_name</th>
                <th scope="col">Title</th>
                <th scope="col" class="text-start">Correct</th>
                <th scope="col" class="text-start">Score</th>
            </tr>
        </thead>
    </table>
@endsection('content')

@section('scripts')
    <script src="https://cdn.datatables.net/v/dt/dt-2.0.3/datatables.min.js"></script>
    <script>
        function loadSubmissions() {
            $('#submissions').DataTable({
                dom: "rtp",
                data: {{Illuminate\Support\Js::from($submissions);}},
                columns: [
                    {data: 'id'},
                    {data: 'team_name'},
                    {data: 'title'},
                    {data: 'correct'},
                    {data: 'score'},
                ],
                columnDefs: [
                    {
                        targets: [1,2,4],
                        className: 'dt-body-left'
                    },
                    {
                        targets: [3,0],
                        visible: false,
                    },
                ],
                createdRow: function(row, data, dataIndex) {
                    console.log(data);
                    if (data.correct) {
                        $(row).addClass('table-success');
                    } else {
                        $(row).addClass('table-danger');
                    }
                },
                order: [[0, 'desc']],
            });
        }

        loadSubmissions();
    </script>
@endsection('scripts')

