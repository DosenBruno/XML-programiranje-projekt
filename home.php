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
                                <li class="nav-item active ml-2"><a class="nav-link" href="#">Home</a></li>
                                <li class="nav-item active ml-2"><a class="nav-link" href="index.php">Log out</a></li>
                            </ul>
                        </div>
                    </nav>
                </div>
            </header>

            <main class="row">
                <div class="col-lg-12 pt-5 mb-3">
                    <h3 class="h1 text-center text-white">Meet your new favourite book</h3>
                    <h4 class="h2 text-center quote">"A half-read book is like a half-finished love affair"</h4>
                </div>
                <section class="container-fluid mt-5">
                    <div class="row justify-content-around">

                                <?php

                                    $xml = simplexml_load_file('book_collection.xml');

                                    foreach($xml->book as $book) {
                                        $info = $book->basic_info;
                                        $title = $info->title;
                                        $author = $info->author;
                                        $genere_1 = $info->genres->genre_1;
                                        $genere_2 = $info->genres->genre_2;
                                        $cover = $info->cover;

                                        echo '
                                        <div class="col-lg-5 col-xl-5 col-md-5 col-sm-5 col-11 mb-5 box-container">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <img src='. $cover .' width="100%">
                                                </div>
                                                <div class="col-lg-8">
                                                    <h5>'. $title .'</h5>
                                                    <p>'. $author .'</p>
                                                    <p>Genres: '. $genere_1 .', '. $genere_2 .'</p>
                
                                                    <form method="GET" action="more.php" name="book">
                                                        <input type="hidden" name="isbn" id="isbn">
                                                        <input type="submit" name="submit" id="submit" value="Read more" class="btn btn-secondary">
                                                    </form>
                                                
                                                </div>
                                            </div>
                                        </div>';
                                    }

                                ?>
                    </div>

                    
                </section>
            </main>
        </div>
    </body>
</html>
