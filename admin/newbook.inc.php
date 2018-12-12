<div id="primary">

    <?php if (isset($_SESSION['login'])) { ?>
        <?php
        //________________________Sends action to "addbook.inc.php"_________________________
        echo "<script language=\"javascript\">\n";
        echo "function button_click(target) {\n";
        echo "if(target==0) newbook.action=\"index.php?content=addbook\"\n";
        echo "}\n";
        echo "</script>\n";
        ?>

        <?php
        //_____________________Checks if authors input fields are both empty___________________
        echo "<script language=\"javascript\">\n";
        echo "function validateForm(){\n";
        echo "var empt1 = document.forms[\"newbook\"][\"newauthorname\"].value;\n";
        echo "var empt2 = $('#authors').val();\n";
        echo "if (!empt1 && !empt2){\n";
        echo "alert(\"Please input an Author\");\n";
        echo "return false;}}\n";
        echo "</script>\n";
        ?>

        <!--    _______________________________FORM "NEW BOOK"_________________________________-->

        <h2 align="center">Enter new book information</h2>
        <form name="newbook" action="index.php" onsubmit="return validateForm()" method="post">
            <div class="form-group">
                <label for="formGroupExampleInput">Title:</label>
                <input type="text" class="form-control" name="title" placeholder="enter the title" required>
            </div>
            <div class="form-group form-inline well">
                <label for="exampleSelect2">Select author:</label>

                <?php
                //????????????????????????????????????????????????????????????????????????????/FUNCTION

                echo "<select multiple class=\"form-control\" id=\"authors\" name=\"authorid[]\">\n";
                $authors = Author::getAuthors();
                foreach ($authors as $author) {
                    $authorid = $author->authorid;
                    $authorname = $author->authorname;
                    echo "<option value=\"$authorid\" id=\"authors\">$authorname</option>\n";
                }
                echo "</select><br><br>\n";
                ?>

                <label class="control-label">Add author:</label>
                <input id="memory" type="text" class="form-control" name="newauthorname"
                       placeholder="author1, author2, ...">
            </div>
            <div class="form-group form-inline well">
                <label for="exampleSelect2">Select genre:</label>

                <?php
                echo "<select multiple class=\"form-control\" id=\"exampleSelect2\" name=\"genreid[]\">\n";
                $genres = Genre::getGenres();
                foreach ($genres as $genre) {
                    $genreid = $genre->genreid;
                    $genre = $genre->genre;
                    echo "<option value=\"$genreid\">$genre</option>\n";
                }
                echo "</select><br><br>\n";
                ?>

                <label class="control-label">Add genre:</label>
                <input id="memory" type="text" class="form-control" name="newgenre" placeholder="classic, action, ...">
            </div>
            <div class="form-group">
                <label for="Description">Description:</label>
                <textarea class="form-control" name="description" id="Description" rows="3" required></textarea>
            </div>
            <div class="form-group form-inline well">
                <label for="formGroupExampleInput">Price:</label>
                <input type="number" step="any" class="form-control" name="price" id="formGroupExampleInput"
                       placeholder="enter the price" required>
            </div>
            <input type="hidden" name="content" value="addbook">
            <?php
            echo "<input type=\"submit\" onClick=\"button_click(0)\" " . "name=\"addbook\" value=\"Add Book\">\n";
            ?>

        </form>
        <?php
    }else{
        header("Location: index.php");
    }
    ?>
</div>