@extends('layout.account')

@section('title', 'Submission Answer')

@section('content')
    <div>
        <h1>{{$submission->problem->title}}</h1>
        <p>Your answer: {{$submission->answer}}</p>
        <p>Score: {{$submission->score}}</p>
    </div>
@endsection('content')