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

        // Get ratings
        $ratingModel = $this->model('Rating');
        $averageRating = $ratingModel->get_average_rating($movie_data['Title']);

        // Check if user has rated
        $userRating = null;
        if (isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $userRating = $ratingModel->get_user_rating($userId, $movie_data['Title']);
        }

        $_SESSION['controller'] = 'movie';
        $_SESSION['action'] = 'search';
        $_SESSION['movieTitle'] = $movie_data['Title'] ?? 'Not Found';
        $this->view('movie/search', ['movie' => $movie_data, 'averageRating' => $averageRating, 'userRating' => $userRating]);
    }
    
    public function rate($param1 = '') {
        if (isset($_SESSION['movieTitle']) && isset($_POST['rating'])) {
            $movieTitle = strtolower($_SESSION['movieTitle']);
            $rating = $_POST['rating'];

            if (isset($_SESSION['auth']) && isset($_SESSION['user_id'])) {
                $userId = $_SESSION['user_id'];
            } else {
                // Generate a unique numeric user ID
                if (!isset($_SESSION['user_id'])) {
                    $userId = mt_rand(10000000, 99999999);
                    $_SESSION['user_id'] = $userId;
                    // Check if the user exists in the Users table
                    $userModel = $this->model('User');
                    $userModel->user_lookup($userId);
                } else {
                    $userId = $_SESSION['user_id'];
                }
            }

            $ratingModel = $this->model('Rating');
            if (!$ratingModel->user_has_rated($userId, $movieTitle)) {
                $ratingModel->add_rating($userId, $movieTitle, $rating);
                $_SESSION['user_rating'] = $rating;
                $_SESSION['rated'] = 1;
            }
            header('Location: /movie/search/' . $movieTitle);
            return;
        }
    }

    public function review($param1 = '') {
        $movie_data = $_SESSION['movie_data'];
        $api = $this->model('Api');
        $review = $api->review_movie($movie_data);

        $_SESSION['controller'] = 'movie';
        $_SESSION['action'] = 'review';
        $_SESSION['movieTitle'] = $movie_data['Title'];
        $this->view('movie/review', ['review' => $review, 'movieTitle' => $movie_data['Title']]);
    }
}
?>