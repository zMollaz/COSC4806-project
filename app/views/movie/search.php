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
  </style>
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
          <div class="row">
            <div class="col-md-3 text-center mb-4">
              <img src="<?php echo $movie['Poster']; ?>" class="img-fluid rounded" alt="Movie Poster">
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