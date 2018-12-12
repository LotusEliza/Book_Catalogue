<?php
$adminid = $_POST['adminid'];
$password = $_POST['password'];

$query ="SELECT name FROM admins WHERE adminid = ? AND password = SHA2(?,256)";
$db = new mysqli("localhost", "phpmyadmin", "12122", "bookCatalogue");
$stmt = $db->prepare($query);
$stmt->bind_param("ss", $adminid, $password);
$stmt->execute();
$stmt->bind_result($name);
$stmt->fetch();

if (isset($name)) {
    $_SESSION['login'] = $name;
    header("Location: index.php");
} else {
    echo "<div id=\"primary\">";
    echo "<h3 align='center'>Sorry, login incorrect</h3>\n";
    echo "<div class=\"container, text-center\">";
    echo "<a href=\"index.php\" class=\"btn btn-light\" role=\"button\" aria-pressed=\"true\">Try again</a>";
    echo "</div>";
    echo "</div>";
}
