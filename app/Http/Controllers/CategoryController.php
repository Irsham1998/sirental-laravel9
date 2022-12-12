<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categoryData = Category::all();
        return view('category', [
            'categoryData' => $categoryData,
        ]);
    }

    // simpan data category
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:25',
        ]);
        $createCategory = Category::create($validated);

        if ($createCategory) {
            Session::flash('status', 'success');
            Session::flash('message', 'Genre baru berhasil ditambahkan');
        }

        return redirect('/categories');
    }
}
