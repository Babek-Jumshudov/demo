<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Post add</title>
</head>

<body>
    <div class="container">
        <a href="{{route("home")}}" class="btn btn-warning">Home</a>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if (session('error'))
            <div class="alert alert-success">
                {{ session('error') }}
            </div>
        @endif
        <form action="{{ route('post.upload') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group container mt-4">
                <label for="img">Image:</label>
                <input type="file"  name="image" class="form-control-file" id="img">
                <input class="form-control"  name="description" type="text" placeholder="Description">
                <button class="btn btn-success mt-2" type="submit">Send</button>
            </div>
        </form>
    </div>
</body>

</html>
