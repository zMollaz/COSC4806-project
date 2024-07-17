<?php require_once 'app/views/templates/header.php'; ?>
<main role="main" class="container mt-5">
    <?php if (isset($data['movie']) && !empty($data['movie']) && $data['movie']['Response'] == 'True'): ?>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm">
                    <div class="card-header text-center bg-cyan-800 text-white">
                        <h1><?php echo $data['movie']['Title']; ?></h1>
                    </div>
                    <div class="card-body bg-light-cyan">
                        <div class="row">
                            <div class="col-md-4">
                                <img src="<?php echo $data['movie']['Poster']; ?>" class="img-fluid" alt="Movie Poster">
                            </div>
                            <div class="col-md-8">
                                <p><strong>Year:</strong> <?php echo $data['movie']['Year']; ?></p>
                                <p><strong>Genre:</strong> <?php echo $data['movie']['Genre']; ?></p>
                                <p><strong>Director:</strong> <?php echo $data['movie']['Director']; ?></p>
                                <p><strong>Actors:</strong> <?php echo $data['movie']['Actors']; ?></p>
                                <p><strong>Plot:</strong> <?php echo $data['movie']['Plot']; ?></p>
                                <p><strong>IMDB Rating:</strong> <?php echo $data['movie']['imdbRating']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>
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
