<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <a href="{{ route('home') }}" class="btn btn-warning">Home</a>
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
        <form action="{{ route('elan.add') }}" method="POST">
            @csrf
            <div class="form-group container mt-4">
                <input placeholder="Title" name="title" type="text" class="d-block my-3">
                <select name="company_id" class="d-block my-3">
                    @foreach ($company as $com)
                        <option value="{{ $com->id }}">{{ $com->name }}</option>
                    @endforeach
                </select>
                @if (auth()->check())
                <input type="hidden" value="{{ auth()->user()->id }}" name="user_id" id="">
                <input class="d-block my-3" type="text" disabled placeholder="{{ auth()->user()->username }}" />
                <button class="btn btn-success mt-3 " type="submit">Send</button>   
            @else
                <p>Oturum açmış bir kullanıcı bulunmuyor.</p>
            @endif

            </div>
        </form>
    </div>
</body>

</html>
