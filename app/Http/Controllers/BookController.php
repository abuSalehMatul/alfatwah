<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
    public function getBooks()
    {
        $locale = Session::get('APP_LOCALE');
        return Book::where('status', 'active')
        ->where("language", $locale)
        ->get();
    }
}
