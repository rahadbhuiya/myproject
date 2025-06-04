<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Show categories list
    public function index()
    {
        $categories = Category::all();
        return view("admin.categories.index", compact('categories'));
    }

    // Show create category form
    public function create()
    {
        return view('admin.categories.create');
    }

    // Store new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            $uploadedFile = Cloudinary::uploadApi()->upload(
                $request->file('image')->getRealPath(),
                ['folder' => 'categories']
            );
            $category->image = $uploadedFile['secure_url'];
            $category->image_public_id = $uploadedFile['public_id'];
        }

        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Category added successfully');
    }

    // Show edit category form
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }

    // Update category
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string|max:1000',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $category->name = $request->name;
        $category->description = $request->description;

        if ($request->hasFile('image')) {
            // Delete old image from Cloudinary if public ID exists
            if (!empty($category->image_public_id)) {
                Cloudinary::uploadApi()->destroy($category->image_public_id);
            }

            // Upload new image
            $uploadedImage = Cloudinary::uploadApi()->upload(
                $request->file('image')->getRealPath(),
                ['folder' => 'categories']
            );

            $category->image = $uploadedImage['secure_url'];
            $category->image_public_id = $uploadedImage['public_id'];
        }

        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    // Delete category
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Delete image from Cloudinary if exists
        if (!empty($category->image_public_id)) {
            Cloudinary::uploadApi()->destroy($category->image_public_id);
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
