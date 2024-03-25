@extends('layout.account')

@section('title', 'Leaderboard')

@section('styles')
<link href="https://cdn.datatables.net/v/dt/dt-2.0.3/datatables.min.css" rel="stylesheet">
@endsection('styles')

@section('content')
    
    <table class="table mt-3" style="width:100%" id="nu_teams_table">
        <thead>
            <tr>
                <th colspan="2">NU leaderboard</th>
            </tr>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Score</th>
            </tr>
        </thead>
    </table>
    <table class="table mt-3" style="width:100%" id="non_nu_teams_table">
        <thead>
            <tr>
                <th colspan="3">Non-NU leaderboard</th>
            </tr>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">University</th>
                <th scope="col">Score</th>
            </tr>
        </thead>
        
        @foreach($teams_non_nu as $team)
            <tr>
                <td>{{$team->team_name}}</td>
                <td>{{$team->uni_name}}</td>
                <td>{{$team->total_score}}</td>
            </tr>
        @endforeach
    </table>
    <table class="table mt-3" style="width:100%" id="general_teams_table">
        <thead>
            <tr>
                <th colspan="3">General leaderboard</th>
            </tr>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">University</th>
                <th scope="col">Score</th>
            </tr>
        </thead>
        
    </table>


@endsection('content')

@section('scripts')
    <script src="https://cdn.datatables.net/v/dt/dt-2.0.3/datatables.min.js"></script>
    <script>
        function loadSubmissions() {
            $('#nu_teams_table').DataTable({
                dom: "rtp",
                data: {{Illuminate\Support\Js::from($teams_nu);}},
                columns: [
                    {data: 'team_name'},
                    {data: 'total_score'},
                ],
                columnDefs: [
                    {
                        targets: [0,1],
                        className: 'dt-body-left'
                    },
                ],
            });
            $('#non_nu_teams_table').DataTable({
                dom: "rtp",
                data: {{Illuminate\Support\Js::from($teams_non_nu);}},
                columns: [
                    {data: 'team_name'},
                    {data: 'uni_name'},
                    {data: 'total_score'},
                ],
                columnDefs: [
                    {
                        targets: [0,1,2],
                        className: 'dt-body-left'
                    },
                ],
            });
            $('#general_teams_table').DataTable({
                dom: "rtp",
                data: {{Illuminate\Support\Js::from($teams_general);}},
                columns: [
                    {data: 'team_name'},
                    {data: 'uni_name'},
                    {data: 'total_score'},
                ],
                columnDefs: [
                    {
                        targets: [0,1,2],
                        className: 'dt-body-left'
                    },
                ],
            });
        }

        loadSubmissions();
    </script>
@endsection('scripts')