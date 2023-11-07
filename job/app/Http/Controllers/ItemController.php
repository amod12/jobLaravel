<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ItemController extends Controller
{
   // Show all items
   public function index() {
    return view('item.index', [
        'items' => Item::latest()->filter(request(['tag', 'search']))->paginate(6)
    ]);
}

//Show single item
public function show(Item $item) {
    return view('item.show', [
        'item' => $item
    ]);
}

public function create() {
    return view('item.create');
}

public function store(Request $request) {
    // dd($request->all());
    $formFields = $request->validate([
        'title' => 'required',
        'company' => ['required', Rule::unique('items', 'company')],
        'location' => 'required',
        'website' => 'required',
        'email' => ['required', 'email'],
        'tags' => 'required',
        'description' => 'required'
    ]);

    if($request->hasFile('logo')) {
        $formFields['logo'] = $request->file('logo')->store('logos', 'public');
    }

    $formFields['user_id'] = auth()->id();

    Item::create($formFields);

    return redirect('/')->with('message', 'item created successfully!');
}

public function edit(Item $item) {
    return view('item.edit', ['item' => $item]);
}


    // Update item Data
public function update(Request $request, Item $item) {
        // Make sure logged in user is owner
        if($item->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        $formFields = $request->validate([
            'title' => 'required',
            'company' => ['required'],
            'location' => 'required',
            'website' => 'required',
            'email' => ['required', 'email'],
            'tags' => 'required',
            'description' => 'required'
        ]);

        if($request->hasFile('logo')) {
            $formFields['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $item->update($formFields);

        return back()->with('message', 'item updated successfully!');
    }

    public function destroy(Item $item) {
        // Make sure logged in user is owner
        if($item->user_id != auth()->id()) {
            abort(403, 'Unauthorized Action');
        }
        
        if($item->logo && Storage::disk('public')->exists($item->logo)) {
            Storage::disk('public')->delete($item->logo);
        }
        $item->delete();
        return redirect('/')->with('message', 'item deleted successfully');
    }

    // Manage items
    public function manage() {
        // return view('item.manage', ['items' => auth()->user()->items->get()]);

        return view('item.manage', ['items' => auth()->user()->items]);
        // $user =auth()->user();
        // return view('item.manage', ['items' => $user->items]);

    }

}
