<?php

namespace App\Http\Controllers\Admin;

use App\Book;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class BookController extends Controller
{
    public function getAll()
    {
        $books = Book::orderBy('created_at', 'DESC')->get();
        return view('backend.books')->with('books', $books);
    }

    public function changeStatus($id, $status)
    {
        $book = Book::findOrFail($id);
        $book->status = $status;
        return $book->save();

    }

    public function createForm()
    {
        return view('backend.bookForm');
    }

    public function save(Request $request)
    {
        $request->validate([
            'title' => "required", 
            'writer' => 'required',
            'file' => "required|file"
        ]);
        $path = $request->file('file')->store('public');
        $url = Storage::url($path);
        $book = new Book;
        $book->status = "pending";
        $book->title = $request->title;
        $book->writer = $request->writer;
        $book->language = $request->lang;
        $book->link = $url;
        $book->save();
        return redirect()->route('admin.books');
    }
}
