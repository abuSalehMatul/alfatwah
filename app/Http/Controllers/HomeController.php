<?php

namespace App\Http\Controllers;

use App\User;
use App\Media;
use Exception;
use App\Mail\PasswordReset;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Password;

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

  public function sendEmailToSetPass(Request $request)
  {
    $request->validate(['email' => 'required|email']);
    try {
      $random = Str::random(16);
      Session::put("reset_token", $random);
      Session::put("reset_email", $request->email);

      //put the mail into queue
      Mail::to($request->email)->send(new PasswordReset($random));
      return redirect('/');
    } catch (Exception $e) {
      return "mail couldn't be sent";
    }
  }

  public function reset($str)
  {
    if ($str == Session::get("reset_token")) {
      //might written some additional logic
      return redirect()->route("auth.passwords.reset.form", Session::get('APP_LOCALE'));
    }
  }

  public function resetForm()
  {
    return view("auth.passwords.reset");
  }

  public function passResetConfirm(Request $request)
  {
    $request->validate([
      'password' => 'required|min:8|confirmed',
    ]);
    $user = User::where("email", Session::get("reset_email"))->first();
    $user->password = Hash::make($request->password);
    $user->save();
    Auth::login($user);
    return redirect("/");
  }
}
