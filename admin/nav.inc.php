<div id="secondary">

    <?php
    if (!isset($_SESSION['login']))
    echo "<td></td>\n";
    else {
        echo "<td><h3>Welcome, {$_SESSION['login']}</h3></td>\n";
        ?>

<!--        ---------------------NAV menu----------------------->
        <div class="list-group">
            <a href="index.php?content=logout">
            <a href="index.php" class="list-group-item list-group-item-action list-group-item-danger">Home</a>
            <a href="index.php?content=newbook" class="list-group-item list-group-item-action list-group-item-warning">Add Book</a>
            <a href="index.php?content=listbooks" class="list-group-item list-group-item-action list-group-item-warning">List books</a>
        </div>

        <?php
    }
    ?>

</div>