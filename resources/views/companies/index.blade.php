@extends('layouts/web')

@php
    /** @var \App\Services\BannerService $bannerService */
    $bannerService = app(\App\Services\BannerService::class);
    $banner = $bannerService->randomBanner();
@endphp

@section('content')

    <style>

        .filter-container-left {
            display: block;
            margin: 0 auto;
            margin-top: 40px;
            margin-bottom: 40px;
            justify-content: start;
        }

        .filter-container-left .filter {
            padding: 10px 20px;
            border: 2px solid #F66F4D;
            border-radius: 30px;
            background: transparent;
            outline: none;
            display: inline-block;
        }
        .findSubmit2 {
            width: auto;
        }



    </style>

    <div class="content">

        <div class="row">
            <div class="col-sm-4">
                <h1 class="text-3xl">Eesti <br>parimad <br>koolitajad</h1>
            </div>
            @if($banner)
                <div class="col-sm-8">
                    <a href="{{ route('ad', $banner) }}">
                        <img src="{{ $banner->getFirstMediaUrl('banner') }}" class="advert">
                    </a>
                </div>
            @endif
        </div>

        <div class="row">

            <div class="col-12">

                <form action="">
                    <div class="filter-container-left">
                        <input type="text" class="filter" name="search" value="{{ request()->get('search') }}"
                               placeholder="Leia koolitaja">
                        <input type="submit" class="findSubmit2" value="Leia">
                    </div>
                </form>

            </div>

        </div>

<style>
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
</style>
        <div class="row company-archive mt-5">
            @foreach($companies as $company)
                <div class="col-6 col-sm-3 companyhover">
                <a href="{{ route('company', $company) }}?type=live" style="text-decoration: none">
                    <div style="background-color: #FFFFFF; position: relative;">
                    <div class="overlay">
                        {{ $company->name }}
                    </div>
                   <div style="padding: 20px;">
                        <div class="company-image-container"
                             style="background-image: url('{{ $company->getFirstMediaUrl('cover') }}');">
                        </div>
                    </div>
                   
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
