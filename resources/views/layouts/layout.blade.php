<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
</head>
<body class="bg-dark text-white">
<div class="container py-3">


    <header class="bg-dark d-flex flex-column flex-md-row align-items-center pb-3 mb-4 border-bottom">

        <nav class="d-inline-flex mt-2 mt-md-0 ms-md-auto">
            <div class="me-3 py-2 text-white text-decoration-none ">
                <a class="btn btn-outline-dark text-white" href="/">Главная</a>
            </div>



            @if(session()->get('is_authorised') == true && session()->get('user_id') == 1)
                <!--<div class="me-3 py-2 text-white text-decoration-none ">
                    <a class="btn btn-outline-dark text-white" href="/password/category/create">Создать категорию</a>
                </div>-->
                <div class="dropdown">
                    <a class="btn btn-secondary dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
                        Категории
                    </a>

                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                        <li><a class="dropdown-item" href="/password/category">Все категории</a></li>
                        <li><a class="dropdown-item" href="/password/category/create">Новая категория</a></li>
                    </ul>
                </div>
            @endif

            @if(session()->get('is_authorised') == true)
                <div class="me-3 py-2 text-white text-decoration-none ">
                    <a class="btn btn-outline-dark text-white" href="/user">Личный кабинет</a>
                </div>
            @endif

            @if(session()->get('is_authorised') == true)
                <form action="/password/create" method="get" class="me-3 py-2 text-white text-decoration-none">
                    @csrf
                    <input class="text-decoration-none  btn btn-outline-danger" type="submit" value="Создать пароль">
                </form>
            @endif

            @if(session()->get('is_authorised') == true)
                <form action="/validate/exit" method="post" class="me-3 py-2 text-white text-decoration-none">
                    @csrf
                    <input class="text-decoration-none  btn btn-outline-danger" type="submit" value="Выйти">
                </form>
            @endif

            @if(session()->get('is_authorised') == false)
                <div class="me-3 py-2 text-white text-decoration-none">
                    <a class="py-2 text-white text-decoration-none btn btn-outline-warning" href="register">Регистрация</a>
                </div>
            @endif

            @if(session()->get('is_authorised') == false)
                <div class="me-3 py-2 text-white text-decoration-none">
                    <a class="py-2 text-white text-decoration-none btn btn-outline-info" href="login">Войти</a>
                </div>
            @endif

        </nav>
    </header>


    <main>
        @yield('main_content')
    </main>
</div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>
</body>
</html>
