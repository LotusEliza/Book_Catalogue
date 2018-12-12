
<div id="primary">

    <?php
    echo "<script language=\"javascript\">\n";
    echo "function listbox_dblclick() {\n";
    echo "document.books.showbook.click() }\n";
    echo "</script>\n";

    echo "<script language=\"javascript\">\n";
    echo "function button_click(target) {\n";
    echo "if(target==0) books.action=\"index.php?content=showbook\"\n";
    echo "}\n";
    echo "</script>\n";

    /*******************************************************/

    if (!isset($_REQUEST['genreid']) OR (!is_numeric($_REQUEST['genreid'])))
    {
        echo "<h3 align=\"center\">You did not select a valid genre to view.</h3>\n";
        echo "<div class=\"container, text-center\">";
        echo "<a href=\"index.php?content=listgenres\" class=\"btn btn-light\" role=\"button\" aria-pressed=\"true\">List genres</a>";
        echo "</div>";

    } else{
        $genreid = $_REQUEST['genreid'];

        echo "<h3 align=\"center\">Choose the book</h3>\n";
        echo "<div style=\"width:150px; margin-right:auto; margin-left:auto;\">";
        echo "<form name=\"books\" method=\"post\">\n";
        echo "<select ondblclick=\"listbox_dblclick()\" name=\"bookid\" size=\"17\">\n";
        $books = Book::getBooksByGenre($genreid);
        foreach ($books as $book) {
            $bookid = $book->bookid;
            $title = $book->title;
            echo "<option value=\"$bookid\">$title</option>\n";
        }
        echo "</select><br><br>\n";

        echo "<input type=\"submit\" onClick=\"button_click(0)\" "."name=\"showbook\" value=\"View Book\">\n";
        echo "<input type='hidden' name='genreid' value=\" $genreid\">";
        echo "</form>\n";
        echo "</div>";
    }
    ?>

</div>