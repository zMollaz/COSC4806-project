<?php
session_start();

class Home extends Controller {
    public function index() {
        $ratingModel = $this->model('Rating');
        $api = $this->model('Api');

        // If user is logged in
        if (isset($_SESSION['auth']) && isset($_SESSION['user_id'])) {
            $userId = $_SESSION['user_id'];
            $ratedMovies = $ratingModel->get_rated_movies_by_user($userId);
            $movies = $this->fetch_movie_data($ratedMovies, $ratingModel, $api);
            $this->view('home/index', ['movies' => $movies]);
        // If user is not logged in
        } else {
            $trendingMovies = $ratingModel->get_all_rated_movies();
            $movies = $this->fetch_movie_data($trendingMovies, $ratingModel, $api);
            $this->view('home/index', ['trendingMovies' => $movies]);
        }
    }

    private function fetch_movie_data($moviesList, $ratingModel, $api) {
        $movies = [];
        foreach ($moviesList as $movie) {
            $movieData = $api->find_movie($movie['movie_title']);
            if ($movieData['Response'] == 'True') {
                $movieData['averageRating'] = $ratingModel->get_average_rating($movie['movie_title']);
                $movies[$movie['movie_title']] = $movieData;
            }
        }
        return $movies;
    }
}
?>