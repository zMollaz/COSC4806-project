<?php
class Movie extends Controller {
    public function index() {
        $this->view('movie/index');
    }

    public function search() {
        if (!isset($_REQUEST['movie'])) {
            header('Location: /movie');  
        }

        $movie_title = $_REQUEST['movie'];
        $api = $this->model('Api');
        $movie = $api->find_movie($movie_title);

        $this->view('movie/search', ['movie' => $movie]);
    }
}
?>