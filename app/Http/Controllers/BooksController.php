<?php

namespace App\Http\Controllers;

use App\Book;
use App\Serie;
use Goutte\Client;
use Illuminate\Http\Request;

class BooksController extends Controller
{
    /**
     * Display all books.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $books = Book::orderBy('created_at', 'desc')->paginate(20);

        return view('books.index', ['books' => $books]);
    }


    /**
     * Search for a book
     *
     * @return \Illuminate\Http\Response
     */
    public function search()
    {
        $q = request('q');

        $books = Book::where('title', 'LIKE', '%' . $q .'%')
                        ->orWhere('series', 'LIKE', '%' . $q . '%')
                        ->orWhere('isbn', 'LIKE', '%' . $q . '%')
                        ->orWhere('author', 'LIKE', '%' . $q . '%')
                        ->orWhere('publisher', 'LIKE', '%' . $q . '%')
                        ->orderBy('title', 'asc')
                        ->paginate(20);

        return view('books.index', ['books' => $books]);
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $series = Serie::orderBy('created_at', 'desc')->get();
        return view('books.create', ['series' => $series]);
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Scrape all the date from online service
        $data = $this->get_info_by_isbn(request(('isbn')));

        // Check if book is already in DB
        if(Book::where('isbn', request('isbn'))->count() > 0) return $data;

        // Create a new book
        $book = new Book;

        /* Set all data */
        $book->isbn = request('isbn');
        $book->series = request('series');

        if(array_key_exists("title", $data))
            $book->title = $data['title'];

        if(array_key_exists("Auteur", $data))
            $book->author = $data['Auteur'];

        if(array_key_exists("Aantal pagina's", $data))
            $book->number_of_pages = (int) filter_var($data["Aantal pagina's"], FILTER_SANITIZE_NUMBER_INT);    // Get numbers out of string

        if(array_key_exists("Uitgever", $data))
            $book->publisher = $data['Uitgever'];

        if(array_key_exists("Aantal pagina's", $data))
        {
            if(substr(  $data['cover_url'], 0, 4 ) != "http")   // Check if url starts with 'http'
                $data['cover_url'] = "https://www.zoekeenboek.nl/" .  $data['cover_url'];
            $book->cover_image_url = $data['cover_url'];
        }

        // Save
        $book->save();

        // Return data in Json
        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function show(Book $book)
    {

        return view('books.show', ['book' => $book]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        $series = Serie::orderBy('created_at', 'desc')->get();
        return view('books.edit', ['book' => $book, 'series' => $series]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function update( Book $book)
    {
        $book->update(request()->validate([
            "isbn" => "required",
            "title" => "required",
            "cover_image_url" => "required",
            "number_of_pages" => "numeric",
            "author" => "present",
            "publisher" => "present",
            "series" => "present"
        ]));
        return redirect('/books/' . $book->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Book  $book
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
        return redirect('/books');
    }

    public function get_info_by_isbn($isbn)
    {
        // Get html from web page
        $url = "https://www.zoekeenboek.nl/process/?zoektekst=" . \request('isbn');
        $client = new Client();
        $crawler = $client->request('GET', $url);

        // Get name of properties
        $labels = $crawler->filter('.label')->each(function ($node){
            return $posts[] = $node->text();
        });
        // Get value of properties
        $values = $crawler->filter('.value')->each(function ($node){
            return $posts[] = $node->text();
        });

        // Get url of cover image
        array_push($labels,"cover_url");
        array_push($values,$crawler->filter('.fullCover')->first()->attr('src'));

        // Get title
        array_push($labels,"title");
        array_push($values, str_replace('"',"",$crawler->filter('.kopen')->filter('strong')->first()->text()));

        // Combine into data into associative array
        $data = array_combine($labels,$values);

        return $data;
    }
}
