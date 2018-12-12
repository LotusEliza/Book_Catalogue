<div id="primary">

<?php
if (isset($_SESSION['login'])) {
    if (isset($_POST['bookid'])) {
        $answer = $_POST['answer'];
        $bookid = $_POST['bookid'];

            $book = Book::findBook($bookid);
            $result = $book->removeBook();
            if ($result){
                echo "<h2 align=\"center\">Book $bookid removed</h2>\n";
                header('Refresh: 3; url=index.php');
            }
            else
                echo "<h2 align=\"center\">Sorry, problem removing book $bookid</h2>\n";
        } else {
            echo "<h2 align=\"center\">You didn't select a valid book to remove. Please try again</h2>\n";
            echo "<div class=\"container, text-center\">";
            echo "<a href=\"index.php?content=listbooks\" class=\"btn btn-light\" role=\"button\" aria-pressed=\"true\">List books</a>";
            echo "</div>";
        }
}else {
    echo "<h2 align=\"center\">Please login first</h2>\n";
}
?>

</div>

