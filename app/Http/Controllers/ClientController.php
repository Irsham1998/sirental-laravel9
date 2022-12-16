<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function profile()
    {
        return view('profile');
    }

    public function bookList(Request $request)
    {
        $categories = Category::all();
        // $title = $request->title;
        // $cat = $request->category;

        $books = Book::with('categories')->get();
        // if ($title || $cat) {
        //     $books =Book::with(['categories','cats'])->where('title', 'LIKE', "%{$title}%")
        //             ->orWhereHas('categories', function($q) use($cat){
        //                 $q->where('categories.id', $cat);
        //                 })->get();
        // }

        if ($request->title) {
            $books =Book::where('title', 'LIKE', '%'.$request->title.'%')
                        ->get();
        }
        elseif ($request->category) {
            $books = Book::whereHas('categories', function($query) use($request) {
                $query->where('categories.id', $request->category);
            })->get();
        }
        return view('book-list-user', [
            'books' => $books,
            'categories' => $categories
        ]);
    }
}
