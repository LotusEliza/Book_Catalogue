<div id="primary">

<?php
if(isset($_POST['bookid'])) {
    $bookid = $_POST['bookid'];
    $book = Book::findBook($bookid);
    $authors = Author::getAuthorsByBook($book->bookid);

    $authornames = array_map(function ($x) {return $x->authorname;}, $authors);
    $authorids = array_map(function ($x) {return $x->authorid;}, $authors);

/******************************FORM UPDATE BOOK*******************************/
    if ($book) {
        echo "<h2 align=\"center\">Update Book $bookid</h2><br>\n";
        echo "<form name=\"book\" action=\"index.php\" method=\"post\">\n";
?>
        <div class="form-group">
            <label for="formGroupExampleInput">Title:</label>
            <input type="text" class="form-control" name="title" value='<?php echo $book->title?>'>
        </div>
        <div class="form-group">
            <label for="formGroupExampleInput">Author:</label>

<!--            --------------------Dynamic form fields-------------------------->
            <script language="javascript">
                $(document).ready(function(){
                    var max_fields = 4;
                    var add_input_button = $('.add_input_button');
                    var field_wrapper = $('.field_wrapper');
                    var new_field_html = '<div><input type="text" name="input_field[]" value=""/><a href="javascript:void(0);" class="remove_input_button" title="Remove field"><img src="FormFields/remove-icon.png"/></a></div>';
                    var input_count = 1;
                    // Add button dynamically
                    $(add_input_button).click(function(){
                        if(input_count < max_fields){
                            input_count++;
                            $(field_wrapper).append(new_field_html);
                        }
                    });
                    // Remove dynamically added button
                    $(field_wrapper).on('click', '.remove_input_button', function(e){
                        e.preventDefault();
                        $(this).parent('div').remove();
                        input_count--;
                    });
                });
            </script>

            <div class="container">
                <div class="field_wrapper">
                    <?php
                    $firstelement = current($authornames);
                    foreach ($authornames as $authorname) {
                        if ($authorname == $firstelement) {
                            ?>
                            <div>
                                <input type="text" name="input_field[]" value="<?php echo $firstelement ?>"/>
                                <a href="javascript:void(0);" class="add_input_button" title="Add field"><img
                                            src="FormFields/add-icon.png"/></a>
                            </div>

                            <?php
                        } else {
                            ?>
                            <div>
                                <input type="text" name="input_field[]" value="<?php echo $authorname ?>"/>
                                <a href="javascript:void(0);" class="remove_input_button" title="Remove field"><img
                                            src="FormFields/remove-icon.png"/></a>
                            </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label for="Description">Description:</label>
            <textarea class="form-control" name="description" id="Description" rows="3" style="height:100px;"><?php echo $book->description?></textarea>
        </div>
        <div class="form-group form-inline well">
            <label for="formGroupExampleInput">Price:</label>
            <input type="number" step="any" class="form-control" name="price" id="formGroupExampleInput" value="<?php echo $book->price?>">
        </div>

       <?php
        echo "<input type=\"submit\" name=\"answer\" value=\"Update Book\">\n";
        echo "<input type=\"submit\" name=\"answer\" value=\"Cancel\">\n";
        echo "<input type=\"hidden\" name=\"bookid\" value=\"$bookid\">\n";
        foreach($authornames as $value)
        {
            echo '<input type="hidden" name="authorsexist[]" value="'. $value. '">';
        }
        echo "<input type=\"hidden\" name=\"content\" value=\"changebook\">\n";
        echo "</form>\n";
    }else {
        echo "<h2>Sorry, book $bookid not found</h2>\n";
    }
}else{
    echo "<h2 align=\"center\">You didn't select a valid book to update. Please try again</h2>\n";
    echo "<div class=\"container, text-center\">";
    echo "<a href=\"index.php?content=listbooks\" class=\"btn btn-light\" role=\"button\" aria-pressed=\"true\">List books</a>";
    echo "</div>";
}
?>

</div>