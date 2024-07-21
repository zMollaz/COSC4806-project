<?php
session_start();
require_once 'Rating.php';

class Api {
    public function __construct() {
    }

    public function find_movie($movie_title = '') {
        if (strpos($movie_title, ' ') !== false) {
            $movie_title = str_replace(' ', '+', $movie_title);
        }
        $query_url = "http://www.omdbapi.com/?apikey=" . $_ENV['OMDB_KEY'] . "&t=" . $movie_title;

        $json = file_get_contents($query_url);
        $phpObj = json_decode($json, true);
        return $phpObj;
    }

    public function review_movie($movie) {
        $ratingModel = new Rating();
        $averageRating = $ratingModel->get_average_rating($movie['Title']) ?? 'Null';
        $url = "https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent?key=" . $_ENV['GEMINI_KEY'];

        $prompt = $_SESSION['rated'] ? "Generate a review for the movie titled " . $movie['Title'] . " produced in the year " . $movie['Year'] . ". There could be movies with the same name produced at different years (reproductions) so watch out for the production year when generating a response. The user requesting this review has just rated this movie " . $_SESSION['user_rating'] . " out of 5. and the average user rating in this website's local database is " . $averageRating . " out of 5. These ratings are only for your reference as a context to generate the review but don't get so biased with the user's rating just take it into consideration and do not include these rating values in your response!!" : "Generate a review for the movie titled " . $movie['Title'] . " produced in the year " . $movie['Year'] . ". There could be movies with the same name produced at different years (reproductions) so watch out for the production year when generating a response. The user requesting this review has not rated this movie yet and the average user rating in this website's local database is " . $averageRating . ". These ratings are only for your reference as a context to generate the review and not to include them in your response. So generate a general review based on imdb rating or general rating by people in public.";

        $json_data = json_encode([
            "contents" => [
                [
                    "parts" => [
                        [
                            "text" => $prompt
                        ]
                    ]
                ]
            ]
        ]);

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: application/json']);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        $json_response = curl_exec($ch);
        curl_close($ch);
        $response = json_decode($json_response, true);
        $review = $response['candidates'][0]['content']['parts'][0]['text'];

        return $review;
    }

    public function fetch_movie_data($moviesList, $ratingModel) {
        $movies = [];
        foreach ($moviesList as $movie) {
            $movieData = $this->find_movie($movie['movie_title']);
            if ($movieData['Response'] == 'True') {
                $movieData['averageRating'] = $ratingModel->get_average_rating($movie['movie_title']);
                $movies[$movie['movie_title']] = $movieData;
            }
        }
        return $movies;
    }
}
?>