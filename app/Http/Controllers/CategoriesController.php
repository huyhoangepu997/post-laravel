<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Http\Requests\Categories\UpdateCategoriesRequest;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories= Category::all();
//        dd($categories[0] -> name);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateCategoryRequest $request)
    {
        $categoryStore = $request -> all();
        $category = new Category();
        $category -> name = $categoryStore['name'];
        $category -> save();

        session() -> flash('success', '"' . $category -> name . '" ' . 'created successfully!');

        return redirect() -> route('categories.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category) // using model binding
    {
        return view('categories.create', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateCategoriesRequest $request
     * @param Category $category
     * @return void
     */
    public function update(UpdateCategoriesRequest $request, Category $category)
    {

        $category -> name = $request -> name;

        $category -> save();

        session() -> flash('success', '"' . $category -> name . '" updated successfully!');

        return redirect(route('categories.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $category
     * @return void
     */
    public function destroy(Category $category)
    {
        $category -> delete();

        session() -> flash('success', '"' . $category -> name . '" deleted successfully!');

        return redirect(route('categories.index'));
    }
}
