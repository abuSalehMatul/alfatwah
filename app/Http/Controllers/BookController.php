<?php

namespace App\Http\Controllers;

use App\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function getBooks()
    {
        return Book::where('status', 'active')->get();
    }
}
