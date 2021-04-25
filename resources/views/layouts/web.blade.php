<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title : 'Koolitused.ee' }}</title>

    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="{{ asset('/js/app.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"></script>
    <script src="https://kit.fontawesome.com/9c72c241e1.js" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"
            integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8shuf57BaghqFfPlYxofvL8/KUEfYiJOMMV+rV"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>



    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Work+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css"
          integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">



    <style>
        * {
            font-family: 'Work Sans';
        }

        body {
            background-color: #FAF8ED;
        }

        .text-red {
            color: red;
        }

        .mt-10 {
            margin-top: 100px;
        }

        .text-xl {
            font-size: 18px;
        }

        .font-bold {
            font-weight: 600;
        }

        .font-extrabold {
            font-weight: 700;
        }

        .medium-title {
            font-size: 30x;
            font-weight: 600;
            letter-spacing: 1px;
        }

        .logo {
            font-size: 30px;
            font-weight: 600;
        }

        .text-orange {
            color: #F66F4D;
        }

        .search input {
            background-color: #FFFFFF;
            width: 100%;
            border-radius: 30px;
            border: 0;
            -webkit-appearance: none;
            padding: 10px 30px;
            -webkit-box-shadow: 0px 5px 10px -3px rgba(0, 0, 0, 0.1);
            box-shadow: 0px 5px 10px -3px rgba(0, 0, 0, 0.1);
            font-weight: 300;
        }

        .search-icon {
            position: absolute;
            right: 25px;
            top: 20px;
        }

        button.search-icon {
            border: none;
            outline: none;
            font: inherit;
            color: inherit;
            background: none
        }

        .search-icon i {
            font-size: 20px;
        }

        .menu a {
            color: #000000;
            margin-left: 40px;
            font-weight: 300;
        }

        .menu a:hover {
            text-decoration: none;
        }

        .header {
            width: 1300px;
            max-width: 100%;
            margin: 0 auto;
            padding-top: 10px;
            margin-bottom: 70px;
        }

        .navigation {
            display: flex;
        }

        .logo-container {
            width: 400px;
        }

        .logo-container a {
            color: inherit;
        }

        .logo-container a:hover {
            color: inherit;
            text-decoration: none;
        }

        .search-container {
            width: 600px;
            position: relative;
        }

        .menu-container {
            width: 800px;
            padding-top: 18px;
        }

        .content {
            width: 1200px;
            margin: 0 auto;
        }

        h1.entry-title {
            font-weight: 600;
            font-size: 30px;
        }

        .separator-orange {
            width: 208px;
            height: 3px;
            background-color: #F66F4D;
            margin-left: 20px;
            margin-top: 10px;
        }

        .button-container {
            margin-top: 60px;
        }

        .button-container a {
            border: 2px solid rgba(48, 48, 48, 0.5);
            padding: 10px 20px;
            border-radius: 30px;
            margin-right: 20px;
            color: #000000;
            text-decoration: none;
        }

        .button-container a.active {
            background-color: #F66F4D;
            border: 2px solid #F66F4D;
            color: #FFFFFF;
        }

        .button-container .xl {
            font-size: 18px;
            padding: 13px 40px;
        }

        .results-table-container {
            margin-top: 70px;
            width: 100%;
        }

        .results-table {
            width: 100%;
        }

        .tableheader {
            font-weight: 500;
        }

        .tableheader td {
            padding-bottom: 20px;
        }

        .results-table td {
            padding-right: 10px;
            vertical-align: top;
            padding-bottom: 20px;
        }

        a.table-readmore {
            text-decoration: none;
            color: #F66F4D;
            border: 2px solid #F66F4D;
            padding: 5px 20px;
            border-radius: 20px;
        }

        .pagination {
            margin-top: 30px;
        }

        .text-3xl {
            font-size: 65px;
            font-weight: 700;
        }

        .advert {
            width: 100%;
        }

        .blog-image-container {
            width: 100%;
            height: 200px;
            background-size: cover;
        }

        .company-image-container {
            width: 100%;
            height: 200px;
            background-color: #FFFFFF;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center center;
        }

        span.blog-title {
            font-size: 20px;
            color: #000000;
            line-height: 24px;
            font-weight: 500;
            padding-top: 15px;
            margin-bottom: 15px;
            display: block;
        }

        span.blog-title:hover {
            text-decoration: none;
        }

        .blog-archive .col-4, .company-archive .col-3 {
            margin-bottom: 40px;
        }
        .footer {
            background-color: #272424;
            padding-top: 50px;
            padding-bottom: 50px;
            margin-top: 150px;
            color: #FFFFFF;
            font-weight: 300;
            line-height: 28px;
        }
        .footer a {
            color: #FFFFFF;
        }
        .popular-courses-container a {
            margin-right: 20px;
            margin-left: 20px;
            color: #000000;
            line-height: 55px;
        }
        .card-rounded {
            background-color: #FFFFFF;
            border-radius: 30px;
            padding: 40px 40px;
        }
        .mx-auto {
            margin: 0 auto;
        }
        form.login input[type="text"], form.login input[type="password"] {
            -webkit-appearance: none;
            background: transparent;
            border-radius: 30px;
            color: #FFFFFF;
            border: 2px solid #FFFFFF;
            padding: 5px 18px;
            margin-bottom: 16px;
            outline: none;
            width: 100%;
        }
        form.login input[type="submit"] {
            background-color: #F66F4D;
            color: #FFFFFF;
            border-radius: 30px;
            float: right;
            -webkit-appearance: none;
            border: 0;
            outline: none;
            padding: 5px 20px;
        }

        .contactform input[type="text"], .contactform textarea {
            border: 2px solid #F66F4D;
            border-radius: 30px;
            font-size: 18px;
            margin-bottom: 30px;
            padding: 10px 20px;
            width: 100%;
            background: transparent;
            outline: none;
            -webkit-appearance: none;
        }

        .contactform textarea {
            height: 200px;
            resize: none;
        }

        .contactform input[type="submit"] {
            background-color: #F66F4D;
            -webkit-appearance: none;
            color: #FFFFFF;
            border-radius: 30px;
            font-size: 18px;
            border: 0;
            padding: 10px 30px;
            float: right;
        }

        .logout {
            float: right;
            border: 2px solid #FFFFFF;
            padding: 5px 25px;
            border-radius: 30px;
        }

        .admin-menu a {
            margin-right: 20px;
            border: 2px solid #000000;
            padding: 10px 20px;
            border-radius: 30px;
            color: #000000;
        }

        .admin-menu a:hover {
            text-decoration: none;
        }

        .admin-menu a.active {
            background-color: #F66F4D;
            border-color: #F66F4D;
            color: #FFFFFF;
        }

    </style>


</head>
<body>
<div class="header">
    <div class="navigation">
        <div class="logo-container">
            <a href="/">
                <div class="logo pt-2">
                    <span class="text-orange">Koolitused</span><span>.ee</span>
                </div>
            </a>
        </div>
        <div class="search-container">
            <div class="search pt-2">
                <form action="{{ route('search') }}">
                    <input type="text" value="{{ request()->query('search') }}" name="search"
                           placeholder="Leia sobiv koolitus">

                    <button class="search-icon"><i class="fas fa-search text-orange"> </i></button>
                </form>
            </div>
        </div>
        <div class="menu-container">
            <div class="menu">
                <a href="{{ route('courses.index') }}">Courses</a>
                <a href="{{ route('companies') }}">Companies</a>
                <a href="{{ route('articles.index') }}">Articles</a>
                <a href="#">Rooms</a>
                <a href="{{ route('contact') }}">Contact</a>
            </div>
        </div>
    </div>
</div>
@yield('content')



<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-4">
                Ka Company OÜ<br>
                Mahla 82-78, Tallinn 11215<br>
                info@koolitused.ee<br>
                +372 5646 0814<br>
            </div>
            <div class="col-5"> <!--
                <a href="{{ route('login') }}">User log in</a><br><br>
                <a href="{{ route('courses.index') }}">Courses</a><br>
                <a href="{{ route('companies') }}">Companies</a><br>
                <a href="{{ route('articles.index') }}">Articles</a><br>
                <a href="#">Rooms</a><br>
                <a href="#">Contact</a> -->
                <p style="position: absolute; bottom: 0;">Koolitused.ee © 2021 - Ka Company OÜ</p>
            </div>
            <div class="col-3 text-right">
                @auth('company')
                <p><span class="font-bold">Kasutaja: </span> {{ auth('company')->user()->email }} <br>
                <span class="font-bold"><a href="{{ route('profile') }}">Muudan ettevõtte andmeid</a></span>
                <br><br><br>
                <a href="{{ route('logout') }}" class="logout">Logout</a>
                @endauth

                @guest('company')
                <form action="{{ route('authenticate') }}" method="POST" class="login">
                    @csrf
                    <input type="text" name="email" placeholder="Username">
                    <input type="password" name="password" placeholder="Password">
                    <input type="submit" value="LOG IN" class="">
                </form>
                @endguest
            </div>
        </div>
    </div>

</div>

</body>
</html>
