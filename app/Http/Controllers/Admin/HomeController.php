<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Apartment;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Coupon;
use App\Models\Course;
use App\Models\Image;
use App\Models\Place;
use App\Models\QR;
use App\Models\Stage;
use App\Models\User;

class HomeController extends Controller
{
    public function index()
    {
        return view('admin.home');

    }// end of index


    public function topStatistics()
    {
        $UsersCount = number_format( User::where('type','user')->count(),1);
        $stagesCount = number_format( Stage::count(),1);
        $placesCount = number_format( Place::count(),1);
        $coursesCount = number_format( Course::count(),1);
        $qrsCount = number_format( QR::count(),1);

        return response()->json([
            'users_count' => $UsersCount,
            'stages_count' => $stagesCount,
            'places_count' => $placesCount,
            'courses_count'=>$coursesCount,
            'qrs_count'=>$qrsCount,
        ]);

    }// end of topStatistics

}//end of controller
