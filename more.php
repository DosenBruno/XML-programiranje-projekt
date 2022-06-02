<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="style.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <title>Bookstop</title>
    </head>
    <body class="wrapper">
    <div class="container">
            <header class="row pb-1 bg-dark shadow">
                <div class="container mx-2">
                    <nav class="navbar navbar-expand-lg navbar-expand-xlg navbar-expand-md navbar-expand-sm navbar-expand navbar-dark">
                        <section class="navbar-brand">
                            <a href="#" class="link_reset "><h2>Bookstop</h2></a>
                        </section>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav">
                                <li class="nav-item active ml-2"><a class="nav-link" href="book_collection.xml">Home</a></li>
                                <li class="nav-item active ml-2"><a class="nav-link" href="index.php">Log out</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </header>

            <main class="container mt-5">
            <div class="row">
                        <div class="col-lg-12 box-container">
                                <?php
                                $xml = simplexml_load_file('book_collection.xml');
                                $isbn = $_GET['isbn'];

                                foreach($xml->book as $book) {
                                $isbn_match = $book->attributes()->isbn;
                                $title = $book->basic_info->title;
                                $author = $book->basic_info->author;
                                $publisher = $book->basic_info->publisher;
                                $year = $book->basic_info->year_published;
                                $genre_1 = $book->basic_info->genres->genre_1;
                                $genre_2 = $book->basic_info->genres->genre_2;
                                $desc = $book->basic_info->description;
                                $cover = $book->basic_info->cover;
                                $price = $book->basic_info->price;
                                $pages = $book->additional_info->pages;
                                $edition = $book->additional_info->edition;
                                $language = $book->additional_info->language;
                                $avr = $book->additional_info->average_rating;

                                if(strcmp($isbn, $isbn_match) == 0) {

                                echo '
                                <div class="row">
                                <div class="col-lg-4">
                                    <img src="'. $cover .'" width="100%" />
                                </div>
                                <div class="col-lg-8">
                                    <h2>'. $title .'</h2>
                                    <p>Author: '. $author .'</p>
                                    <p>Genres: '. $genre_1 .', '. $genre_2 .'</p>
                                    <p><i>'. $desc .'</i></p>
                                    <p>Publisher: '. $publisher .' ('. $year .')</p>
                                    <p>Edition: '. $edition .'</p>
                                    <p>Language: '. $language .'</p>
                                    <p>No. of pages: '. $pages .'</p>
                                    <p>Average rating: '. $avr .'</p>
                                    <p>' .$price .' €</p>
                                    <span class="btn btn-secondary"><a class="link_reset" href="#">Add to cart</a></span>'; }
                                }
                                ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
            </main>
    </body>
</html>
