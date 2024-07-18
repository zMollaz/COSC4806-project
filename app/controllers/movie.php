<?php
class Movie extends Controller {
    public function index() {
        $this->view('movie/index');
    }

    public function search($param = '') {
        if ($_REQUEST['movie']) {
            $movie = $_REQUEST['movie'];
            header('Location: /movie/search/'.$movie);
        }

        $api = $this->model('Api');
        $movie = $api->find_movie($param);

        // Get ratings
        $ratingModel = $this->model('Rating');
        $averageRating = $ratingModel->getAverageRating($param);

        $_SESSION['controller'] = 'movie';
        $_SESSION['movieTitle'] = $movie['Title'] ?? 'Not Found';
        $this->view('movie/search', ['movie' => $movie, 'averageRating' => $averageRating]);
    }

    public function rate($param1 = '', $param2 = '') {
        $movieTitle = $_POST['movieTitle'];
        $rating = $_POST['rating'];
        header('Location: /movie/rate/'. $movieTitle . '/' . $rating);
        
        $userId = $_SESSION['user_id'] ?? session_id();
        $ratingModel = $this->model('Rating');
        $ratingModel->addRating($userId, $param1, $param2);

    }
}
?>
