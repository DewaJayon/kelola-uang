<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('dashboard.category.index', [
            'title'         => 'Category',
            'categories'    => Category::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.category.create', [
            'title' => 'Tambah Category'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name'
        ], [
            'name.unique' => 'Category sudah ada!',
            'name.required' => 'Category harus diisi!'
        ]);

        $isExpense = $request->is_expense;

        if ($isExpense === null) {
            $isExpense = 0;
        } else {
            $isExpense = 1;
        }

        $slug = Str::slug($request->name, '-');

        $categoryParams = [
            'name'          => $request->name,
            'slug'          => $slug,
            'is_expense'    => $isExpense
        ];

        Category::create($categoryParams);

        return redirect()->route('category.index')->with('success', 'Category berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        return view('dashboard.category.edit', [
            'title'     => 'Edit Category',
            'category'  => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $category->id
        ], [
            'name.unique' => 'Category sudah ada!',
            'name.required' => 'Category harus diisi!'
        ]);

        $isExpense = $request->is_expense;

        if ($isExpense === null) {
            $isExpense = 0;
        } else {
            $isExpense = 1;
        }

        $slug = Str::slug($request->name, '-');

        $categoryParams = [
            'name'          => $request->name,
            'slug'          => $slug,
            'is_expense'    => $isExpense
        ];

        $category->update($categoryParams);

        return redirect()->route('category.index')->with('success', 'Category berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        try {
            Category::destroy($category->id);
            return redirect()->route('category.index')->with('success', 'Category berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('category.index')->with('error', 'Category gagal dihapus!');
        }
    }
}
