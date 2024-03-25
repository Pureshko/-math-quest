@extends('layout.account')

@section('title', 'Problem Set')
@section('styles')
<link href="https://cdn.datatables.net/v/dt/dt-2.0.3/datatables.min.css" rel="stylesheet">
@endsection('styles')

@section('content')
    <div class="container m-2">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-problem" type="button" role="tab" aria-controls="nav-problem" aria-selected="true">Problems</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-submit" type="button" role="tab" aria-controls="nav-submit" aria-selected="false">Submit</button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-submissions" type="button" role="tab" aria-controls="nav-submissions" aria-selected="false">Submissions</button>
            </div>
        </nav>
        <div class="tab-content mt-2" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-problem" role="tabpanel" aria-labelledby="nav-home-tab">
                <div class="container text-center">
                    <div class="row">
                        <div class="col-9">
                            <table class="table">
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Problem</th>
                                    <th scope="col">Actions</th>
                                </tr>
                                @foreach($problems as $problem)
                                <tr>
                                    <td>{{$problem->id}}</td>
                                    <td>{{$problem->title}}</td>
                                    <td>
                                        <a href="/problem/{{$problem->id}}"><button class="btn bg-primary">View</button></a>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                        </div>
                        <div class="col-3">
                            <table class="table">
                                <tr>
                                    <th colspan="2">Rules</th>
                                </tr>
                                <tr>
                                    <th scope="col">Name</th>
                                    <th scope="col">Score</th>
                                </tr>
                                <tr class="table-danger">
                                    <td>Wrong Answer</td>
                                    <td>-50</td>
                                </tr>
                                @foreach($problems as $problem)
                                    <tr class="table-secondary">
                                        <td>{{$problem->title}}</td>
                                        <td>{{$problem->weight}}</td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    
                    </div>
                    
                </div>
            </div>
            <div class="tab-pane fade" id="nav-submit" role="tabpanel" aria-labelledby="nav-profile-tab">
                <form action="{{route('problem.submit')}}" method="POST">
                    @csrf
                    @if (session('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error') }}
                        </div>
                    @endif
                    @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                                <p>{{$error}}</p>
                            @endforeach
                        </div>
                    @endif
                    <div class="my-3">
                        <select name="problem_id" class="form-select mb-3">
                            @foreach($problems as $pc)
                                <option value="{{$pc->id}}" {{$pc->id==$problem->id ? 'selected' : ''}}>{{$pc->title}}</option>
                            @endforeach
                        </select>
                        <textarea class="form-control" name="answer" id="answer" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="tab-pane fade" id="nav-submissions" role="tabpanel" aria-labelledby="nav-contact-tab">
                <table class="table" id="submissions" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col" class="text-start">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col" class="text-start">Correct</th>
                            <th scope="col" class="text-start">Score</th>
                        </tr>
                    </thead>
                    
                </table>
            </div>
        </div>
    </div>
    
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
                    {data: 'title'},
                    {data: 'correct'},
                    {data: 'score'},
                ],
                columnDefs: [
                    {
                        targets: [0,1,3],
                        className: 'dt-body-left'
                    },
                    {
                        target: 2,
                        visible: false,
                    }
                ],
                createdRow: function(row, data, dataIndex) {
                    console.log(data);
                    if (data[2]) {
                        $(row).addClass('table-success');
                    } else {
                        $(row).addClass('table-danger');
                    }
                }
            });
        }

        loadSubmissions();
    </script>
@endsection('scripts')
