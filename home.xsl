<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:template match="/">

<html>
    <head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" />
    <link rel="stylesheet" href="style.css?v=6" />
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
                        <xsl:for-each select="/books/book/basic_info">
                                        <div class="col-lg-5 col-xl-5 col-md-5 col-sm-5 col-11 mb-5 box-container">
                                            <div class="row">
                                                <div class="col-lg-4">
                                                    <img width="100%">
                                                        <xsl:attribute name="src">
                                                            <xsl:value-of select="cover" />
                                                        </xsl:attribute>
                                                    </img>
                                                </div>
                                                <div class="col-lg-8">
                                                    <h5><xsl:value-of select="title" /></h5>
                                                    <p><xsl:value-of select="author" /></p>
                                                    <p>Genres: <xsl:value-of select="genres/genre_1" />,&#160;
                                                    <xsl:value-of select="genres/genre_2" /></p>

                                                    <form name="book" action="more.php" method="GET">
                                                        <input type="hidden" name="isbn" id="isbn" value="{parent::book/@isbn}" />
                                                        <input type="submit" class="btn btn-secondary" name="submit" value="Read more" />
                                                    </form>                                                    
                                                
                                                </div>
                                            </div>
                                        </div>
                            </xsl:for-each>
                    </div>

                    
                </section>
            </main>
        </div>
    </body>
</html>

</xsl:template>
</xsl:stylesheet>
