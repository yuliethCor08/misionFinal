<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $movie = Movie::all();
            if (count($movie)===0) {
                return response()->json([
                    'error' => 'No movie found'
                ],404);
            }
            return response()->json($movie, 200);

        } catch (\Exception $e) {
            return response()->json([
                'error' => $e -> getMessage()
            ],400);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'author' => 'required|string',
            'year' => 'required|date',
            'description' => 'nullable|string|max:255'
           
        ]);

        $movie = Movie::create([
            'name' => $request -> name,
            'author' => $request -> author,
            'year' => $request -> year,
            'description' => $request -> description,
            'featured' => $request -> featured
        ]);
        return response()->json([
            'movies' => $movie
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        try {
            $movie = Movie::all();
            return response()->json($movie, 200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e -> getMessage()
            ],400);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Movie $movie)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Movie $movie)
    {
        try {
            $movie = Movie::find($id);
            if (count($movie)===0) {
                return response()->json([
                    'error' => 'No movie found'
                ],404);
            }
            Movie::destroy($id);
            return response()->json([
                'message' => 'Movie deleted successfully'
            ],200);
        } catch (\Exception $e) {
            return response()->json([
                'error' => $e -> getMessage()
            ],400);
        }
    }
}
