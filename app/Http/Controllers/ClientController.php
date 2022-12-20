<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use App\Models\RentLogs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    public function profile()
    {
        $rentlistuser = RentLogs::where('user_id', Auth::user()->id)->get();
        return view('profile',[
            'rentlistuser' => $rentlistuser
        ]);
    }

    public function bookList(Request $request)
    {
        $categories = Category::all();

        $books = Book::with('categories')->get();

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
