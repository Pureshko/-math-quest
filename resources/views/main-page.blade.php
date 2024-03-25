@extends('layout.account')


@section('content')
    <div class="container flex">
        <a href="{{route('problemset')}}"><button class="btn btn-success">Problem set</button></a>
        <a href="{{route('leaderboard')}}"><button class="btn btn-primary">Leaderboard</button></a>
    </div>
@endsection('content')
