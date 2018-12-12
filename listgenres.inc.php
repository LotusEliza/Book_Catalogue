
<div id="primary">

    <?php
    echo "<script language=\"javascript\">\n";
    echo "function listbox_dblclick() {\n";
    echo "document.genres.listbygenre.click() }\n";
    echo "</script>\n";

    echo "<script language=\"javascript\">\n";
    echo "function button_click(target) {\n";
    echo "if(target==0) genres.action=\"index.php?content=listbygenre\"\n";
    echo "}\n";
    echo "</script>\n";

    //***************************************************************//

    echo "<h3 align=\"center\">Choose Genre</h3>\n";

    echo "<div style=\"width:200px; margin-right:auto; margin-left:auto;\">";
    echo "<form name=\"genres\" method=\"post\">\n";
    echo "<select ondblclick=\"listbox_dblclick()\" name=\"genreid\" size=\"17\">\n";


    $genres = Genre::getGenres();
    foreach($genres as $genre) {
        $genreid = $genre->genreid;
        $genre = $genre->genre;
        $genre =  $genre."<br>";
        echo "<option value=\"$genreid\">$genre</option>\n";
    }
    echo "</select><br><br>\n";

    echo "<input type=\"submit\" onClick=\"button_click(0)\" " .
        "name=\"listbygenre\" value=\"List Books\">\n";
    echo "</form>\n";
    echo "</div>";
    ?>

</div>