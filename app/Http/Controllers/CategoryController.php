<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display Categories
     */
    public function index()
    {
        $categories = Category::get();
      return view('categories.index', compact('categories'));

    }

    /**
     * Add new Category
     */
    public function create()
    {
        return view('categories.create');
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate(
            [
        'name' => ['required', 'string', 'max:255', 'unique:categories,name'],
            ]
        ); 
        Category::create($validatedData);
         return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
       $category = Category::find($id) ;
       return $category ;

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::find($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $category = Category::find($id);
         $validatedData = $request->validate(
            [
        'name' => ['required', 'string', 'max:255'],
            ]
        ); 
          $category->update($validatedData);
          return redirect()
        ->route('categories.index')
        ->with('success', 'Category updated successfully.');
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
          return redirect()
        ->route('categories.index')
        ->with('success', 'Category deleted successfully.');
        
    }
}
