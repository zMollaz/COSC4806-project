<?php
class Movie extends Controller {
    public function index() {
        $this->view('movie/index');
    }

    public function search($param = '') {
        if ($_REQUEST['movie']) {
            $movie = strtolower($_REQUEST['movie']);
            header('Location: /movie/search/'.$movie);
        }

        $api = $this->model('Api');
        $movie = $api->find_movie($param);

        // Get ratings
        $ratingModel = $this->model('Rating');
        $movie_title = str_replace('%20', ' ', $param);
        $averageRating = $ratingModel->getAverageRating($movie_title);

        $_SESSION['controller'] = 'movie';
        $_SESSION['movieTitle'] = strtolower($movie['Title']) ?? 'Not Found';
        $this->view('movie/search', ['movie' => $movie, 'averageRating' => $averageRating]);
    }

    public function rate($param1 = '', $param2 = '') {
    if ($_REQUEST['movieTitle'] && $_REQUEST['rating']) {
        $movieTitle = strtolower($_POST['movieTitle']);
        $rating = $_POST['rating'];

        $userId = $_SESSION['user_id'] ?? session_id();
        $ratingModel = $this->model('Rating');
        $ratingModel->addRating($userId, $movieTitle, $rating);
        header('Location: /movie/search/'. $movieTitle);
    }
    }
}
?>
