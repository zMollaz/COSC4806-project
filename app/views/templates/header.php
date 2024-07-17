<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movie Critic</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
  <link rel="icon" href="/favicon.png">
  <style>
    .bg-cyan-800 {
      background-color: #006064;
    }
  </style>
</head>

<body class="bg-light">
  <nav class="navbar navbar-expand-lg navbar-dark bg-cyan-800">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">Movie Critic</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-between" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <?php if (isset($_SESSION['auth'])): ?>
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/home">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="/reminders">Movies</a>
            </li>
          <?php endif; ?>
        </ul>
        <div class="d-flex align-items-center">
          <?php if (isset($_SESSION['auth'])): ?>
            <p class="text-white mb-0 me-3">Today is <?php echo date("l jS \of F Y"); ?></p>
            <a href="/logout" class="btn btn-danger">Logout</a>
          <?php else: ?>
            <a class="nav-link text-white" href="/login">Login</a>
            <a class="nav-link text-white" href="/create">Create account</a>
          <?php endif; ?>
        </div>
      </div>
    </div>
  </nav>
  <div class="container mt-3">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb">
        <?php if (isset($_SESSION['controller']) && $_SESSION['controller'] == 'home'): ?>
          <li class="breadcrumb-item active" aria-current="page">Home /</li>
        <?php else: ?>
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page"><?php echo ucwords($_SESSION["controller"] ?? ''); ?></li>
        <?php endif; ?>
      </ol>
    </nav>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-BwFdF5y3Me7RnHFFxBoAsuHO4P7b9U8RZZI66prPa8fyTFI3B6UJ7Cs2NNtMOHlm" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9bjeiK0FNDOsHlHCBXSz5xBfE7rgJhlSk3zp1mFN9IM+gtR3IW6ApqE" crossorigin="anonymous"></script>