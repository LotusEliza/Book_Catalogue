<div id="primary">

<?php
if (isset($_SESSION['login'])) {
    $bookid = $_POST['bookid'];
    $answer = $_POST['answer'];
    $authorsnew=$_REQUEST['input_field'];
    $authorsexist=$_POST['authorsexist'];

    if ($answer == "Update Book") {
        $book = Book::findBook($bookid);
        $book->title = $_POST['title'];
        $book->bookid=$bookid;
        $book->description = $_POST['description'];
        $book->price = $_POST['price'];

        //-------------------UPDATE BOOK INF------------------------

        $result = $book->updateBook();
        if ($result) {
            echo "<h2 align=\"center\">Book $bookid updated</h2>\n";
        } else {
            echo "<h2 align=\"center\">Problem updating book $bookid</h2>\n";
        }

        //-------------------UPDATE AUTHORS INF------------------------

        $new=array_diff($authorsnew,$authorsexist);//-add authors
        $remove=array_diff($authorsexist,$authorsnew);//-remove authors

        if(empty($new)&&empty($remove)) {
            //---both empty---

        } else {
            if(empty($remove)) {
                //---Only $REMOVE empty---
                foreach ($new as $newauthor) {
                    $newauthor = new Author("", $newauthor);
                    $newauthorid = $newauthor->saveAuthor();
                    Author::saveBooks_Authors($bookid, $newauthorid);
                }
            } else {

                if(empty($new)) {
                    //---Only $NEW empty---
                    foreach ($remove as $authorname) {
                        $author = Author::findAuthorByName($authorname);
//                        var_dump($author);
//                        echo "<br>";
//                        echo "$author->authorid";
                        $author->removeAuthor($bookid);
                    }
                }else{
                    //---BOTH not empty---
                    foreach ($new as $newauthor) {
                        $newauthor = new Author("", $newauthor);
                        $newauthorid = $newauthor->saveAuthor();
                        Author::saveBooks_Authors($bookid, $newauthorid);
                    }
                    foreach ($remove as $authorname) {
                        $author = Author::findAuthorByName($authorname);
//                        var_dump($author);
//                        echo "<br>";
//                        echo "$author->authorid";
                        $author->removeAuthor($bookid);
                    }
                }

            }
        }
    }else{
        header("Location: index.php");
    }
} else {
    echo "<h2 align=\"center\">Please login first</h2>\n";
}
?>

</div>