<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Feature;
use Livewire\Attributes\Validate;

class FeatureController extends Controller
{
    public function index(){

        $features = Feature::all();
        return view('admin.feature.index',compact('features'));

    }


    public function create(){


        return view('admin.feature.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);


        Feature::create([
        'title' => $request->title,
        'description' => $request->description,
    ]);

        return redirect()->route('features.index')->with('success', 'Feature created successfully.');
    }


    public function destroy(string $id){

        $feature = feature::findOrFail($id);
        $feature->delete();

        return redirect()->route('features.index')->with('success', 'Feature deleted successfully.');
    }
    

        



}
