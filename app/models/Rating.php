<?php

class Rating {
    public function __construct() {
    }



    public function getAverageRating($movieTitle) {
        $db = db_connect();
        $statement = $db->prepare('SELECT AVG(rating) as averageRating FROM ratings WHERE movie_title = :movie_title');
        $statement->bindValue(':movie_title', $movieTitle);
        $statement->execute();
        $rows = $statement->fetch(PDO::FETCH_ASSOC);
        // return $row[''];
    }
}
?>
