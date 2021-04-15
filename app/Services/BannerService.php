<?php


namespace App\Services;


use App\Enums\AdTypeEnum;
use App\Models\AdvertisementBanner;

class BannerService
{
    /**
     * @param int $type
     * @return AdvertisementBanner
     */
    public function randomBanner(int $type = AdTypeEnum::Courses): ?AdvertisementBanner
    {
        /** @var AdvertisementBanner $banner */
        $banner = AdvertisementBanner::query()
            ->where('type', $type)
            ->inRandomOrder()->first();

        return $banner;
    }
}
