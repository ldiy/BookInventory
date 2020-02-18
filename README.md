# BookInventory
A webapp for managing all your books!

Written in PHP with Laravel.

## Installation

See the [Laravel documentation](https://laravel.com/docs/6.x/testing#environment) for more info.

1. Create a mysql database called **bookinventory**
2. Create a **.env** file with the following entries:
```
APP_NAME=BookInventory
APP_ENV=local
APP_KEY=base64:tw3+VaCwN7TkwpdM9ytXxaGcVHFbiwY32MWqbE/O1wU=
APP_DEBUG=true
APP_URL=http://localhost

LOG_CHANNEL=stack

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bookinventory
DB_USERNAME=root
DB_PASSWORD=
```
3. Run the command **php artisan migrate** to make all the tables needed for this application.
4. Set up your webserver: [Laravel documentation](https://laravel.com/docs/6.x/deployment#nginx)

## Screenshots
### Frontpage:
![frontpage](https://github.com/ldiy/BookInventory/raw/master/screenshots/frontpage.jpg)
### View book:
![book](https://github.com/ldiy/BookInventory/raw/master/screenshots/book.jpg)
### Add book:
![addBook](https://github.com/ldiy/BookInventory/raw/master/screenshots/AddBook.jpg)
## Notes
This application scrapes a website [https://zoekeenboek.nl/](https://zoekeenboek.nl/) to get more details about a book. Before using this appliaction, check if it is legal in your country to scrape websites.

You can change where the application gets it data in the function **get_info_by_isbn** located in this file: **App/Http/Controllers/BooksController.php**

```php
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
```
