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

        // $movie_title = $_REQUEST['movie'];
        $api = $this->model('Api');
        $movie = $api->find_movie($param);

        $_SESSION['controller'] = 'movie';
        $_SESSION['movieTitle'] = $movie['Title'] ?? 'Not Found';
        $this->view('movie/search', ['movie' => $movie]);
    }
}
?>