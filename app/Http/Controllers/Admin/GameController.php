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
        return view('admin.game.index', compact('games'));
    }

    // Show create game form
    public function create()
    {
        $categories = Category::all();
        return view('admin.game.create', compact('categories'));
    }

    // Store new game
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif',
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
            }

        $game->save();

        return redirect()->route('games.index')->with('success', 'Game added successfully');
    }

    // Show edit game form
    public function edit($id)
    {
        $game = Game::findOrFail($id);
        $categories = Category::all();
        return view('games.edit', compact('game', 'categories'));
    }

   


    // Delete game
    public function destroy($id)
    {
        $game = Game::findOrFail($id);
        $game->delete();

        return redirect()->route('games.index')->with('success', 'Game deleted successfully');
    }
}
