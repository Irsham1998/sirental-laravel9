<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
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
        $listCategory = Category::all();

        return view('book-add', ['listCategory' => $listCategory]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            // 'book_code' => 'required|unique:books|max:50',
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
        $request['book_code'] = 'SR-' . mt_rand(000,999);

        $createBook = Book::create($request->all());

        $createBook->categories()->sync($request->categories);

        if ($createBook) {
            Session::flash('status', 'success');
            Session::flash('message', 'Genre baru berhasil ditambahkan');
        }

        return redirect('/books');
    }

    public function edit($slug)
    {
        $bookEdit = Book::where('slug', $slug)->first();
        $Categories = Category::all();

        return view('book-edit', [
            'bookEdit' => $bookEdit,
            'Categories' => $Categories
        ]);
    }

    public function update(Request $request, $slug)
    {
        // cek gambar ada tidak di request?
        if ($request->file('image')) {
            $extension = $request->file('image')->getClientOriginalExtension();
            $newName = $request->title.'-'.now()->timestamp.'.'.$extension;
            $request->file('image')->storeAs('cover', $newName);
            $request['cover'] = $newName;
        }
        $book = Book::where('slug', $slug)->first();
        // ubah slug jadi null biar bisa di update slug
        $book->slug = null;
        $book->update($request->all());

        // ada tidak category baru di request?
        if ($request->categories) {
            $book->categories()->sync($request->categories);
        }
        Session::flash('status', 'success');
        Session::flash('message', 'Genre berhasil di update');

        return redirect('/books');
    }

    // delete
    public function destroy(Request $request, $slug)
    {
        $deleted = Book::where('slug', $slug)->first();
        $deleted->delete();

        if ($deleted) {
            Session::flash('status', 'success');
            Session::flash('message', 'Buku berhasil dihapus');
        }

        return redirect('/books');
    }
}
