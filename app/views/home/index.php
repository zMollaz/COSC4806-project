<?php require_once 'app/views/templates/header.php'; ?>

<head>
  <style>
    body {
      background: #f4f4f9;
      font-family: 'Arial', sans-serif;
    }

    .container {
      max-width: 1200px;
      margin: 0 auto;
      padding: 2rem 1rem;
    }

    h2 {
      text-align: center;
      color: #333;
      font-weight: 700;
      margin-bottom: 2rem;
      font-size: 2.5rem;
      position: relative;
      display: inline-block;
    }

    h2::after {
      content: '';
      display: block;
      width: 50px;
      height: 5px;
      background: #ffcc00;
      margin: 10px auto 0;
    }

    .movie-gallery {
      display: grid;
      grid-template-columns: repeat(4, 1fr);
      gap: 1.5rem;
      justify-content: center;
    }

    .movie-card {
      background: #fff;
      border-radius: 10px;
      padding: 15px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      text-align: center;
      transition: transform 0.3s, box-shadow 0.3s;
      cursor: pointer;
      height: 450px;
      text-decoration: none;
      color: inherit;
    }

    .movie-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
    }

    .movie-card img {
      border-radius: 10px;
      width: 100%;
      height: 70%;
      object-fit: cover;
      object-position: center;
      margin-bottom: 1rem;
    }

    .movie-card h5 {
      color: #006064;
      font-weight: 700;
      margin: 10px 0;
      font-size: 1.2rem;
    }

    .movie-card p {
      font-size: 1em;
      color: #777;
      margin: 0;
    }

    .average-rating {
      color: #ffcc00;
      font-weight: bold;
      margin-top: 0.5rem;
    }

    @media (max-width: 992px) {
      .movie-gallery {
        grid-template-columns: repeat(3, 1fr);
      }
    }

    @media (max-width: 768px) {
      .movie-gallery {
        grid-template-columns: repeat(2, 1fr);
      }
    }

    @media (max-width: 576px) {
      .movie-gallery {
        grid-template-columns: 1fr;
      }
    }
  </style>
</head>
<main role="main" class="container mb-4">
  <h2>
    <?php if (isset($data['movies'])): ?>
      My Rated Movies
    <?php elseif (isset($data['trendingMovies'])): ?>
      Trending Movies
    <?php else: ?>
      Movies
    <?php endif; ?>
  </h2>
  <div class="movie-gallery">
    <?php if (isset($data['movies'])): ?>
      <?php foreach ($data['movies'] as $movie): ?>
        <a class="movie-card" href="/movie/search/<?php echo strtolower($movie['Title']); ?>">
          <img src="<?php echo $movie['Poster']; ?>" alt="Movie Poster">
          <h5><?php echo $movie['Title']; ?></h5>
          <p class="average-rating">Average Rating: <?php echo number_format($movie['averageRating'], 1); ?> / 5</p>
        </a>
      <?php endforeach; ?>
    <?php elseif (isset($data['trendingMovies'])): ?>
      <?php foreach ($data['trendingMovies'] as $movie): ?>
        <a class="movie-card" href="/movie/search/<?php echo strtolower($movie['Title']); ?>">
          <img src="<?php echo $movie['Poster']; ?>" alt="Movie Poster">
          <h5><?php echo $movie['Title']; ?></h5>
          <p><?php echo $movie['Year']; ?></p>
          <p class="average-rating">Average Rating: <?php echo number_format($movie['averageRating'], 1); ?> / 5</p>
        </a>
      <?php endforeach; ?>
    <?php else: ?>
      <p>No movies to display.</p>
    <?php endif; ?>
  </div>
</main>
<?php require_once 'app/views/templates/footer.php'; ?>
