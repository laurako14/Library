<?php

namespace App\Http\Controllers;

use App\Models\Genre;
use Illuminate\Http\Request;
use Validator;

class GenreController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->sort == 'name') {
            $genres = Genre::orderBy('name')->get();
        }
        else {
            $genres = Genre::all();
        }
        // $genres = Genre::all();

        // $authors = Author::orderBy('surname', 'desc')->get();

        return view('genre.index', ['genres' => $genres]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('genre.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),
       [
           'genre_name' => ['required', 'min:3', 'max:64']
       ],
        [
            'genre_name.required' => 'Please enter name',
            'genre_name.min' => 'Name too short'
        ]
       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }
 
        $genre = new Genre;
        $genre->name = $request->genre_name;
        $genre->save();
        return redirect()->route('genre.index')->with('success_message', 'Stored successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function show(Genre $genre)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function edit(Genre $genre)
    {
        return view('genre.edit', ['genre' => $genre]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Genre $genre)
    {
        $validator = Validator::make($request->all(),
        [
            'genre_name' => ['required', 'min:3', 'max:64']
        ],
         [
             'genre_name.required' => 'Please enter name',
             'genre_name.min' => 'Name too short'
         ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $genre->name = $request->genre_name;
        $genre->save();
        return redirect()->route('genre.index')->with('success_message', 'Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Genre  $genre
     * @return \Illuminate\Http\Response
     */
    public function destroy(Genre $genre)
    {
        if($genre->genreBooks->count()){
            return redirect()->route('genre.index')->with('info_message', 'Cannot delete genre who has books.');
        }
        $genre->delete();
        return redirect()->route('genre.index')->with('success_message', 'Deleted successfully.');
    }
}
