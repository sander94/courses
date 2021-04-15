<?php


namespace App\Services;


use App\Models\AdvertisementBanner;

class BannerService
{
    /**
     * @return AdvertisementBanner
     */
    public function randomBanner(): ?AdvertisementBanner
    {
        /** @var AdvertisementBanner $banner */
        $banner = AdvertisementBanner::query()->inRandomOrder()->first();

        return $banner;
    }
}
