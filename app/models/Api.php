<?php
session_start();

class Api {

    public function __construct() {}

    public function find_movie($movie_title = '') {
        $query_url = "http://www.omdbapi.com/?apikey=".$_ENV['OMDB_KEY']."&t=".urlencode($movie_title);

        $json = file_get_contents($query_url);
        $phpObj = json_decode($json, true);
        return $phpObj;
    }
}
?>