<?php

namespace App\Http\Controllers;

use App\Models\Activity;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $categories = Category::all();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validated = $request->validate(
            ['name' => 'required|string|max:255|unique:categories',],
            ['name.unique' => "The category name already exists"]
        );

        // Add optional description field
        $validated['description'] = $request->input('description', null);

        $validated['created_by'] = $request->user()->id;

        if ($category = Category::create($validated)) {
            Activity::create([
                'user_id' => Auth::id(),
                'action' => 'create',
                'subject_type' => Category::class,
                'subject_id' => $category->id,
                'description' => 'Added new category: ' . $validated['name'],
            ]);
        }

        return redirect()->route('categories.index')->with('success', 'Category added successfully!');
    }

    /**
     * Show the form for editing the specified category.
     *
     * @param  string  $id
     * @return \Illuminate\View\View
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
        ]);

        $category = Category::findOrFail($id);
        if ($category->update($request->only(['name', 'description']))) {
            Activity::create([
                'user_id' => Auth::id(),
                'action' => 'update',
                'subject_type' => Category::class,
                'subject_id' => $category->id,
                'description' => 'Updated category: ' . $request->name,
            ]);
        }

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    /**
     * Remove the specified category from storage.
     *
     * @param  string  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        if ($category->delete()) {
            Activity::create([
                'user_id' => Auth::id(),
                'action' => 'delete',
                'subject_type' => Category::class,
                'subject_id' => $category->id,
                'description' => 'Deleted category: ' . $category->name,
            ]);
        }

        return redirect()->route('categories.index')->with('success', 'Category deleted successfully!');
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.show', compact('category'));
    }
}
