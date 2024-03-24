<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        $recipes = Recipe::orderBy('created_at', 'desc')->paginate(7);

        return view('welcome', compact('recipes', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'prep_time' => 'required|integer',
            'ingredients' => 'required|string',
            'category' => 'required|exists:categories,id',
            // 'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $recipe = new Recipe;

        $imageName = time() . '.' . $request->image->extension();
        $imageUrl = $request->file('image')->storeAs('public/pics', $imageName);

        $recipe->name = $request->name;
        $recipe->description = $request->description;
        $recipe->prep_time = $request->prep_time;
        $recipe->ingredients = $request->ingredients;
        $recipe->categories_id = $request->category;
        if (isset($imageUrl)) {
            $recipe->image = $imageName;
        }
        $recipe->save();

        return redirect()->route('welcome');
    }

    /**
     * Display the specified resource.
     */
    public function show(Recipe $recipe)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Recipe $recipe)
    {
        $categories = Category::all();
        return view('edit', compact('recipe', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Recipe $recipe)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'prep_time' => 'required|integer',
            'ingredients' => 'required|string',
            'category' => 'required|exists:categories,id',
        ]);

        $recipe->name = $request->name;
        $recipe->description = $request->description;
        $recipe->prep_time = $request->prep_time;
        $recipe->ingredients = $request->ingredients;
        $recipe->categories_id = $request->category;
        $recipe->save();

        return redirect()->route('welcome')->with('success', 'Recipe updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Recipe $recipe)
    {
        $recipe->delete();

        return redirect()->route('welcome')->with('success', 'Recipe deleted successfully');
    }

    public function search(Request $request){
        $query = $request->input('query');
        $categories = Category::all();

        $recipes = Recipe::where('name', 'like', '%'.$query.'%')
                        ->orWhere('description', 'like', '%'.$query.'%')
                        ->get();
    
        if(!$query){
            return $this->index();
        }
        return view('welcome', compact('recipes', 'query', 'categories'));
    }
}
