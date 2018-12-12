<div id="primary">

<?php
if (!isset($_SESSION['login'])) {
    ?>

<!--    ---------------------Login form----------------------->
    <div class="container, text-center">
    <h2>Please log in</h2><br>
    <form name="login" action="index.php" method="post">
        <label>AdminID</label>
        <input type="text" name="adminid" size="10">
        <br>
        <br>
        <label>Password</label>
        <input type="password" name="password" size="10">
        <br>
        <br>
        <input type="submit" value="Login">
        <input type="hidden" name="content" value="validate">
    </form>
    </div>

    <?php
} else {
    echo "<h3 align='center'>Admin panel</h3>\n";
}
?>

</div>
