@extends('layout.account')

@section('title', $problem->title)

@section('content')
    <div class="container m-2">
        <nav>
            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-problem" type="button" role="tab" aria-controls="nav-problem" aria-selected="true">Problem</button>
                <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-submit" type="button" role="tab" aria-controls="nav-submit" aria-selected="false">Submit</button>
                <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-submissions" type="button" role="tab" aria-controls="nav-submissions" aria-selected="false">Submissions</button>
            </div>
        </nav>
        <div class="tab-content mt-2" id="nav-tabContent">
            <div class="tab-pane fade show active" id="nav-problem" role="tabpanel" aria-labelledby="nav-home-tab">
                <h1>
                    {{$problem->title}}
                </h1>
                <p>
                    {{$problem->description}}
                </p>
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
                            @foreach($problem_choices as $pc)
                                <option value="{{$pc->id}}" {{$pc->id==$problem->id ? 'selected' : ''}}>{{$pc->title}}</option>
                            @endforeach
                        </select>
                        <textarea class="form-control" name="answer" id="answer" rows="3"></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
            <div class="tab-pane fade" id="nav-submissions" role="tabpanel" aria-labelledby="nav-contact-tab">
                <table class="table">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Solution</th>
                        <th scope="col">Correct</th>
                    </tr>
                    @foreach($submissions as $submission)
                        <tr @class([
                                'table-success' => $submission->correct,
                                'table-danger' => ! $submission->correct
                            ])>
                            <td>{{$submission->id}}</td>
                            <td>{{$submission->title}}</td>
                            <td>{{$submission->score}}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    
@endsection('content')