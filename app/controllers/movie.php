<?php
session_start();

class Movie extends Controller {
    public function index() {
        $this->view('movie/index');
    }

    public function search($param = '') {
        if (isset($_REQUEST['movie'])) {
            $movie_title = strtolower($_REQUEST['movie']);
            header('Location: /movie/search/'.$movie_title);
            exit;
        }

        $api = $this->model('Api');
        $movie_data = $api->find_movie($param);
        $_SESSION['movie_data'] = $movie_data;
        // echo '<pre>';
        // print_r($movie_data);
        // die;/////////////////////////////////
        // Get ratings
        $ratingModel = $this->model('Rating');
        // $movie_title = str_replace('%20', ' ', $param);
        $averageRating = $ratingModel->get_average_rating($movie_data['Title']);

        $_SESSION['controller'] = 'movie';
        $_SESSION['movieTitle'] = $movie_data['Title'] ?? 'Not Found';
        $this->view('movie/search', ['movie' => $movie_data, 'averageRating' => $averageRating]);
    }
    public function rate($param1 = '', $param2 = '') {
    if ($_REQUEST['movieTitle'] && $_REQUEST['rating']) {
            $movieTitle = strtolower($_POST['movieTitle']);
            $rating = $_POST['rating'];

            if (isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
            } else {
                // Generate a unique numeric user ID
                $userId = mt_rand(10000000, 99999999);
                $_SESSION['user_id'] = $userId;

                // Check if the user exists in the Users table
                $this->user_lookup($userId);
            }

            $ratingModel = $this->model('Rating');
            $ratingModel->add_rating($userId, $movieTitle, $rating);
            header('Location: /movie/search/' . $movieTitle);
            return;
        }
    }

    private function user_lookup($userId) {
        // Search for the user_id in the Users table
        $db = db_connect();
        $statement = $db->prepare('SELECT COUNT(*) FROM users WHERE id = :id');
        $statement->bindValue(':id', $userId);
        $statement->execute();

        if ($statement->fetchColumn() == 0) {
            // If user doesn't exist add the new user as a guest user
            $statement = $db->prepare('INSERT INTO users (id) VALUES (:id)');
            $statement->bindValue(':id', $userId);
            $statement->execute();
        }
    }


    public function review($param1 = '') {
        $movie_data = $_SESSION['movie_data'];
        $api = $this->model('Api');
        $review = $api->review_movie($movie_data);

        $_SESSION['movieTitle'] = $movie_data['Title'];
        $this->view('movie/review', ['review' => $review, 'movieTitle' => $movie_data['Title']]);
    }
}
?>
