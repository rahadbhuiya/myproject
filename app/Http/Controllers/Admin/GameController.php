<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Game;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class GameController extends Controller
{
    // Show games list
    public function index()
    {
        $games = Game::with('category')->get();
        return view('admin.games.index', compact('games'));
    }

    // Show create game form
    public function create()
    {
        $categories = Category::all();
        return view('admin.games.create', compact('categories'));
    }

    // Store new game
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $game = new Game();
        $game->name = $request->name;
        $game->description = $request->description;
        $game->category_id = $request->category_id;

        if ($request->hasFile('logo')) {
            $image = $request->file('logo');
            $uploadedFile = Cloudinary::uploadApi()->upload($image->getRealPath());
            $game->logo = $uploadedFile['secure_url']; 
            $game->logo_public_id = $uploadedFile['public_id'] ?? null; // save public id if you want to delete later
        }

        $game->save();

        return redirect()->route('games.index')->with('success', 'Game added successfully');
    }

    // Show edit game form
    public function edit($id)
    {
        $game = Game::findOrFail($id);
        $categories = Category::all();
        return view('admin.games.edit', compact('game', 'categories')); // use admin.game.edit consistently
    }

    // Update existing game
    public function update(Request $request, $id)
    {
        $game = Game::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
        ]);

        $game->name = $request->name;
        $game->description = $request->description;
        $game->category_id = $request->category_id;

        if ($request->hasFile('logo')) {
            // Delete old logo from Cloudinary if exists
            if ($game->logo_public_id) {
                Cloudinary::uploadApi()->destroy($game->logo_public_id);
            }

            // Upload new logo
            $image = $request->file('logo');
            $uploadedFile = Cloudinary::uploadApi()->upload($image->getRealPath());
            $game->logo = $uploadedFile['secure_url'];
            $game->logo_public_id = $uploadedFile['public_id'] ?? null;
        }

        $game->save();

        return redirect()->route('games.index')->with('success', 'Game updated successfully');
    }

    // Delete game
    public function destroy($id)
    {
        $game = Game::findOrFail($id);

        // Delete logo from Cloudinary if exists
        if ($game->logo_public_id) {
            Cloudinary::uploadApi()->destroy($game->logo_public_id);
        }

        $game->delete();

        return redirect()->route('games.index')->with('success', 'Game deleted successfully');
    }
}
