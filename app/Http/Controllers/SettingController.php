<?php

namespace App\Http\Controllers;

use App\Media;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function getSliderImg($lang)
    {
        return Media::where("status", "active")
        ->where("language", $lang)
        ->get();
    }
}
