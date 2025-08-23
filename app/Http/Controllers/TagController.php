<?php

namespace App\Http\Controllers;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class TagController extends Controller
{
    use AuthorizesRequests;

    public function index(){
        $tags=Tag::all();
        return view('tags.index',compact('tags'));
    }
    public function create()
    {
        return view('tags.create');
    }

    function store(Request $request)
    {

        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:tags,name',
        ]);

        $tag = Tag::create($validated);

        return response()->json(['tag' => $tag, 'status' => 'success']);
    }
    public function show(string $id)
    {
        $tag=Tag::find($id);
        return view('tags.show',compact('tag'));
    }

    public function edit(string $id)
    {
        return view('tags.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
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
        Tag::find($id)->delete();
        return redirect()->route('tags.index');
        
    }
}
