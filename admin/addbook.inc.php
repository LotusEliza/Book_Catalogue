<div id="primary">

<?php

if (isset($_SESSION['login'])) {

    $title = $_POST['title'];
    $authosids = $_POST['authorid'];
    $newauthorsnames = $_POST['newauthorname'];
    $genresids = $_POST['genreid'];
    $newgenres = $_POST['newgenre'];
    $description = $_POST['description'];
    $price = $_POST['price'];

    //---------------Save Book--------------

    $book = new Book(" ", $title, $description, $price);
    $newbookid = $book->saveBook();

    //---------------Save AUTHORS(enter data to "BOOKS_AUTHORS" table)--------------

    if(!empty($authosids) && empty($newauthorsnames)) {
        foreach ($authosids as $authorid) {
            Author::saveBooks_Authors($newbookid, $authorid);
        }
    }
    else if(empty($authosids) && !empty($newauthorsnames)) {
        $newauthorsnames = explode(",", $newauthorsnames);
        foreach ($newauthorsnames as $newauthorname) {
            $newauthorname = new Author("", $newauthorname);
            $newauthorid = $newauthorname->saveAuthor();
            Author::saveBooks_Authors($newbookid, $newauthorid);
        }
    }
    else if(!empty($authosids) && !empty($newauthorsnames)) {
        $newauthorsnames = explode(",", $newauthorsnames);
        foreach ($newauthorsnames as $newauthorname) {
            $newauthorname = new Author("", $newauthorname);
            $newauthorid = $newauthorname->saveAuthor();
            Author::saveBooks_Authors($newbookid, $newauthorid);
        }
        foreach ($authosids as $authorid) {
            Author::saveBooks_Authors($newbookid, $authorid);
        }
    }

    //---------------Save GENRES(enter data to "BOOKS_GENRES" table)--------------

    if(!empty($genresids) && empty($newgenres)) {
        foreach ($genresids as $genreid) {
            Genre::saveBooks_Genres($newbookid, $genreid);
        }
    }
    else if(empty($genresids) && !empty($newgenres)) {
        $newgenres = explode(",", $newgenres);
        foreach ($newgenres as $newgenre) {
            $newgenre = new Genre("", $newgenre);
            $newgenreid = $newgenre->saveGenre();
            Genre::saveBooks_Genres($newbookid, $newgenreid);
        }
    }
    else if(!empty($genresids) && !empty($newgenres)) {
        $newgenres = explode(",", $newgenres);
        foreach ($newgenres as $newgenre) {
            $newgenre = new Genre("", $newgenre);
            $newgenreid = $newgenre->saveGenre();
            Genre::saveBooks_Genres($newbookid, $newgenreid);
        }

        foreach ($genresids as $genreid) {
            Genre::saveBooks_Genres($newbookid, $genreid);
        }
    }
}
else {
    header("Location: index.php");
}
?>

</div>