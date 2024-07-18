<?php

class Rating {
    public function __construct() {
    }

    public function addRating($userId, $movieTitle, $rating) {
        $db = db_connect();
        $statement = $db->prepare('INSERT INTO ratings (user_id, movie_title, rating) VALUES (:user_id, :movie_title, :rating)');
        $statement->bindValue(':user_id', $userId);
        $statement->bindValue(':movie_title', strtolower($movieTitle));
        $statement->bindValue(':rating', (int)$rating);
        $statement->execute();
    }

    public function getAverageRating($movieTitle) {
        $db = db_connect();
        $statement = $db->prepare('SELECT AVG(rating) as averageRating FROM ratings WHERE movie_title = :movie_title');
        $statement->bindValue(':movie_title', strtolower($movieTitle));
        $statement->execute();
        $rows = $statement->fetch(PDO::FETCH_ASSOC);
        echo $rows['averageRating'];
        return $rows['averageRating'];
    }
}
?>
