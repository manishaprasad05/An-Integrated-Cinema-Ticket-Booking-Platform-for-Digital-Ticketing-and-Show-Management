<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Movie;
use Illuminate\Support\Facades\Storage;

class AdminMovieController extends Controller
{
    // ===============================
    // SHOW ALL MOVIES
    // ===============================
    public function index()
    {
        $movies = Movie::latest()->get();
        return view('admin.movies.index', compact('movies'));
    }

    // ===============================
    // SHOW CREATE FORM
    // ===============================
    public function create()
    {
        return view('admin.movies.create');
    }

    // ===============================
    // STORE MOVIE
    // ===============================
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required',
            'language'    => 'required|string|max:100',
            'genre'       => 'required|string|max:100',
            'duration'    => 'required|integer',
            'rating'      => 'required|numeric|min:1|max:10',
            'price'       => 'required|numeric|min:0',
            'trailer_url' => 'nullable|url',
            'poster'      => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $filename = null;

        if ($request->hasFile('poster')) {

            $file = $request->file('poster');

            // Get original file name (without extension)
            $originalName = pathinfo(
                $file->getClientOriginalName(),
                PATHINFO_FILENAME
            );

            $extension = $file->getClientOriginalExtension();

            // Create safe unique name
            $filename = $originalName . '.' . $extension;

            // Store in storage/app/public/posters
            $file->storeAs('posters', $filename, 'public');
        }

        Movie::create([
            'title'       => $request->title,
            'description' => $request->description,
            'language'    => $request->language,
            'genre'       => $request->genre,
            'duration'    => $request->duration,
            'rating'      => $request->rating,
            'price'       => $request->price,
            'trailer_url' => $request->trailer_url,
            'poster'      => $filename,
        ]);

        return redirect()->route('admin.movies.index')
            ->with('success', 'Movie added successfully');
    }

    // ===============================
    // EDIT FORM
    // ===============================
    public function edit($id)
    {
        $movie = Movie::findOrFail($id);
        return view('admin.movies.edit', compact('movie'));
    }

    // ===============================
    // UPDATE MOVIE
    // ===============================
    public function update(Request $request, $id)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required',
            'language'    => 'required|string|max:100',
            'genre'       => 'required|string|max:100',
            'duration'    => 'required|integer',
            'rating'      => 'required|numeric|min:1|max:10',
            'price'       => 'required|numeric|min:0',
            'trailer_url' => 'nullable|url',
            'poster'      => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $movie = Movie::findOrFail($id);

        if ($request->hasFile('poster')) {

            // Delete old image if exists
            if ($movie->poster &&
                Storage::disk('public')->exists('posters/' . $movie->poster)) {

                Storage::disk('public')->delete('posters/' . $movie->poster);
            }

            $file = $request->file('poster');

            $originalName = pathinfo(
                $file->getClientOriginalName(),
                PATHINFO_FILENAME
            );

            $extension = $file->getClientOriginalExtension();

            $filename = $originalName . '.' . $extension;

            $file->storeAs('posters', $filename, 'public');

            $movie->poster = $filename;
        }

        // Update other fields
        $movie->title       = $request->title;
        $movie->description = $request->description;
        $movie->language    = $request->language;
        $movie->genre       = $request->genre;
        $movie->duration    = $request->duration;
        $movie->rating      = $request->rating;
        $movie->price       = $request->price;
        $movie->trailer_url = $request->trailer_url;

        $movie->save();

        return redirect()->route('admin.movies.index')
            ->with('success', 'Movie updated successfully');
    }

    // ===============================
    // DELETE MOVIE
    // ===============================
    public function destroy($id)
    {
        $movie = Movie::findOrFail($id);

        if ($movie->poster &&
            Storage::disk('public')->exists('posters/' . $movie->poster)) {

            Storage::disk('public')->delete('posters/' . $movie->poster);
        }

        $movie->delete();

        return back()->with('success', 'Movie deleted successfully');
    }
}
