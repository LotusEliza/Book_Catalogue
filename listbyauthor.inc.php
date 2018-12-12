
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

    /**************************************************/

    if (!isset($_REQUEST['authorid']) OR (!is_numeric($_REQUEST['authorid'])))
    {
        echo "<h3 align='center'>You did not select a valid author to view.</h3>\n";

        echo "<div class=\"container, text-center\">";
        echo "<a href=\"index.php?content=listauthors\" class=\"btn btn-light\" role=\"button\" aria-pressed=\"true\">List authors</a>";
        echo "</div>";

    } else {
        $authorid = $_REQUEST['authorid'];



        echo "<h3 align=\"center\">Choose the book</h3>\n";

        echo "<div style=\"width:200px; margin-right:auto; margin-left:auto;\">";
        echo "<form name=\"books\" method=\"post\">\n";
        echo "<select ondblclick=\"listbox_dblclick()\" name=\"bookid\" size=\"17\">\n";

        $books = Book::getBooksByAuthor($authorid);
        foreach ($books as $book) {
            $bookid = $book->bookid;
            $description=$book->description;
            $price=$book->price;
            $title = $book->title;
            echo "<option value=\"$bookid\">$title</option>\n";
        }
        echo "</select><br><br>\n";


        echo "<input type=\"submit\" onClick=\"button_click(0)\" " .
            "name=\"showbook\" value=\"View Book\">\n";

        echo "<input type='hidden' name='authorid' value=\" $authorid\">";
        echo "</form>\n";
        echo "</div>";
    }
    ?>

</div>