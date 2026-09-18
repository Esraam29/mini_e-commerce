<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with('category')->get();
        return view('products.index' , compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::get();
        return view('products.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
          'category_id' => 'required|exists:categories,id',
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'description' => 'required|string',
        'stock' => 'required|integer|min:0',
        'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]); 
        //1 store image that user upload into storage/app/public/products
        $imagePath = $request->file('image')->store('products', 'public');
    //2 storage link  (link storage with public) عشان الصورة تظهر ف ال blade 
    //3 save img path in DB 
        Product::create([
    'category_id' => $request->category_id,
    'name' => $request->name,
    'price' => $request->price,
    'description' => $request->description,
    'stock' => $request->stock,
    'image' => $imagePath,
]);
        return redirect()->route('products.index')
        ->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $product = Product::find($id) ;
       return $product ;

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $categories = Category::get();

        return view('products.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $product = Product::find($id) ;
         
        $validatedData = $request->validate([
          'category_id' => 'required|exists:categories,id',
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'description' => 'required|string',
        'stock' => 'required|integer|min:0',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]); 

         if ($request->hasFile('image')) {
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }

        $validatedData['image'] = $request->file('image')->store('products', 'public');
    }
     $product->update($validatedData);
      return redirect()->route('products.index')
        ->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::find($id) ;
        $product->delete();
         return redirect()
        ->route('products.index')
        ->with('success', 'Product deleted successfully.');
    }
}
