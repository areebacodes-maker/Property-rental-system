<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
   public function index(Request $request)
{
    $search = $request->search;
    $category = $request->category;

    $categories = Category::all();

    $properties = Property::with('category')

        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('location', 'like', "%{$search}%");
            });
        })

        ->when($category, function ($query) use ($category) {
            $query->where('category_id', $category);
        })

        ->latest()
        ->paginate(5)
        ->withQueryString();

    return view(
        'properties.index',
        compact('properties', 'search', 'categories', 'category')
    );
}
       

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $categories = Category::all();

    return view('properties.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
     public function store(Request $request)
{
    $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'price' => 'required|numeric',
        'location' => 'required',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $image = null;

    if ($request->hasFile('image')) {
        $image = $request->file('image')->store('properties', 'public');
    }

    Property::create([
        'title' => $request->title,
        'description' => $request->description,
        'price' => $request->price,
        'location' => $request->location,
        'category_id' => $request->category_id,
        'image' => $image,
    ]);

    return redirect()->route('properties.index')
        ->with('success', 'Property added successfully.');
}

    /**
     * Display the specified resource.
     */
   public function show(string $id)
{
    $property = Property::with('category')->findOrFail($id);

    return view('properties.show', compact('property'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Property $property)
{
    $categories = Category::all();

    return view('properties.edit', compact('property', 'categories'));
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Property $property)
{
    $request->validate([
        'title' => 'required|max:255',
        'description' => 'required',
        'price' => 'required|numeric',
        'location' => 'required',
        'category_id' => 'required|exists:categories,id',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    $image = $property->image;

    if ($request->hasFile('image')) {
        $image = $request->file('image')->store('properties', 'public');
    }

    $property->update([
        'title' => $request->title,
        'description' => $request->description,
        'price' => $request->price,
        'location' => $request->location,
        'category_id' => $request->category_id,
        'image' => $image,
    ]);

    return redirect()
        ->route('properties.index')
        ->with('success', 'Property updated successfully.');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
{
    $property->delete();

    return redirect()
        ->route('properties.index')
        ->with('success', 'Property deleted successfully.');
}
}
