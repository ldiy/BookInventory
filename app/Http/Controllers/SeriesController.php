<?php

namespace App\Http\Controllers;

use App\Book;
use App\Serie;
use Illuminate\Http\Request;

class SeriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $series = Serie::orderBy('created_at', 'desc')->paginate(20);

        return view('series.index', ['series' => $series]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('series.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Serie::create($request->validate([
            'name' => 'required',
            'image_url' => 'required'
        ]));
        return redirect('/series');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function show(Serie $serie)
    {
        //$books = Book::where('series', $serie->id)->paginate(20);
        $books = $serie->books;
        return view('series.show',['series' => $serie, 'books' => $books]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function edit(Serie $serie)
    {
        return view('series.edit',['series' => $serie]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Serie $serie)
    {
        $serie->update(request()->validate([
            'name' => 'required',
            'image_url' => 'required'
        ]));
        return redirect('/series/' . $serie->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Serie  $serie
     * @return \Illuminate\Http\Response
     */
    public function destroy(Serie $serie)
    {
        $books = $serie->books;
        foreach ($books as $book)
        {
            Book::destroy($book->id);
        }

        $serie->delete();
        return redirect('/series');
    }
}
