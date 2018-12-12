
<div id="primary">
    <?php
    if (!isset($_REQUEST['bookid']) OR (!is_numeric($_REQUEST['bookid']))){
        echo "<h3 align=\"center\">You did not select a valid book to view.</h3>\n";

        echo "<script language=\"javascript\">\n";
        echo "function button_click(target) {\n";
        echo "if(target==0) author.action=\"index.php?content=listbyauthor\"\n";
        echo "if(target==1) genre.action=\"index.php?content=listbygenre\"\n";
        echo "}\n";
        echo "</script>\n";

       if(isset($_POST['authorid'])) {
           $authorid = $_POST['authorid'];

           echo "<div style=\"width:100px; margin-right:auto; margin-left:auto;\">";
           echo "<form name=\"author\" method=\"post\">\n";
           echo "<input type=\"submit\" onClick=\"button_click(0)\" " . "name=\"listbyauthor\" value=\"List Books by Author\">\n";
           echo "<input type='hidden' name='authorid' value=\" $authorid\">";
           echo "</form>\n";
           echo "</div>";
       }else if(isset($_POST['genreid'])){
           $genreid=$_POST['genreid'];

           echo "<div style=\"width:100px; margin-right:auto; margin-left:auto;\">";
           echo "<form name=\"genre\" method=\"post\">\n";
           echo "<input type=\"submit\" onClick=\"button_click(1)\" " . "name=\"listbygenre\" value=\"List Books by Genre\">\n";
           echo "<input type='hidden' name='genreid' value=\" $genreid\">";
           echo "</form>\n";
           echo "</div>";

       }else{
           echo "<div class=\"container, text-center\">";
           echo "<a href=\"index.php?content=listallbooks\" class=\"btn btn-light\" role=\"button\" aria-pressed=\"true\">List All books</a>";
           echo "</div>";
       }

    } else {
        $bookid = $_REQUEST['bookid'];
        $book = Book::getBook($bookid);

        if ($book) {
            $bookname = $book->title;
            $bookid=$book->bookid;

            echo $book->title."<br><br>";
            echo $book->description."<br><br>";
            echo "Price: ".$book->price."<br><br>";
            echo "<br><br>\n";


            echo "<script language=\"javascript\">\n";
            echo "function button_click(target) {\n";
            echo "if(target==0) orderform.action=\"index.php?content=send_form_email\"\n";
            echo "}\n";
            echo "</script>\n";

            ?>

            <form name="orderform" method="post">
    <table width="450px">
        <tr>
            <td valign="top">
                <label for="first_name">First Name *</label>
            </td>
            <td valign="top">
                <input  type="text" name="first_name" maxlength="50" size="30">
            </td>
        </tr>
        <tr>
            <td valign="top">
                <label for="address">Address *</label>
            </td>
            <td valign="top">
                <input  type="text" name="address" maxlength="80" size="30">
            </td>
        </tr>
        <tr>
            <td valign="top">
                <label for="email">Email Address *</label>
            </td>
            <td valign="top">
                <input  type="text" name="email" maxlength="80" size="30">
            </td>
        </tr>
        <tr>
            <td valign="top">
                <label for="quantity">Quantity *</label>
            </td>
            <td valign="top">
                <input type="number" name="quantity" min="1" max="100" maxlength="80" size="30">
            </td>
        </tr>
        <tr>
            <td colspan="2" style="text-align:center">
                <?php
                echo "<input type=\"submit\" onClick=\"button_click(0)\" " . "name=\"order\" value=\"Order\">\n";
        } ?>
            </td>
        </tr>
    </table>
        <input type='hidden' name='bookname' value='<?php echo "$bookname";?>'/>
        <input type='hidden' name='bookid' value='<?php echo "$bookid";?>'/>
</form>
    <?php
    }
    ?>

</div>