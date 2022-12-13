<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::all();

        return view('book', ['books' => $books]);
    }

    public function create()
    {
        return view('book-add');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'book_code' => 'required|unique:books|max:50',
            'title' => 'required | max:100',
        ]);

        // cek gambar
        $newName = '';
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('cover', $newName);
        }
        $request['cover'] = $newName;

        $createBook = Book::create($request->all());

        if ($createBook) {
            Session::flash('status', 'success');
            Session::flash('message', 'Genre baru berhasil ditambahkan');
        }

        return redirect('/books');
    }
}
