<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CategoryController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::all();
        return view('categories.index',compact('categories'));
    }

    public function create(Category $category)
    {
        return view('categories.create',compact('category'));
    }


    public function store(Request $request)
    {
        $data=$request->validate([
            'title'=>'required|string|max:50',
            'image'=>'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        Category::create([
            'title'=>$data['title'],
            'image'=>$data['image'],
        ]);
        return redirect()->route('categories.index');
    }

    public function show(Category $category)
    {
        return view('categories.show',compact('category'));
    }


    public function edit(string $id)
    {
        return view('categories.edit');
    }

    public function update(Request $request, string $id)
    {
        $validated=$request->validate([
            'title'=>'required|string|max:50',
        ]);
        $category=Category::find($id);
        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::delete($category->image);
            }
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $imageName);
            $validated['image'] = $imageName;
        }
        $category->update([
            'title'=>$validated['title'],
            'image'=>$validated['image'],
        ]);
        return redirect()->route('categories.index');
        
    }

    public function destroy(Category $category)
    {
        $this->authorize('delete', $category);
        if ($category->image) {
            Storage::delete($category->image);
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
        
        
    }
}
