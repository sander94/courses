<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-FTB6MKN673"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-FTB6MKN673');
    </script>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">


    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>


@php 
    if(isset($company->page_title_tag)) {
        echo $company->page_title_tag;
    }
    elseif(isset($property->page_title_tag)) {
        echo $property->page_title_tag;
    }
    else {
        echo isset($title) ? $title : 'Koolitused.ee | Eesti suurim koolituste andmebaas';
    }
@endphp
    </title>

    @isset($company->meta_description)
        <meta name="description" itemprop="description" content="{{ $company->meta_description }}" />
        <meta property="og:description" content="{{ $company->meta_description }}" />
    @endisset

    @isset($property->meta_description)
        <meta name="description" itemprop="description" content="{{ $property->meta_description }}" />
        <meta property="og:description" content="{{ $property->meta_description }}" />
    @endisset



    @isset($company->page_title_tag)
            <meta property="og:title" content="{{ $company->page_title_tag }}" />
    @endisset
    @isset($property->page_title_tag)
            <meta property="og:title" content="{{ $property->page_title_tag }}" />
    @endisset
    <meta name="robots" content="index,follow"/> 


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
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <script src="{{ asset('/js/app.js') }}"></script>

    <style>
        * {
            font-family: 'Work Sans';
            outline: none;
        }

        a {
            color: #F66F4D;
        }

        a.normal:hover {
            color:  #F66F4D;
        }

        body {
            background-color: #FAF8ED;
        }

        nav {
            overflow: scroll;
            overflow: hidden;
        }

.overlay {
    background-color: rgba(0, 0, 0, 0.8);
    position: absolute;
    height: 100%;
    width: 100%;
    color: #FFF;
    justify-content: center;
    align-items: center;
    display: flex;
    transition: all 0.1s ease-in;
    opacity: 0;
}
.companyhover:hover .overlay {
        opacity: 1;
}

figure img {
    max-width:  100%;
    height:  auto;
}

.centerbottom {
    position: absolute;
    bottom: 0;
}
.centerbottom2 {
    display: none;
}

            .home-1.xl {
                background-color:  rgba(255, 255, 255, 0.8);
            }

            .overlay {
                text-align: center;
            }

            .filter-container {
                display: flex;
                width: 1000px;
                margin: 0 auto;
                margin-top: 40px;
                justify-content: center;
            }

            .filter {
                padding: 10px 20px;
                border: 2px solid #F66F4D;
                border-radius: 30px;
                margin-left: 10px;
                margin-right: 10px;
            }

            .findCourse {
                width: 300px;
                cursor: pointer;
            }

            .findLocation {
                width: 200px;
                background: transparent;
                -webkit-appearance: none;
                cursor: pointer;
            }

            .findDate {
                width: 150px;
            }

            .findDate {
                background: transparent;
            }

            .findSubmit, .findSubmit2 {
                background-color: #F66F4D;
                border: 2px solid #F66F4D;
                border-radius: 30px;
                padding: 10px 30px;
                color: #FFFFFF;
                margin-left: 10px;
            }

            .findCourseContainer {
                background-color: #FFFBFA;
                width: 100%;
                display: none;
                margin-top: 30px;
                padding: 40px 50px;
            }

            ul, li {
                list-style-type: none;
            }

            #datepicker {
                cursor: pointer;
            }

        .small-logo {
            width: 32px;
            height: 32px;
            background-size: cover;
            border-radius: 16px;
            display: inline-block;
            vertical-align: middle;
            margin-right:  3px;
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
            background-color: #FFFFFF;
        }

        .menu a {
            color: #000000;
            margin-left: 35px;
            font-weight: 500;
        }

        .menu a:hover {
            text-decoration: none;
            color: #F66F4D;
        }

        .menu a.active {
            color: #F66F4D;
        }

        .header-container {
            width: 100%;
            position: fixed;
            z-index: 99;
            background-color: #FAF8ED;
            margin-bottom: 70px;
        }

        .header {
            width: 1300px;
            max-width: 100%;
            margin: 0 auto;
            padding-top: 10px;
            padding-bottom: 20px;
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
            background-color: #FAF8ED;
        }

        .menu-container {
            width: 800px;
            padding-top: 18px;
        }

        .content {
            width: 1200px;
            margin: 0 auto;
            padding-top: 150px;
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
            display: inline-block;
            margin-bottom: 10px;
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
            position: relative;
            overflow: scroll;
            overflow: hidden;
        }

        .results-table {
            width: 100%;
        }

        a.normal {
            text-decoration: none;
            font-weight: 400;
            color: #000000;
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

        a.table-readmore, button.table-readmore {
            text-decoration: none;
            color: #F66F4D;
            border: 2px solid #F66F4D;
            padding: 5px 20px;
            border-radius: 20px;
            background: transparent;
            display: inline;
            -webkit-appearance: none;
        }

        .duplicatorForm {
            display: inline;
        }

        .duplicatorForm button {
            background: transparent;
            color: #F66F4D;
            border: 0;
            font-size: 20px;
            outline: none;
            margin-left: 10px;
        }

        a.editbutton {
            color: #F66F4D;
            font-size: 20px;
            margin-left: 10px;
        }

        .duplicatorForm button:hover, a.editbutton:hover {
            color: #000000;
        }

        .pagination {
            margin-top: 30px;
        }

        .text-3xl {
            font-size: 65px;
            font-weight: 700;
        }

        .text-2xl {
            font-size: 20px;
            font-weight: 700;
        }

        .advert {
            width: 100%;
        }

        .blog-image-container {
            width: 100%;
            height: 200px;
            background-size: cover;
            background-position: center center;
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
            color: #F66F4D;
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
            margin-bottom: 15px;
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
            border: 2px solid #969696;
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

.title-container {
    display: flex;
}
.title-logo {
    margin-right: 15px;
}
.title {
    margin-top: 15px;
}
.profile-input-row {
    display: flex;
}
.input-desc {
    width: 150px;
    line-height: 40px;

}
.profile-input-row input[type="text"], .profile-input-row input[type="email"], .profile-input-row input[type="number"], .profile-input-row select {
    width: 60%;
    border: 2px solid #969696;
    background: transparent;
    border-radius: 30px;
    padding: 7px 10px;
    outline: none;
}

.profile-row {
    margin-top: 15px;
}

.logo-pilt {
    width: 80px;
    height: 80px;
    background-size: cover;
}

button.submit {
    background-color: #F66F4D;
    border-radius: 30px;
    color: #FFFFFF;
    padding: 10px 50px;
    border: 0;
    -webkit-appearance: none;
    margin-top: 40px;
    font-weight: 600;
}

.mobile-menu {
    display: none;
    width: 100%;
    height: 100vh;
    background-color: #F66F4D;
    position: absolute;
    left: 0;
    z-index: 10;
    text-align: center;
    top: 70px;
    padding-top: 40px;
}

.mobile-menu a {
    display: block;
    color: #FFFFFF;
    font-size: 24px;
    margin-top: 10px;
}

.menu-toggle {
    display: none;
}

.menu-toggle i {
    cursor: pointer;
}

.search-toggle {
    display: none;
}

.home-image {
    position: absolute;
    top: 0;
    z-index: -1;
    right: 0;
    width: 80%;
    opacity:  0.5;
}

.main {
    columns: 3;
}

.main input[type="checkbox"] {
    margin-right:  10px;
}

.main-li {
    /* border-right: 1px solid #dadada; */
    font-weight: 700;
}

ul.sub li {
    font-weight: 400;
}



.main-li label:hover {
    color: #F66F4D;
    cursor: pointer;
}
input[type='radio'] {
    margin-right: 10px;
}

.company-page-logo {
    text-align: right;
}

.companyhover {
    margin-bottom: 20px;
}

.table_course_date {
    width:  215px;
}

.table_course_name {

}
.table_course_price {
width:  100px;
}
.table_course_region {
width:  150px;
}
.table_course_company {
width:  250px;
}

@media screen and (max-width: 1350px) {
    .header {
        width: 1250px;
    }
    .content {
        width: 1100px;
    }
    .advert {
        padding-left: 30px;
    }
}

@media screen and (max-width: 1250px) {
    .header {
        width: 100%;
        padding-left: 15px;
        padding-right: 15px;
    }
    .search-container {
        width: 400px;
    }
    .logo-container {
        width: 300px;
    }
    .content {
        width: 1000px;
    }
    .filter-container {
        width: 100%;
    }
}

@media screen and (max-width: 1100px) {
    .menu a {
        margin-left: 20px;
    }
    .search-container {
        width: 450px;
        margin-left: 30px;
    }
    .content {
        width: 100%;
        padding-left: 20px;
        padding-right: 20px;
    }
    .findCourseContainer {
        padding: 40px 40px;
    }
    .results-table {
        width: 800px;
        overflow: auto;
    }
}

@media screen and (max-width: 1000px) {
    .menu {
        display: none;
    }
    .search-container {
        width: 1000px;
        margin-right: 20px;
    }
    .menu-toggle {
        display: block;
        text-align: center;
        font-size: 28px;
        line-height: 28px;
        margin-left: 10px;
    }
    .menu-container {
        width: 80px;
    }
    .text-3xl {
        font-size: 45px;
        font-weight: 700;
    }
    .findCourseContainer {
        padding: 40px 15px;
    }
    .main {
        columns: 2;
    }
    .centerbottom {
    display:  none;
    }
    .centerbottom2 {
        display:  block;
    }

}

@media screen and (max-width: 750px) {
    .filter-container {
        display: block;
    }
    .findCourse, .findLocation, .findDate, .findSubmit, .findSubmit2 {
        width: 45%;
        display: inline-block;
        max-height: 48px;
        overflow: hidden;
        vertical-align: top;
        margin-bottom: 20px;
    }
    .text-3xl br {
        display: none;
    }
    .advert {
        padding-left: 40px;
    }
    .companies .findSubmit, .findSubmit2 {
        display: block;
        width: 100%;
    }
    .admin-menu a {
        display: inline-block;
        margin-bottom: 10px;
    }
    .company-page-logo {
    text-align: left;
    margin-bottom: 30px;
    }
    .company-image-container {
        height:  100px;
    }
    .results-table-container {
            margin-top: 70px;
            width: 100%;
            position: relative;
            overflow: scroll;
    }
}

@media screen and (max-width: 550px) {
    .content {
        padding-top: 120px;
    }
    .search-container {
        display: none;
        position: absolute;
        width: 100%;
        left: 0;
        top: 60px;
        margin: 0 auto;
        z-index: 9;
        height: 60px;
    }
    .menu-container {
        text-align: right;
        width: 100%;
        display: flex;
        justify-content: flex-end;
    }
    .menu-toggle {
        text-align: right;
    }
    .search-toggle {
        display: block;
    }
    .search-toggle i {
        font-size: 22px;
        line-height: 24px;
        margin-right: 20px;
        margin-top: 3px;
        color: #F66F4D;
        cursor: pointer;
    }
    .text-3xl {
        font-size: 40px;
        font-weight: 700;
    }
    .button-container .home-1 {
        padding: 10px 10px;
        margin-right: 10px;
        display: inline-block;
        margin-bottom: 10px;
    }
    .button-container {
        margin-top: 25px;
    }
    .button-container .writeToUs {
        width: 100%;
        padding: 10px 20px;
    }
    .button-container a {
        font-size: 12px;
        width: ;
    }
    .home-image {
        opacity: 0.5;
        left: 10%;
        right: 10%;
        top: 30px;
    }
    .mt-sm-5-1 {
        margin-top: 50px;
    }
    .popular-courses-container a {
        margin-right: 10px;
        margin-left: 10px;

        line-height: 35px;
    }
    .main {
        columns: 1;
        padding-left: 10px;
    }
    .main-li {
        border: 0;
    }
    .advert {
        padding: 0;
    }
    .findSubmit2 {
        width: 100%;
        display: inline-block;
        padding: 10px 20px;
    }
    .filter-container-left .filter {
        width: 170px;
        margin-left: 0;
    }
    .company-page-logo {
        text-align:  center;
    }
    .filter {
        margin-right: 0;
        font-size: 12px;
        padding: 10px;
    }
    .findSubmit {
        font-size: 12px;
        padding: 10px;
    }
}

a.page-link, .page-item.disabled .page-link {
    border-radius: 20px;
    padding: 0;
    width: 40px;
    height: 40px;
    text-align: center;
    line-height: 40px;
    margin-left: 3px;
    background-color: #F66F4D;
    color: #FFFFFF;
    border: 0;
}

.page-item.active .page-link {
    border-color: #000000;
    background-color: #FFFFFF;
    color: #F66F4D;
    border-radius: 20px;
    width: 40px;
    height: 40px;
    margin-left: 4px;
    border-width: 2px;
    line-height: 35px;
    text-align: center;
    padding: 0;
}

.pagination {
    justify-content: center;
    margin-top: 80px;
}

@media screen and (max-width:  700px) {
    .pagination {
        justify-content: left;
    }
}

.page-item:first-child .page-link, .page-item:last-child .page-link {
    border-radius:  20px;
    font-size: 24px;
    line-height: 38px;
}
</style>
    @stack('css-after')

</head>
<body>
<div class="header-container" style="border-bottom: 1px solid #efecda; -webkit-box-shadow: 0px 0px 15px 5px rgba(0,0,0,0.04);
box-shadow: 0px 0px 15px 5px rgba(0,0,0,0.04);">
    <div class="header">
        <div class="navigation">
            <div class="logo-container">
                <a href="/">
                    <div class="logo pt-2">
                        <span class="text-orange">Koolitused</span><span>.ee</span>
                    </div>
                </a>
            </div>
            <div class="search-container" id="searchContainer">
                <div class="search pt-2">
                    <form action="{{ route('search') }}" autocomplete="off">
                        <input type="text" value="{{ request()->query('search') }}" name="search"
                               placeholder="Leia sobiv koolitus, koolitaja, ruum...">

                        <button class="search-icon"><i class="fas fa-search text-orange"> </i></button>
                    </form>
                </div>
            </div>
            <div class="menu-container">
                <div class="menu">
                    <a href="{{ route('courses.index') }}" class="{{ Route::is('courses.index') ? 'active' : '' }}">Koolitused</a>
                    <a href="{{ route('companies') }}" class="{{ Route::is('companies') ? 'active' : '' }}">Koolitajad</a>
                    <a href="{{ route('articles.index') }}" class="{{ Route::is('articles.index') ? 'active' : '' }}">Artiklid</a>
                    <a href="{{ route('rooms') }}" class="{{ Route::is('rooms') ? 'active' : '' }}">Ruumid</a>
                    <a href="{{ route('contact') }}" class="{{ Route::is('contact') ? 'active' : '' }}">Kontakt</a>
                </div>
                <div class="search-toggle" id="searchMenuButton">
                    <i class="fas fa-search"></i>
                </div>
                <div class="menu-toggle" id="mobileMenuButton">
                    <i class="fas fa-bars"></i>
                </div>
                <div class="mobile-menu" id="mobileMenu">
                    <a href="{{ route('courses.index') }}">Koolitused</a>
                    <a href="{{ route('companies') }}">Koolitajad</a>
                    <a href="{{ route('articles.index') }}">Artiklid</a>
                    <a href="{{ route('rooms') }}">Ruumid</a>
                    <a href="{{ route('contact') }}">Kontakt</a>
                </div>
            </div>
        </div>
    </div>
</div>
@yield('content')


<div class="footer">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-4">
                Ka Company OÜ<br>
                Mahla 82-78, Tallinn 11215<br>
                info@koolitused.ee<br>
                +372 5646 0814<br>
            <p class="centerbottom2">Koolitused.ee © 2023 - Ka Company OÜ</p>
            </div>
            <div class="col-12 col-sm-4 col-xs-2"> <!--
                <a href="{{ route('login') }}">User log in</a><br><br>
                <a href="{{ route('courses.index') }}">Courses</a><br>
                <a href="{{ route('companies') }}">Companies</a><br>
                <a href="{{ route('articles.index') }}">Articles</a><br>
                <a href="#">Rooms</a><br>
                <a href="#">Contact</a> -->
                <p class="centerbottom">Koolitused.ee © 2023 - Ka Company OÜ</p>
            </div>
            <div class="col-12 col-sm-4 text-right">
                @auth('company')
                    <p><span class="font-bold">Kasutaja: </span> {{ auth('company')->user()->username }} <br>
                        <span class="font-bold"><a href="{{ route('profile') }}">Muudan ettevõtte andmeid</a></span>
                        <br><br><br>
                        <a href="{{ route('logout') }}" class="logout">Logi välja</a>
                @endauth

                @guest('company')
                    <form action="{{ route('authenticate') }}" method="POST" class="login">
                        @csrf
                        <input type="text" name="username" placeholder="Kasutajanimi">
                        <input type="password" name="password" placeholder="Parool">
                        <input type="submit" value="LOGI SISSE" class="">
                    </form>
                @endguest
            </div>
        </div>
    </div>

</div>

@stack('js')
<script>
$('#mobileMenuButton').click(function() {
    $('#mobileMenu').slideToggle();
});
$('#searchMenuButton').click(function() {
    $('#searchContainer').slideToggle();
});
</script>
</body>
</html>
