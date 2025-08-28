<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class CategoryController extends Controller
{
    use AuthorizesRequests;

    public function index(Category $categories)
    {
        if (!Auth::user()->hasRole('admin') || !Auth::user()->hasPermissionTo('manage_categories')) {
            abort(403, 'Unauthorized');
        }
        $categories=Category::all();
        return view('categories.index',compact('categories'));
    }

    public function create()
    {
        if (!Auth::user()->hasRole('admin') || !Auth::user()->hasPermissionTo('manage_categories')) {
            abort(403, 'Unauthorized');
        }
        return view('categories.create');
    }


    public function store(Request $request)
    {
        if (!Auth::user()->hasRole('admin') || !Auth::user()->hasPermissionTo('manage_categories')) {
            abort(403, 'Unauthorized');
        }
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

    public function show(String $id)
    {
        if (!Auth::user()->hasRole('admin') || !Auth::user()->hasPermissionTo('manage_categories')) {
            abort(403, 'Unauthorized');
        }
        $category=Category::find($id);
        return view('categories.show',compact('category'));
    }


    public function edit(Category $category)
    {
        if (!Auth::user()->hasRole('admin') || !Auth::user()->hasPermissionTo('manage_categories')) {
            abort(403, 'Unauthorized');
        }

        return view('categories.edit',compact('category'));
    }

    public function update(Request $request, string $id)
    {
        if (!Auth::user()->hasRole('admin') || !Auth::user()->hasPermissionTo('manage_categories')) {
            abort(403, 'Unauthorized');
        }
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
        if (!Auth::user()->hasRole('admin') || !Auth::user()->hasPermissionTo('manage_categories')) {
            abort(403, 'Unauthorized');
        }
        if ($category->image) {
            Storage::delete($category->image);
        }
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Category deleted successfully');
        
        
    }
}
