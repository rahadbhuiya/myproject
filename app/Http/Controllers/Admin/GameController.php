<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Game;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;

class GameController extends Controller
{
    // Show list of games
    public function index()
    {
        $games = Game::with('category')->get();
        return view('admin.games.index', compact('games'));
    }

    // Show form to create a new game
    public function create()
    {
        $categories = Category::all();
        return view('admin.games.create', compact('categories'));
    }

    // Store new game in database
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
            $uploadedFile = Cloudinary::uploadApi()->upload($image->getRealPath(), [
                'folder' => 'games'
            ]);
            $game->logo = $uploadedFile['secure_url'];
            $game->logo_public_id = $uploadedFile['public_id'];
        }

        $game->save();

        return redirect()->route('admin.games.index')->with('success', 'Game added successfully');
    }

    // Show form to edit an existing game
    public function edit($id)
    {
        $game = Game::findOrFail($id);
        $categories = Category::all();
        return view('admin.games.edit', compact('game', 'categories'));
    }

    // Update the game details
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

            $image = $request->file('logo');
            $uploadedFile = Cloudinary::uploadApi()->upload($image->getRealPath(), [
                'folder' => 'games'
            ]);
            $game->logo = $uploadedFile['secure_url'];
            $game->logo_public_id = $uploadedFile['public_id'];
        }

        $game->save();

        return redirect()->route('admin.games.index')->with('success', 'Game updated successfully');
    }

    // Delete a game
    public function destroy($id)
    {
        $game = Game::findOrFail($id);

        if ($game->logo_public_id) {
            Cloudinary::uploadApi()->destroy($game->logo_public_id);
        }

        $game->delete();

        return redirect()->route('admin.games.index')->with('success', 'Game deleted successfully');
    }
}
