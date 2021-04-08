<?php

namespace App\Http\Controllers;

use App\Models\Publisher;
use Illuminate\Http\Request;
use Validator;

class PublisherController extends Controller
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
            $publishers = Publisher::orderBy('name')->get();
        }
        else {
            $publishers = Publisher::all();
        }
        // $publishers = Publisher::all();

        // $authors = Author::orderBy('surname', 'desc')->get();

        return view('publisher.index', ['publishers' => $publishers]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('publisher.create');
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
           'publisher_name' => ['required', 'min:3', 'max:64']
       ],
        [
            'publisher_name.required' => 'Please enter publisher',
            'publisher_name.min' => 'Name too short'
        ]
       );
       if ($validator->fails()) {
           $request->flash();
           return redirect()->back()->withErrors($validator);
       }
 
        $publisher = new Publisher;
        $publisher->name = $request->publisher_name;
        $publisher->save();
        return redirect()->route('publisher.index')->with('success_message', 'Stored successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function show(Publisher $publisher)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function edit(Publisher $publisher)
    {
        return view('publisher.edit', ['publisher' => $publisher]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Publisher $publisher)
    {
        $validator = Validator::make($request->all(),
        [
            'publisher_name' => ['required', 'min:3', 'max:64']
        ],
         [
             'publisher_name.required' => 'Please enter name',
             'publisher_name.min' => 'Name too short'
         ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $publisher->name = $request->publisher_name;
        $publisher->save();
        return redirect()->route('publisher.index')->with('success_message', 'Updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Publisher  $publisher
     * @return \Illuminate\Http\Response
     */
    public function destroy(Publisher $publisher)
    {
        if($publisher->publisherBooks->count()){
            return redirect()->route('publisher.index')->with('info_message', 'Cannot delete publisher who has books.');
        }
        $publisher->delete();
        return redirect()->route('publisher.index')->with('success_message', 'Deleted successfully.');
    }
}
