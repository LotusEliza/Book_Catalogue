<?php

class Author{
    public $authorid;
    public $authorname;

    function __construct($authorid, $authorname)
    {
        $this->authorid=$authorid;
        $this->authorname = $authorname;
    }

    function __toString()
    {
        $output = "<h2>Author ID: $this->authorid</h2>\n" .
                  "<h2>Author Name $this->authorname</h2>\n";
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

    static function getAuthors(){
        $db=(new self)->connect();
        $query = "SELECT * FROM authors ORDER BY authorname ASC ";
        $result = $db->query($query);
        if (mysqli_num_rows($result) > 0) {
            $authors = array();
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $author = new Author($row['authorid'], $row['authorname']);
                array_push($authors, $author);
                unset($author);
            }
            $db->close();
            return $authors;
        } else {
            $db->close();
            return NULL;
        }
    }



    function saveAuthor(){
        $db=$this->connect();
        $query = "INSERT INTO authors (authorname) VALUES (?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param("s",$this->authorname);
        $result = $stmt->execute();

        if ($result === TRUE) {
            $last_id = $db->insert_id;
            echo "New author created successfully. Last inserted ID is: " . $last_id."<br>";
        } else {
            echo "Error: " . $result . "<br>" . $db->error;
        }

        $db->close();
        return $last_id;
    }

    static function saveBooks_Authors($newbookid, $newauthorid){
        $db=(new self)->connect();
        $query = "INSERT INTO books_authors (bookid,authorid) VALUES(?, ?);";
        $stmt = $db->prepare($query);
        $stmt->bind_param("ii",$newbookid,$newauthorid);
        $result = $stmt->execute();

        if ($result === TRUE) {
            $last_id = $db->insert_id;
            echo "New record to \"books_authors\" created successfully. Last inserted ID is: " . $last_id."<br>";
        } else {
            echo "Error: " . $result . "<br>" . $db->error;
        }

        $db->close();
    }

    static function getAuthorsByBook($bookid)
    {
        $db=(new self)->connect();
        $query = "SELECT a.* FROM authors a INNER JOIN books_authors ba ON a.authorid=ba.authorid WHERE ba.bookid = $bookid";
        $result = $db->query($query);
        if (mysqli_num_rows($result) > 0) {
            $authors = array();
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $author = new Author($row['authorid'], $row['authorname']);
                array_push($authors, $author);
                unset($author);
            }
            $db->close();
            return $authors;
        } else {
            $db->close();
            return NULL;
        }
    }


    function removeAuthor($bookid)
    {
        $db=$this->connect();
        $query = " DELETE a FROM books_authors a
                   INNER JOIN books b ON a.bookid=b.bookid
                   WHERE a.bookid = $bookid AND a.authorid=$this->authorid";
        $result = $db->query($query);

        if ($result===TRUE){
            echo "Author $this->authorid removed\n";
        } else{
            echo "<h2>Sorry, problem removing author</h2>\n";
        }

        $db->close();
    }

    static function findAuthorByName($authorname)
    {
        $db=(new self)->connect();
        $query = "SELECT * FROM authors WHERE authorname = '$authorname'";
        $result = $db->query($query);
        $row = $result->fetch_array(MYSQLI_ASSOC);
        if ($row) {
            $author= new Author($row['authorid'], $row['authorname']);
            $db->close();
            return $author;
        } else {
            $db->close();
            return NULL;
        }
    }

}