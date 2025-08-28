<?php

namespace App\Http\Controllers;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TagController extends Controller
{
    use AuthorizesRequests;

    public function index(){
        if (!Auth::user()->hasRole('admin') || !Auth::user()->hasPermissionTo('manage_tags')) {
            abort(403, 'Unauthorized');
        }
        $tags=Tag::all();
        return view('tags.index',compact('tags'));
    }

    public function create()
    {
        if (!Auth::user()->hasRole('admin') || !Auth::user()->hasPermissionTo('manage_tags')) {
            abort(403, 'Unauthorized');
        }
        return view('tags.create');
    }

    function store(Request $request)
    {
        if (!Auth::user()->hasRole('admin') || !Auth::user()->hasPermissionTo('manage_tags')) {
            abort(403, 'Unauthorized');
        }

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
        ]);

        Tag::create($validated);

        return redirect()->route('tags.index');
    }
    public function show(string $id)
    {
        if (!Auth::user()->hasRole('admin') || !Auth::user()->hasPermissionTo('manage_tags')) {
            abort(403, 'Unauthorized');
        }

        $tags=Tag::find($id);
        return view('tags.show',compact('tags'));
    }

    public function edit(Tag $tag)
    {
        if (!Auth::user()->hasRole('admin') || !Auth::user()->hasPermissionTo('manage_tags')) {
            abort(403, 'Unauthorized');
        }
        return view('tags.edit',compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Auth::user()->hasRole('admin') || !Auth::user()->hasPermissionTo('manage_tags')) {
            abort(403, 'Unauthorized');
        }
        $validated=$request->validate([
            'name'=>'required|string|max:50',
        ]);

        Tag::find($id)->update([
            'name'=>$validated['name'],
        ]);
        return redirect()->route('tags.index');
    }

    public function destroy(string $id)
    {
        if (!Auth::user()->hasRole('admin') || !Auth::user()->hasPermissionTo('manage_tags')) {
            abort(403, 'Unauthorized');
        }
        Tag::find($id)->delete();
        return redirect()->route('tags.index');
        
    }
}
