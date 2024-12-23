<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index(){
        $categories = Category::all(); //fetch all the categories 
        return view('admin.categories.index', compact('categories'));
    }


    public function create(){
        return view('admin.categories.create');
    }

    //handle form submissions and save the category to the database
    public function store(Request $request){

        // validate form input
        $validatedData = $request->validate([
            'name'=>'required|string|max:255',
        ]);

        // save the category to the database
        Category::create($validatedData);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    public function edit($id){
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'name'=>'required|string|max:255', 
        ]);

        $category = Category::findOrFail($id);
        $category->update($validated);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy($id){
        Category::findOrFail($id)->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
