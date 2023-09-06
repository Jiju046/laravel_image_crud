<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Image;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function index()
    {
        $images = Image::all();
        return view('images.index', compact('images'));
    }

    public function create()
    {
        return view('images.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust validation rules as needed
        ]);

        $imagePath = $request->file('image')->store('uploads', 'public');

        Image::create([
            'name' => $request->input('name'),
            'path' => $imagePath,
        ]);

        return redirect()->route('images.index')->with('success', 'Image uploaded successfully.');
    }

    public function edit($id)
    {
        $image = Image::findOrFail($id);
        return view('images.edit', compact('image'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $image = Image::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete the previous image from storage
            Storage::disk('public')->delete($image->path);

            // Upload and store the new image
            $imagePath = $request->file('image')->store('uploads', 'public');
            $image->path = $imagePath;
        }

        $image->name = $request->input('name');
        $image->save();

        return redirect()->route('images.index')->with('success', 'Image updated successfully.');
    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);

        // Delete the image file from storage
        Storage::disk('public')->delete($image->path);

        // Delete the record from the database
        $image->delete();

        return redirect()->route('images.index')->with('success', 'Image deleted successfully.');
    }
}

