<?php

namespace App\Http\Controllers;

use App\Models\AdvertisementBanner;
use Illuminate\Http\Request;

class AdvertisementController extends Controller
{
    public function __invoke(AdvertisementBanner $advertisementBanner)
    {
        views($advertisementBanner)->record();

        return redirect()->to($advertisementBanner->url);
    }
}
