<?php
//$con = mysqli_connect("localhost","phpmyadmin","12122");
//if (!$con)
//{
//die('Could not connect: '. mysqli_error());
//}
//mysqli_select_db($con, "bookCatalogue");
//?>

<?php
$servername = "localhost";
$username = "phpmyadmin";
$password = "12122";

// Create connection
$conn = mysqli_connect($servername, $username, $password);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully!!!";

//___________________________________________________________

$db=mysqli_select_db($conn, "bookCatalogue");
if (!$db) {
    die("Connection db failed: " . mysqli_connect_error());
}else{
    echo "Connected to db successfully!!!";
}

//include "book.php";

//$db=(new self)->connect();
        echo $db;
        $db = new mysqli("localhost", "phpmyadmin", "12122", "bookCatalogue");
$query = "SELECT books.bookid, books.title FROM books";
$result = $db->query($query);
var_dump($result);
foreach ($result as $item) {
    echo $item;

}
//if (mysqli_num_rows($result) > 0) {
//    $books = array();
//    while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
//        $book = new Book($row['bookid'], $row['title']);
//        echo $book;
//        array_push($books, $book);
//        unset($book);
//    }
//    var_dump($books);
//    $db->close();
//}


//$books = Book::getAllBooks();

//var_dump($books);

//foreach ($books as $book) {
//    echo $book;
//}

?>

