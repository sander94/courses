<?php


namespace App\Services;


use App\Enums\AdTypeEnum;
use App\Models\AdvertisementBanner;
use Illuminate\Database\Eloquent\Builder;

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
            ->inRandomOrder()
            ->Where(function (Builder $query) {
                return $query->where('started_at', '>=', now())
                    ->where('ended_at', '<=', now());
            })
            ->first();

        return $banner;
    }
}
