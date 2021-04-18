@extends('layouts/web')

@php
    /** @var \App\Services\BannerService $bannerService */
    $bannerService = app(\App\Services\BannerService::class);
    $banner = $bannerService->randomBanner();
@endphp

@section('content')

    <style>

        .filter-container {
            display: flex;
            margin: 0 auto;
            margin-top: 40px;
            margin-bottom: 40px;
            justify-content: start;
        }

        .filter {
            padding: 10px 20px;
            border: 2px solid #F66F4D;
            border-radius: 30px;
        }


        .findSubmit {
            background-color: #F66F4D;
            border: 2px solid #F66F4D;
            border-radius: 30px;
            padding: 10px 30px;
            color: #FFFFFF;
            margin-left: 10px;
        }

        .findCourseContainer {
            background-color: #F66F4D;
            width: 100%;
            display: none;
            margin-top: 30px;
            padding: 50px;
        }

    </style>

    <div class="content">

        <div class="row">
            <div class="col-4 pt-4">
                <h1 class="text-3xl">Eesti<br>parimad<br>koolitajad</h1>
                <form action="">
                    <div class="filter-container">
                        <input type="text" class="filter" name="search" value="{{ request()->get('search') }}"
                               placeholder="Leia koolitaja">
                        <input type="submit" class="findSubmit" value="Leia">
                    </div>
                </form>
            </div>
            @if($banner)
                <div class="col-8">
                    <a href="{{ route('ad', $banner) }}">
                        <img src="{{ $banner->getFirstMediaUrl('banner') }}" class="advert">
                    </a>
                </div>
            @endif
        </div>


        <div class="row company-archive mt-5">
            @foreach($companies as $company)
                <div class="col-3">
                    <a href="{{ route('company', $company) }}" style="text-decoration: none">
                        <div class="company-image-container"
                             style="background-image: url('{{ $company->getFirstMediaUrl('cover') }}');">
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

        <div class="pagination">
            {{ $companies->links() }}
        </div>

    </div>


@endsection
