    <?php
    session_start();
    require_once 'Rating.php';
    class Api
    {
      public function __construct()
      {
      }

      public function find_movie($movie_title = '')
      {
        if (strpos($movie_title, ' ') !== false) {
          $movie_title = str_replace(' ', '+', $movie_title);
        }
        $query_url = "http://www.omdbapi.com/?apikey=" . $_ENV['OMDB_KEY'] . "&t=" . $movie_title;

        $json = file_get_contents($query_url);
        $phpObj = json_decode($json, true);
        return $phpObj;
      }

      public function review_movie($movie_title = '')
      {
        $ratingModel = new Rating();
        $averageRating = $ratingModel->get_average_rating($movie_title);
        $url =
          "https://generativelanguage.googleapis.com/v1/models/gemini-
            pro: generateContent?key=" . $_ENV['GEMINI_KEY'];
        $data = array(
          "contents" => array(
            array(
              "role" =>
              "user",
              "parts" => array(
                array(
                  "text" =>
                  'Print the numbers 1-10'
                )
              )
            )
          )
        );

        $json_data = json_encode($data);
          $ch = curl_init(surl);
          curl_setopt($ch, CURLOPT_HTTPHEADER, array( 'Content-Type:
          application/json' ));
          curl_setopt($ch, CURLOPT_POSTFIELDS, $json_data);
          curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
          $response = curl_exec($ch) ; curl_close($ch);
          if(curl_errno ($ch)) {
          echo 'Curl error: ' . curl_error($ch);
          };
          echo "<pre>"; 
          echo response;
      }
    }