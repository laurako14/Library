<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Author;
use App\Models\Publisher;
use App\Models\Genre;
use Illuminate\Http\Request;

class BookController extends Controller
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
        $authors = Author::all();
        $genres = Genre::all();

        if ($request->author_id) {
            // $books = Book::where('author_id', $request->author_id)->get();
            $books = Book::where('author_id', $request->author_id)->paginate(5);
            $filterBy = $request->author_id;
            $books->appends(['author_id' => $request->author_id]);
        } 
        else {
            $books = Book::paginate(5);
        }

        if ($request->sort && 'asc' == $request->sort) {
            $books = $books->sortBy('title');
            $sortBy = 'asc';
        }
        elseif ($request->sort && 'desc' == $request->sort) {
            $books = $books->sortByDesc('title');
            $sortBy = 'desc';
        }


        return view('book.index', ['books' => $books, 'authors' => $authors, 'filterBy' => $filterBy ?? 0, 'sortBy' => $sortBy ?? '', 'genres' => $genres]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $authors = Author::all();
        $publishers = Publisher::all();
        $genres = Genre::all();
        return view('book.create', ['authors' => $authors, 'publishers' => $publishers, 'genres' => $genres]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $book = new Book;
        $book->title = $request->book_title;
        $book->isbn = $request->book_isbn;
        $book->pages = $request->book_pages;
        $book->about = $request->book_about;
        $book->author_id = $request->author_id;
        $book->publisher_id = $request->publisher_id;
        $book->genre_id = $request->genre_id;
        $book->save();
        return redirect()->route('book.index')->with('success_message', 'Stored successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {
        return view('book.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $authors = Author::all();
        $publishers = Publisher::all();
        return view('book.edit', ['book' => $book, 'authors' => $authors, 'publishers' => $publishers]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Book $book)
    {
        $book->title = $request->book_title;
        $book->isbn = $request->book_isbn;
        $book->pages = $request->book_pages;
        $book->about = $request->book_about;
        $book->author_id = $request->author_id;
        $book->publisher_id = $request->publisher_id;
        $book->save();
        return redirect()->route('book.index')->with('success_message', 'Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('book.index')->with('success_message', 'Deleted successfully');
    }

    public function search(Request $request) 
    {
        $books = Book::where([
            ['title', '!=', Null],
            [function ($query) use ($request) {
                if (($term = $request->term)) {
                    $query->orWhere('title', 'LIKE', '%' . $term . '%')->get();
                }
            }]
        ])
        ->orderBy("id", "desc")
        ->paginate(10);

        return view('book.search', ['books' => $books])->with('i', (request()->input('page', 1) - 1) * 5);
    }
}
