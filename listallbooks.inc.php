
<div id="primary">
    <?php


    echo "<script language=\"javascript\">\n";
    echo "function listbox_dblclick() {\n";
    echo "document.listallbooks.showbook.click() }\n";
    echo "</script>\n";

    echo "<script language=\"javascript\">\n";
    echo "function button_click(target) {\n";
    echo "if(target==0) listallbooks.action=\"index.php?content=showbook\"\n";
    echo "}\n";
    echo "</script>\n";

    /**********************FORM list all books****************************/

        echo "<h3 align=\"center\">Choose the book</h3>\n";
        echo "<h3 align=\"center\">Choose the book</h3>\n";
        echo "<div style=\"width:300px; margin-right:auto; margin-left:auto;\">";
            echo "<form name=\"listallbooks\" method=\"post\">\n";
            echo "<select ondblclick=\"listbox_dblclick()\" name=\"bookid\" size=\"17\">\n";
            $books = Book::getAllBooks();

            foreach ($books as $book) {
                $bookid = $book->bookid;
                $description=$book->description;
                $price=$book->price;
                $title = $book->title;
                echo "<option value=\"$bookid\">$title</option>\n";
            }
            echo "</select><br><br>\n";
            echo "<input type=\"submit\" onClick=\"button_click(0)\" "."name=\"showbook\" value=\"View Book\">\n";
            echo "</form>\n";
    if($books){
        echo "yes";
    }else{
        echo "no";
    }

        echo "</div>";
    ?>
</div>