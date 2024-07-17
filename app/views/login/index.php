<?php 
session_start();

$error = '';

if (isset($_SESSION["loginError"]) && $_SESSION["loginError"] == true) {
    $error = $_SESSION["loginError"];
}

?>
<main role="main" class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-header text-center">
                    <h1>Login</h1>
                </div>
                <div class="card-body">
                    <?php if ($error): ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php endif; ?>
                    <form action="/login/verify" method="post">
                        <fieldset>
                            <div class="form-group">
                                <label for="username">Username</label>
                                <input required type="text" class="form-control" name="username" id="username" placeholder="Enter your username">
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input required type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
                            </div>
                            <div class="d-grid mt-3">
                                <button type="submit" class="btn btn-primary btn-block">Login</button>
                            </div>
                        </fieldset>
                    </form> 
                    <div class="text-center mt-3">
                        <a href="/create">Create account</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>