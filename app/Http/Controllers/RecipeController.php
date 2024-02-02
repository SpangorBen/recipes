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
        //
        $categories = Category::all();
        $recipes = Recipe::all();

        return view('welcome', compact('recipes', 'categories'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $recipe = new Recipe;
        $recipe->name = $request->name;
        $recipe->description = $request->description;
        $recipe->prep_time = $request->prep_time;
        $recipe->ingredients = $request->ingredients;
        $recipe->categories_id = $request->category;
        $recipe->save();

        return $this->index();
        // return view('welcome');
    }

    /**
     * Display the specified resource.
     */
    public function show(recipe $recipe)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(recipe $recipe)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, recipe $recipe)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(recipe $recipe)
    {
        //
    }
}
