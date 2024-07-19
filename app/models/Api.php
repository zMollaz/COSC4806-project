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
    $averageRating = $ratingModel->get_average_rating($movie['Title']) ?? 'unrated by user';
    $url = "https://generativelanguage.googleapis.com/v1/models/gemini-pro:generateContent?key=" . $_ENV['GEMINI_KEY'];

    $prompt = "Generate a review for the movie titled'" . $movie['Title'] . "' with an average rating of " . $averageRating . " out of 5.";

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
}
?>
