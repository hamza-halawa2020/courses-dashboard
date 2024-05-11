<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\BannerResource;
use App\Http\Resources\BrandResource;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return response()->api(BannerResource::collection($banners));
    }

    public function show($id)
    {
        $banner = Banner::findOrFail($id);
        return new BannerResource($banner);
    }
}
