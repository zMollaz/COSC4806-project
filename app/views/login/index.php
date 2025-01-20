                  <?php
                  session_start();

                  $error = '';

                  if (isset($_SESSION["loginError"])) {
                    $error = $_SESSION["loginError"];
                    unset($_SESSION["loginError"]); // Clear the error message
                  }

                  require_once 'app/views/templates/header.php';
                  ?>

                  <head>
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
                  </head>
                  <main role="main" class="container mb-5">
                    <div class="row justify-content-center">
                      <div class="col-md-6">
                        <div class="card shadow-sm">
                          <div class="card-header text-center bg-cyan-800 text-white">
                            <h1>Login</h1>
                          </div>
                          <div class="card-body bg-light-cyan">
                            <?php if ($error) : ?>
                              <div class="alert alert-danger" role="alert">
                                <?php echo $error; ?>
                              </div>
                            <?php endif; ?>
                            <form action="/login/verify" method="post">
                              <fieldset>
                                <div class="form-group">
                                  <label for="username" class="text-cyan-800">Username</label>
                                  <input required type="text" class="form-control" name="username" id="username" placeholder="Enter your username">
                                </div>
                                <div class="form-group mt-3">
                                  <label for="password" class="text-cyan-800">Password</label>
                                  <input required type="password" class="form-control" name="password" id="password" placeholder="Enter your password">
                                </div>
                                <div class="d-grid mt-4">
                                  <button type="submit" class="btn btn-cyan-800 btn-block text-white">Login</button>
                                </div>
                              </fieldset>
                            </form>
                            <div class="text-center mt-3">
                              <a href="/create" class="text-cyan-800">Create account</a>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </main>
                  <?php require_once 'app/views/templates/footer.php'; ?>
