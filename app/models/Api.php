<?php
session_start();

class Api {
    public function __construct() {}

  public function find_movie($movie_title = '') {
      if (strpos($movie_title, ' ') !== false) {
          $movie_title = str_replace(' ', '+', $movie_title);
      }
      $query_url = "http://www.omdbapi.com/?apikey=".$_ENV['OMDB_KEY']."&t=".$movie_title;

      $json = file_get_contents($query_url);
      $phpObj = json_decode($json, true);
      return $phpObj;
  }

}
?>