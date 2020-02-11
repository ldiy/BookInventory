<?php

namespace App\Http\Controllers;

use App\Book;
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
     * @param $keyword
     * @return \Illuminate\Http\Response
     */
    public function search($keyword)
    {

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('books.create');
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

        // Set all data
        $book->title = $data['title'];
        $book->isbn = request('isbn');
        $book->author = $data['Auteur'];
        $book->number_of_pages = (int) filter_var($data["Aantal pagina's"], FILTER_SANITIZE_NUMBER_INT);
        $book->cover_image_url = $data['cover_url'];
        $book->publisher = $data['Uitgever'];

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
        return view('books.edit', ['book' => $book]);
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
