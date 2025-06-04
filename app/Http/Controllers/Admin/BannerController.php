<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        return view('admin.banner.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banner.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'required|string|max:255',
            'hero_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cta_button_text' => 'required|string|max:255',
            'price' => 'required|numeric',
            'featured_plan_id' => 'nullable|integer',
        ]);

        if ($request->hasFile('hero_image')) {
            $image = $request->file('hero_image');
            $uploadedFile = Cloudinary::uploadApi()->upload($image->getRealPath());
            $data['hero_image'] = $uploadedFile['secure_url'];
        }

        Banner::create($data);
        return redirect()->route('banners.index')->with('success', 'Banner created successfully.');
    }

    // Edit form
    public function edit($id)
    {
        $banner = Banner::findOrFail($id);
        return view('admin.banner.edit', compact('banner'));
    }

    // Update method
    public function update(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);

        $data = $request->validate([
            'hero_title' => 'required|string|max:255',
            'hero_subtitle' => 'required|string|max:255',
            'hero_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'cta_button_text' => 'required|string|max:255',
            'price' => 'required|numeric',
            'featured_plan_id' => 'nullable|integer',
        ]);

        if ($request->hasFile('hero_image')) {
            $image = $request->file('hero_image');
            $uploadedFile = Cloudinary::uploadApi()->upload($image->getRealPath());
            $data['hero_image'] = $uploadedFile['secure_url'];
        }

        $banner->update($data);

        return redirect()->route('banners.index')->with('success', 'Banner updated successfully.');
    }

    // Destroy method for deleting
    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();

        return redirect()->route('banners.index')->with('success', 'Banner deleted successfully.');
    }
}
