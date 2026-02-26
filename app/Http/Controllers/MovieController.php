<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Booking;
use App\Models\Show;

class MovieController extends Controller
{
    // 🎬 Welcome Page
public function welcome()
{
    $movies = Movie::latest()->take(4)->get();
    $upcomingMovies = Movie::latest()->skip(4)->take(4)->get();

    return view('welcome', compact('movies', 'upcomingMovies'));
}



    // menu Movies page + Search + Filter
    public function index(Request $request)
    {
        $movies = Movie::query();

        // 🔍 Search by movie title
        if ($request->filled('q')) {
            $movies->where('title', 'LIKE', '%' . $request->q . '%');
        }

        // 🌐 Filter by language
        if ($request->filled('language')) {
            $movies->where('language', $request->language);
        }

        // 🎭 Filter by genre
        if ($request->filled('genre')) {
            $movies->where('genre', $request->genre);
        }

        return view('movie', [
            'movies' => $movies->get()
        ]);
    }

    // 🎬 Movie details page
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        return view('movie-details', compact('movie'));
    }

    // 🎟️ Seat Selection Page
    public function seats($id)
    {
        $movie = Movie::findOrFail($id);

        // Get booked seats for this movie
        $bookedSeats = Booking::where('movie_id', $id)
            ->pluck('seats')
            ->toArray();

        return view('seat', compact('movie', 'bookedSeats'));
    }

    // 🎥 Store New Movie (UPDATED IMAGE LOGIC)
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'poster' => 'required|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $fileName = null;

        if ($request->hasFile('poster')) {

            // Get original file name (without extension)
            $originalName = pathinfo(
                $request->poster->getClientOriginalName(),
                PATHINFO_FILENAME
            );

            // Get extension
            $extension = $request->poster->getClientOriginalExtension();

            // Create safe unique name (avoid overwrite)
            $fileName = $originalName .'.' . $extension;

            // Move file to public/posters
            $request->poster->move(public_path('posters'), $fileName);
        }

        Movie::create([
            'title' => $request->title,
            'description' => $request->description,
            'poster' => $fileName
        ]);

        return redirect()->route('movies.index')
            ->with('success', 'Movie Added Successfully');
    }
}
