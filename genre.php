<?php

class Genre{
    public $genreid;
    public $genre;

    function __construct($genreid, $genre)
    {
        $this->genreid=$genreid;
        $this->genre = $genre;
    }

    function __toString()
    {
        $output = "<h2>Genre ID: $this->genreid</h2>\n" .
                  "<h2>Genre : $this->genre</h2>\n";
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

    static function getGenres(){
        $db=(new self)->connect();
//        $db = new mysqli("localhost", "root", "12122elizza", "bookCatalogue");
        $query = "SELECT * FROM genres ORDER BY genre ASC ";
        $result = $db->query($query);
        if (mysqli_num_rows($result) > 0) {
            $genres = array();
            while ($row = $result->fetch_array(MYSQLI_ASSOC)) {
                $genre = new Genre($row['genreid'], $row['genre']);
                array_push($genres, $genre);
                unset($genre);
            }
            $db->close();
            return $genres;
        } else {
            $db->close();
            return NULL;
        }
    }

    function saveGenre(){
        $db=$this->connect();
//        $db = new mysqli("localhost", "root", "12122elizza", "bookCatalogue");
        $query = "INSERT INTO genres (genre) VALUES (?)";
        $stmt = $db->prepare($query);
        $stmt->bind_param("s",$this->genre);
        $result = $stmt->execute();

        if ($result === TRUE) {
            $last_id = $db->insert_id;
            echo "New genre created successfully. Last inserted ID is: " . $last_id."<br>";
        } else {
            echo "Error: " . $result . "<br>" . $db->error;
        }

        $db->close();
        return $last_id;
    }

    static function saveBooks_Genres($newbookid, $newgenreid){
        $db=(new self)->connect();
//        $db = new mysqli("localhost", "root", "12122elizza", "bookCatalogue");
        $query = "INSERT INTO books_genres (bookid,genreid) VALUES(?, ?);";
        $stmt = $db->prepare($query);
        $stmt->bind_param("ii",$newbookid,$newgenreid);
        $result = $stmt->execute();

        if ($result === TRUE) {
            $last_id = $db->insert_id;
            echo "New record to \"books_genres\" created successfully. Last inserted ID is: " . $last_id."<br>";
        } else {
            echo "Error: " . $result . "<br>" . $db->error;
        }

        $db->close();
    }

}