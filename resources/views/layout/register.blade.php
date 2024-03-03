<html>
    <head>
        <title>Register to Math quest</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </head>
    <body style="height:100%;background-color: #f2f2f2;">
        <div class="container mt-5 d-flex align-items-center justify-content-center">
            @if($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="/register" method="POST" class="border rounded border-dark p-3" style="width:450px;background-color: #ffffff">
                @csrf
                <div class="mb-3 form-group">
                    <label for="exampleInputEmail1" class="form-label">Team Name</label>
                    <input type="text" name="team_name" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3 form-group">
                    <label for="exampleInputEmail1" class="form-label">Team member number #1</label>
                    <input type="text" name="member_name_1" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3 form-group">
                    <label for="exampleInputEmail1" class="form-label">Team member number #2</label>
                    <input type="text" name="member_name_2" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3 form-group">
                    <label for="exampleInputEmail1" class="form-label">Team member number #3</label>
                    <input type="text" name="member_name_3" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3 form-group">
                    <label for="exampleInputEmail1" class="form-label">Team member number #4</label>
                    <input type="text" name="member_name_4" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3 form-group">
                    <label for="exampleInputEmail1" class="form-label">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                </div>
                <div class="mb-3 form-group">
                    <label for="exampleInputPassword1" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </body>
</html>