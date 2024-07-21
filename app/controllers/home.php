<?php
session_start();

class Home extends Controller {
    public function index() {
        // Increment the counter and save the db count in a session variable if this is a new visit
        if (!isset($_SESSION['visit_counted'])) {
            $visit = $this->model("Visit");
            $visit->increment_counter();
            $_SESSION['visit_counted'] = 1;
            $_SESSION['visit_count'] = $visit->get_visit_count();
        }

        $ratingModel = $this->model('Rating');
        $api = $this->model('Api');

        // If user is logged in
        if (isset($_SESSION['auth']) && isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $ratedMovies = $ratingModel->get_rated_movies_by_user($userId);
            $movies = $api->fetch_movie_data($ratedMovies, $ratingModel);
            $this->view('home/index', ['movies' => $movies]);
        // If user is not logged in
        } else {
            $trendingMovies = $ratingModel->get_all_rated_movies();
            $movies = $api->fetch_movie_data($trendingMovies, $ratingModel);
            $this->view('home/index', ['trendingMovies' => $movies]);
        }
    }
}
?>