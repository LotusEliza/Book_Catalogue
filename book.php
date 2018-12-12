<?php

//$configs=include ('config.php');

//$host=$configs['db']['host'];
//echo $host;

class Book
{
    public $bookid;
    public $title;
    public $description;
    public $price;

    function __construct($bookid, $title, $description, $price)
    {
        $this->bookid = $bookid;
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
    }

    function __toString()
    {
        $output = "<h2>Book id: $this->bookid</h2>\n" .
            "<h2>Book title: $this->title</h2>\n" .
            "<h2>Description: $this->description</h2>\n" .
            "<h2>Price: $this->price</h2>\n";
        return $output;
    }


    function connect()
    {
        $configs=include ('config.php');
        $host=$configs['db']['host'];
        $username=$configs['db']['username'];
        $passwd=$configs['db']['passwd'];
        $name=$configs['db']['dbname'];

        $db = new mysqli("$host", "$username", "$passwd", "$name");
        return $db;
    }



    function saveBook()
    {
        $db=$this->connect();
//        $db = new mysqli("localhost", "root", "12122elizza", "bookCatalogue");
        $query = "INSERT INTO books (title, description, price) VALUES (?, ?, ?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param("ssd", $this->title,$this->description, $this->price);
        $result = $stmt->execute();

        if ($result === TRUE) {
            $newbookid = $db->insert_id;
            echo "New book created successfully. Last inserted ID is: " . $newbookid."<br>";
        } else {
            echo "Error: " . $result . "<br>" . $db->error;
        }

        $db->close();
        return $newbookid;
    }

    function updateBook()
    {
        $db=$this->connect();
//        $db = new mysqli("localhost", "root", "12122elizza", "bookCatalogue");
        $query = "UPDATE books SET title = ?, description = ?, price = ? WHERE bookid= $this->bookid";
        $stmt = $db->prepare($query);
        $stmt->bind_param("ssd", $this->title, $this->description, $this->price);
        $result = $stmt->execute();
        $db->close();
        return $result;
    }

    function removeBook()
    {
        $db=$this->connect();
//        $db = new mysqli("localhost", "$username", "12122elizza", "bookCatalogue");
        $query = "DELETE FROM books WHERE bookid = $this->bookid";
        $result = $db->query($query);
        $db->close();
        return $result;
    }


    static function getBooksByAuthor($authorid)
    {
        $db=(new self)->connect();
//        $db=$this->connect();
//        $db = new mysqli("localhost", "root", "12122elizza", "bookCatalogue");
            $query = "SELECT b.* FROM books b INNER JOIN books_authors ba ON b.bookid=ba.bookid WHERE ba.authorid = $authorid";
        $result = $db->query($query);
        if (mysqli_num_rows($result) > 0) {
            $books = array();
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $book = new Book($row['bookid'], $row['title'],
                    $row['author'], $row['description'], $row['price']);
                array_push($books, $book);
                unset($book);
            }
            $db->close();
            return $books;
        } else {
            $db->close();
            return NULL;
        }
    }


    static function getBooksByGenre($genreid)
    {
        $db=(new self)->connect();
//        $db = new mysqli("localhost", "root", "12122elizza", "bookCatalogue");
        $query = "SELECT b.* FROM books b INNER JOIN books_genres bg ON b.bookid=bg.bookid WHERE bg.genreid = $genreid";
        $result = $db->query($query);
        if (mysqli_num_rows($result) > 0) {
            $books = array();
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $book = new Book($row['bookid'], $row['title'], $row['genre'], $row['description'], $row['price']);
                array_push($books, $book);
                unset($book);
            }
            $db->close();
            return $books;
        } else {
            $db->close();
            return NULL;
        }
    }

    static function getBook($bookid){
        $db=(new self)->connect();
//        $db = new mysqli("localhost", "root", "12122elizza", "bookCatalogue");
        $query = "SELECT * FROM books WHERE bookid = $bookid";
        $result = $db->query($query);
        $row = $result->fetch_array(MYSQLI_ASSOC);
            if ($row) {
                $book1 = new Book($row['bookid'], $row['title'], $row['description'], $row['price']);
                $db->close();
                return $book1;
            } else {
                $db->close();
                return NULL;
            }
    }

    static function getAllBooks(){
        $db=(new self)->connect();
//        echo $db;
//        $db = new mysqli("localhost", "root", "12122elizza", "bookCatalogue");
        $query = "SELECT books.bookid, books.title FROM books";
        $result = $db->query($query);
        if (mysqli_num_rows($result) > 0) {
            $books = array();
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $book = new Book($row['bookid'], $row['title']);
                array_push($books, $book);
                unset($book);
            }
//            var_dump($books);
//            var_dump($db);
            $db->close();
            return $books;

        } else {
            $db->close();
            return NULL;
        }
    }

    static function findBook($bookid)
    {
        $db=(new self)->connect();
//        $db = new mysqli("localhost", "root", "12122elizza", "bookCatalogue");
        $query = "SELECT * FROM books WHERE bookid = $bookid";
        $result = $db->query($query);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($row) {
            $book= new Book($row['bookid'], $row['title'],
                $row['description'], $row['price']);
            $db->close();
            return $book;
        } else {
            $db->close();
            return NULL;
        }
    }
}


