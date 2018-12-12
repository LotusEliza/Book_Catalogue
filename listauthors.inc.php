
<div id="primary">

    <?php
    echo "<script language=\"javascript\">\n";
    echo "function listbox_dblclick() {\n";
    echo "document.authors.listbyauthor.click() }\n";
    echo "</script>\n";

    echo "<script language=\"javascript\">\n";
    echo "function button_click(target) {\n";
    echo "if(target==0) authors.action=\"index.php?content=listbyauthor\"\n";
    echo "}\n";
    echo "</script>\n";

    //***********************************************************//

    echo "<h3 align=\"center\">Choose Author</h3>\n";

    echo "<div style=\"width:150px; margin-right:auto; margin-left:auto;\">";
    echo "<form name=\"authors\" method=\"post\">\n";
    echo "<select ondblclick=\"listbox_dblclick()\" name=\"authorid\" size=\"17\">\n";

    $authors = Author::getAuthors();
    foreach($authors as $author) {
        $authorid = $author->authorid;
        $authorname = $author->authorname;
        $name =  $authorname."<br>";
        echo "<option value=\"$authorid\">$name</option>\n";
    }
    echo "</select><br><br>\n";


    echo "<input type=\"submit\" onClick=\"button_click(0)\" " .
        "name=\"listbyauthor\" value=\"List Books\">\n";
    echo "</form>\n";
    echo "</div>";
    ?>

</div>
