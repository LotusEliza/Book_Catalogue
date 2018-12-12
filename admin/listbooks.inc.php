<div id="primary">

<?php

if (isset($_SESSION['login'])) {

//    ---------------------Confirm deleting the book---------------------
    echo "<script language=\"javascript\">\n";
    echo "function myFunction() {\n";
    echo "if(document.getElementById('selectid').value) {";
    echo "confirm(\"Delete this book?\")\n";
    echo "}";
    echo "}";
    echo "</script>";

//    -----------------Changes dynamically the action attribute-----------
    echo "<script language=\"javascript\">\n";
    echo "function button_click(target) {\n";
    echo "if(target==1) books.action=\"index.php?content=removebook\"\n";
    echo "if(target==2) books.action=\"index.php?content=updatebook\"\n";
    echo "}\n";
    echo "</script>\n";

//    ---------------------List books Form---------------------
    echo "<h2 align=\"center\">Select Book</h2>\n";
    echo "<div style=\"width:300px; margin-right:auto; margin-left:auto;\">";
    echo "<form name=\"books\" method=\"post\">\n";
    echo "<select id='selectid' ondblclick=\"listbox_dblclick()\" name=\"bookid\" size=\"10\">\n";
    $books = Book::getAllBooks();
    foreach ($books as $book) {
        $bookid = $book->bookid;
        $title = $bookid . " - " . $book->title;
        echo "<option value=\"$bookid\">$title</option>\n";
    }
    echo "</select><br>\n";


    echo "<input type=\"submit\" onClick=\"myFunction(); button_click(1)\" " .
        "name=\"deletebook\" value=\"Delete Book\">\n";
    echo "<input type=\"submit\" onClick=\"button_click(2)\" " .
        "name=\"updatebook\" value=\"Update Book\">\n";
    echo "</form>\n";
    echo "</div>";
}else{
    header("Location: index.php");
}
?>

</div>
