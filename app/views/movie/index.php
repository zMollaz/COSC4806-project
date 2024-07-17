<?php 
session_start();
if (isset($_SESSION['movieTitle'])) {
    unset($_SESSION['movieTitle']);
}

require_once 'app/views/templates/header.php'; 
?>

<div class="container mt-5">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm">
        <div class="card-header text-center bg-cyan-800 text-white">
          <h1>Search Movies</h1>
        </div>
        <div class="card-body bg-light-cyan">
          <form action="/movie/search" method="post">
            <div class="input-group">
              <input type="text" name="movie" class="form-control" placeholder="Enter movie name" required>
              <button class="btn btn-cyan-800 text-white" type="submit">Search</button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<?php if (isset($data['movie'])): ?>
<div class="container mt-4">
  <div class="row justify-content-center">
    <div class="col-md-8">
      <div class="card shadow-sm">
        <div class="card-header bg-cyan-800 text-white">
          <h2><?php echo $data['movie']['Title']; ?></h2>
        </div>
        <div class="card-body bg-light-cyan">
          <h4>Year: <?php echo $data['movie']['Year']; ?></h4>
          <p><strong>Genre:</strong> <?php echo $data['movie']['Genre']; ?></p>
          <p><strong>Director:</strong> <?php echo $data['movie']['Director']; ?></p>
          <p><strong>Plot:</strong> <?php echo $data['movie']['Plot']; ?></p>
          <p><strong>IMDB Rating:</strong> <?php echo $data['movie']['imdbRating']; ?></p>
        </div>
      </div>
    </div>
  </div>
</div>
<?php endif; ?>

<?php require_once 'app/views/templates/footer.php'; ?>

<style>
  .bg-cyan-800 {
    background-color: #006064;
  }
  .text-cyan-800 {
    color: #006064;
  }
  .bg-light-cyan {
    background-color: #e0f7fa;
  }
  .btn-cyan-800 {
    background-color: #006064;
    border-color: #006064;
    color: #ffffff;
  }
  .btn-cyan-800:hover {
    background-color: #004d4d;
    border-color: #004d4d;
  }
</style>
