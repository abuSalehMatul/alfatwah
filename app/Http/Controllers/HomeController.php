<?php

namespace App\Http\Controllers;

use App\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
  public function index()
  {
    return view('frontend.home');
  }

  public function redirectToHome()
  {
    $defaultLocale = Session::get("APP_LOCALE") ?? config('app.locale');
    return redirect()->route('home', ['locale' => $defaultLocale]);
  }

  public function getAllMediaView($lang)
  {
    $medias = $this->getMediaActives($lang);
    return view('frontend.all_media')->with('medias', $medias);
  }

  public function getMediaActives($lang)
  {
    return Media::orderBy('created_at', 'DESC')
      ->where('language', $lang)
      ->where('status', 'active')->paginate(20);
  }

  public function getProfile($lang, $id)
  {
    if (auth()->id() == $id) {
      $questions = auth()->user()->questions;
      return view('frontend.profile')->with('questions', $questions);
    }
    return redirect()->back();
  }

  public function aboutUs($lang)
  {
    $aboutUs = config('aboutUs.' . $lang);
    return view('frontend.about_us')->with('aboutUs', $aboutUs);
  }
  public function onDevelp($lang)
  {
    return view("frontend.ondevelop")->with("lang", $lang);
  }
}
