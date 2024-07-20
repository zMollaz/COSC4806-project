<?php
session_start();

class Rating {
    public function __construct() {
    }

    public function add_rating($userId, $movieTitle, $rating) {
        if (!is_numeric($rating) || $rating < 1 || $rating > 5 || intval($rating) != $rating) {
            throw new Exception("Invalid rating. Rating must be a whole number between 1 and 5.");
        }

        $db = db_connect();
        $statement = $db->prepare('INSERT INTO ratings (user_id, movie_title, rating) VALUES (:user_id, :movie_title, :rating)');
        $statement->bindValue(':user_id', $userId);
        $statement->bindValue(':movie_title', strtolower($movieTitle));
        $statement->bindValue(':rating', (int)$rating);
        $statement->execute();
    }

    public function get_average_rating($movieTitle) {
        $db = db_connect();
        $statement = $db->prepare('SELECT AVG(rating) as averageRating FROM ratings WHERE movie_title = :movie_title');
        $statement->bindValue(':movie_title', strtolower($movieTitle));
        $statement->execute();
        $rows = $statement->fetch(PDO::FETCH_ASSOC);
        return $rows['averageRating'];
    }
}
?>
