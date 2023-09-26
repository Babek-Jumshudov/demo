<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Home</title>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Poppins:wght@200;300;400;500;600;700&display=swap');

        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        img {
            width: 100%;
        }

        body {
            background: #e4e9f7;
        }

        .container {
            display: flex;
            align-items: center;
            justify-content: center;
            min-height: 90vh;
        }

        .box {
            background: #fdfdfd;
            display: flex;
            flex-direction: column;
            padding: 25px 25px;
            border-radius: 20px;
            box-shadow: 0 0 128px 0 rgba(0, 0, 0, 0.1),
                0 32px 64px -48px rgba(0, 0, 0, 0.5);
        }

        .form-box {
            width: 450px;
            margin: 0px 10px;
        }

        .form-box header {
            font-size: 25px;
            font-weight: 600;
            padding-bottom: 10px;
            border-bottom: 1px solid #e6e6e6;
            margin-bottom: 10px;
        }

        .form-box form .field {
            display: flex;
            margin-bottom: 10px;
            flex-direction: column;

        }

        .form-box form .input input {
            height: 40px;
            width: 100%;
            font-size: 16px;
            padding: 0 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            outline: none;
        }

        .btn {
            /* height: 35px; */
            /* background: rgba(76, 68, 182, 0.808); */
            border: 0;
            border-radius: 5px;
            color: #fff;
            font-size: 15px;
            cursor: pointer;
            transition: all .3s;
            /* margin-top: 10px; */
            padding: 10px;
        }

        .btn:hover {
            opacity: 0.82;
        }

        .submit {
            width: 100%;
        }

        .links {
            margin-bottom: 15px;
        }

        /********* Home *****************/

        .nav {
            background: #fff;
            display: flex;
            flex-direction: row;
            justify-content: space-around;
            line-height: 60px;
            z-index: 100;
        }

        .logo {
            font-size: 25px;
            font-weight: 900;

        }

        .logo a {
            text-decoration: none;
            color: #000;
        }

        .right-links a {
            padding: 0 10px;
        }

        main {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 60px;
        }

        .main-box {
            display: flex;
            flex-direction: column;
            width: 70%;
        }

        .main-box .top {
            display: flex;
            flex-direction: row;
            justify-content: space-between;
        }

        .bottom {
            width: 100%;
            margin-top: 20px;
        }

        @media only screen and (max-width:840px) {
            .main-box .top {
                display: flex;
                flex-direction: column;
                justify-content: space-between;
            }

            .top .box {
                margin: 10px 10px;
            }

            .bottom {
                margin-top: 0;
            }
        }

        .message {
            text-align: center;
            background: #f9eded;
            padding: 15px 0px;
            border: 1px solid #699053;
            border-radius: 5px;
            margin-bottom: 10px;
            color: red;
        }
    </style>
</head>

<body>
    <div class="nav">
        <div class="logo">
            <p><a>Logo</a> </p>
        </div>

        @if (Auth::check())
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button class="btn btn-warning" type="submit">Log Out</button>
            </form>
            <a class="btn btn-warning" href='{{ route('companyAdd') }}'>Sirket Add</a>
        @else
            <a href="{{ route('login') }}">Log In</a>
        @endif

    </div>
    <a class="btn btn-success" href='{{ route('post.add') }}'>Post Add</a>
    <a class="btn btn-danger" href='{{ route('elan.store') }}'>Elan Add</a>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container">
        <div style="gap: 10px">
            @foreach ($errors->all() as $error)
                <li class="text-danger">{{ $error }}</li>
            @endforeach
            <div style="display: flex">
                <h1>Postlar:</h1>
                @forelse ($posts as $post)
                    <div style="max-width: 240px" class="border border-primary p-1">
                        <div>
                            <img src='{{ asset("/uploads/{$post->image}") }}' alt="">
                        </div>
                        <div class="d-flex justify-content-between">
                            <p>{{ $post->description }}</p>
                            <p class="d-flex">Like: {{ $post->like }} <input type="checkbox"></p>
                        </div>
                        <div>
                            Yazar: {{ $post->user->username }}
                        </div>
                        <div style="display: flex">
                            <a class="btn btn-warning mr-3"
                                href="{{ route('post.edit', ['post' => $post->id]) }}">Edit</a>
                            <form action="{{ route('post.delete', ['post' => $post->id]) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button class="btn btn-danger" type="submit">Delete</button>
                            </form>
                        </div>
                        <form method="POST" action="{{ route('comments.store') }}" class="d-flex">
                            @csrf
                            <input style="width: 70%; margin-left: 2%; margin-right: 4%; margin-top: 1%;" type="text"
                                placeholder="Comment.." name="comments">
                            <input type="submit" value="send" class="btn btn-primary">

                        </form>
                    </div>
                @empty
                    Post tapılmadı
                @endforelse
            </div>
            <div style="display: flex">
                <h1>Elanlar:</h1>
                @forelse ($adverts as $advert)
                    <div style="max-width: 240px" class="border border-primary p-1">
                        <div>
                            <p><b>Elanın adı:</b>{{ $advert->title }}</p>
                        </div>
                        <div>
                            <p><b>Elanın verən Şirkət:</b>
                                @foreach ($company as $com)
                                    {{ $com->name }}
                                @endforeach
                            </p>
                        </div>
                        <div>
                            <button class="btn btn-warning" type="submit">Muraciyyet et</button>
                        </div>
                    </div>

                @empty
                    <p>No adverts available.</p>
                @endforelse


            </div>

        </div>
    </div>
</body>

</html>
