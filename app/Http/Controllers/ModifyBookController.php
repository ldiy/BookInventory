<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;
use Goutte\Client;

class ModifyBookController extends Controller
{
    //
    public function get_info_by_isbn($isbn)
    {
        // Get html of webpage
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

    public function add()
    {
        $data = $this->get_info_by_isbn(request(('isbn'))); // get info from online service
        $book = new Book;

        $book->title = $data['title'];
        $book->isbn = request('isbn');
        $book->author = $data['Auteur'];
        $book->number_of_pages = (int) filter_var($data["Aantal pagina's"], FILTER_SANITIZE_NUMBER_INT);
        $book->cover_image_url = $data['cover_url'];
        $book->publisher = $data['Uitgever'];

        $book->save();
    }
}
