<?php require_once 'app/views/templates/header.php'; ?>

<main role="main" class="container mb-5">
  <div class="row justify-content-center">
    <div class="col-lg-10 col-xl-8">
      <div class="movie-details p-3 bg-white rounded shadow-sm">
        <div class="text-center mb-4">
          <h1 class="display-6">Review for "<?php echo htmlspecialchars($data['movieTitle']); ?>"</h1>
        </div>
        <div class="review-content">
          <p><?php echo nl2br(htmlspecialchars($data['review'])); ?></p>
        </div>
      </div>
    </div>
  </div>
</main>

<?php require_once 'app/views/templates/footer.php'; ?>
