<?php require_once 'app/views/templates/header.php'; ?>

<head>
  <style>
    body {
      background: #f8f9fa;
    }

    .movie-details {
      background: #fff;
      border-radius: 10px;
      padding: 15px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .movie-details img {
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .movie-details h1 {
      color: #006064;
      font-weight: 700;
    }

    .movie-details p {
      font-size: 1.1em;
      margin-bottom: 0.5em;
    }

    .alert {
      margin-top: 20px;
    }

    .container {
      margin-bottom: 5rem;
    }

    .rating-stars {
      direction: rtl;
      display: flex;
      justify-content: flex-start;
      align-items: center;
    }

    .rating-stars input {
      display: none;
    }

    .rating-stars label {
      font-size: 2rem;
      color: #ccc;
      cursor: pointer;
    }

    .rating-stars input:hover ~ label,
    .rating-stars label:hover,
    .rating-stars label:hover ~ label {
      color: #ffcc00;
    }

    .rating-stars input:checked ~ label,
    .rating-stars input:checked ~ label ~ label {
      color: #ffcc00;
    }

    .rating-container {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .average-rating {
      font-size: 1.2rem;
      font-weight: bold;
    }

    .rating-form {
      display: flex;
      align-items: center;
    }

    .rating-form button {
      margin-left: 10px;
    }
  </style>
  <script>
    function showLoadingScreen() {
      document.getElementById('loading-screen').style.display = 'flex';
    }
  </script>
</head>
<main role="main" class="container">
  <?php if (isset($data['movie']) && !empty($data['movie']) && $data['movie']['Response'] == 'True') :
    $movie = $data['movie'];
  ?>
    <div class="row justify-content-center">
      <div class="col-lg-10 col-xl-8">
        <div class="movie-details p-3 bg-white rounded shadow-sm">
          <div class="text-center mb-4">
            <h1 class="display-6"><?php echo $movie['Title']; ?></h1>
          </div>
          <div class="rating-container">
            <div class="average-rating">
              <p><strong>Average Rating:</strong> <?php echo number_format($data['averageRating'], 1); ?> / 5</p>
            </div>
            <div class="rating-stars">
              <form action="/movie/rate" method="post" class="rating-form">
                <button type="submit" class="btn btn-secondary ml-3">Rate</button>
                <input type="radio" id="star5" name="rating" value="5" min="5" max="5" required><label for="star5">&#9733;</label>
                <input type="radio" id="star4" name="rating" value="4" min="4" max="4" required><label for="star4">&#9733;</label>
                <input type="radio" id="star3" name="rating" value="3" min="3" max="3" required><label for="star3">&#9733;</label>
                <input type="radio" id="star2" name="rating" value="2" min="2" max="2" required><label for="star2">&#9733;</label>
                <input type="radio" id="star1" name="rating" value="1" min="1" max="1" required><label for="star1">&#9733;</label>
                <!-- <input type="hidden" name="movieTitle" value="<?php echo $movie['Title']; ?>"> -->
              </form>
            </div>
          </div>
          <div class="row">
            <div class="col-md-3 text-center mb-4">
              <img src="<?php echo $movie['Poster']; ?>" class="img-fluid rounded" alt="Movie Poster">
              <form action="/movie/review" method="post" onsubmit="return showLoadingScreen()">
                <input type="hidden" name="movieTitle" value="<?php echo $movie['Title']; ?>">
                <button type="submit" class="btn btn-secondary mt-3">Get Review</button>
              </form>
            </div>
            <div class="col-md-9">
              <p><strong>Year:</strong> <?php echo $movie['Year']; ?></p>
              <p><strong>Genre:</strong> <?php echo $movie['Genre']; ?></p>
              <p><strong>Director:</strong> <?php echo $movie['Director']; ?></p>
              <p><strong>Actors:</strong> <?php echo $movie['Actors']; ?></p>
              <p><strong>Plot:</strong> <?php echo $movie['Plot']; ?></p>
              <p><strong>IMDB Rating:</strong> <?php echo $movie['imdbRating']; ?></p>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php else : ?>
    <div class="row justify-content-center">
      <div class="col-md-6">
        <div class="alert alert-danger text-center" role="alert">
          Movie not found. Please try another search.
        </div>
      </div>
    </div>
  <?php endif; ?>
</main>
<?php require_once 'app/views/templates/footer.php'; ?>
