@extends('layout.account')


@section('content')
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
    <div class="container flex">
        <a href="{{route('problemset')}}"><button class="btn btn-success">Problem set</button></a>
        <a href="{{route('leaderboard')}}"><button class="btn btn-primary">Leaderboard</button></a>
    </div>
@endsection('content')
