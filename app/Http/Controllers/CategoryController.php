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

    public function edit($slug)
    {
        $categoryEdit = Category::where('slug', $slug)->first();

        return view('category-edit', [
            'categoryEdit' => $categoryEdit
        ]);
    }

    // update data
    public function update(Request $request, $slug)
    {
        $validated = $request->validate([
            'name' => 'required|unique:categories|max:25',
        ]);

        $category = Category::where('slug', $slug)->first();
        $category->slug = null;
        $updateCategory = $category->update($validated);

        if ($updateCategory) {
            Session::flash('status', 'success');
            Session::flash('message', 'Genre berhasil di update');
        }

        return redirect('/categories');
    }

    // delete
    public function destroy(Request $request, $slug)
    {
        $deletedDelete = Category::where('slug', $slug)->first();
        $deletedDelete->delete();

        if ($deletedDelete) {
            Session::flash('status', 'success');
            Session::flash('message', 'Genre berhasil dihapus');
        }

        return redirect('/categories');
    }
}
