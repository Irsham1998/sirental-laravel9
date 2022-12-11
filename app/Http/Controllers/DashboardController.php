<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // cari jumlah user
        $userCount = User::count();
        // cari jumlah category
        $categoryCount = Category::count();
        // cari jumlah book
        $bookCount = Book::count();

        return view('dashboard', [
            'book_count' => $bookCount,
            'category_count' => $categoryCount,
            'user_count' => $userCount
        ]);
    }
}
