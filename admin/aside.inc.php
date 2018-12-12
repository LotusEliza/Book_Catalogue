<div id="tertiary">

    <?php
    //----------------------Logout----------------------------
    if (!isset($_SESSION['login']))
        echo "<td></td>\n";
    else {
        echo "<div class=\"container, text-center\">";
        echo "<a href=\"index.php?content=logout\" class=\"btn btn-light\" role=\"button\" aria-pressed=\"true\">Logout</a>";
        echo "</div>";
    }
    ?>

</div>