<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Movie Critic</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="icon" href="/favicon.png">
  <style>
    .bg-cyan-800 {
      background-color: #006064;
    }

    .text-cyan-800 {
      color: #006064;
    }

    .breadcrumb-item a {
      color: #006064;
    }

    .breadcrumb-item.active {
      color: #004d4d;
    }

    .breadcrumb-container {
      padding: 5px 0 0 10px;
      position: fixed;
      top: 56px;
      width: 100%;
      z-index: 1030;
      background-color: #f8f9fa;
    }

    .navbar {
      position: fixed;
      top: 0;
      width: 100%;
      z-index: 1040;
      display: flex;
      justify-content: center;
      align-items: center;
    }

    .navbar-brand {
      position: absolute;
      left: 50%;
      transform: translateX(-50%);
    }

    .navbar-brand img {
      height: 100px;
      width: 100px;
      border-radius: 50%;
      position: absolute;
      bottom: -20px;
      left: 50%;
      transform: translate(-50%, 50%);
      background-color: white;
    }

    .content {
      margin-top: 112px;
    }

    #loading-screen {
      display: none;
      position: fixed;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      background: rgba(255, 255, 255, 0.7);
      z-index: 1050;
      justify-content: center;
      align-items: center;
    }

    .spinner-border {
      width: 3rem;
      height: 3rem;
      border-width: 0.3rem;
    }
  </style>
</head>

<body class="bg-light d-flex flex-column min-vh-100">
  <div id="loading-screen" class="text-cyan-800">
    <div class="spinner-border text-cyan-800" role="status">
    </div>
  </div>
  <nav class="navbar navbar-expand-lg rounded-bottom navbar-dark bg-cyan-800">
    <div class="container-fluid">
      <a class="navbar-brand" href="/">
        <img src="/public/images/logo.png" alt="Movie Critic">
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-end" id="navbarSupportedContent">
        <ul class="navbar-nav mb-2 mb-lg-0">
          <li class="nav-item">
            <a href="/movie" class="nav-link text-white d-flex align-items-center">
              <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search me-2" viewBox="0 0 16 16">
                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001l3.85 3.85a1 1 0 0 0 1.415-1.415l-3.85-3.85zm-5.75-8.587a5.5 5.5 0 1 1 0 11 5.5 5.5 0 0 1 0-11z" />
              </svg>
              Search
            </a>
          </li>
          <?php if (isset($_SESSION['auth'])) : ?>
            <li class="nav-item">
              <p class="nav-link text-white mb-0"><?php echo ucwords($_SESSION['username']); ?></p>
            </li>
            <li class="nav-item">
              <a href="/logout" class="btn btn-danger">Logout</a>
            </li>
          <?php else : ?>
            <li class="nav-item">
              <a class="nav-link text-white" href="/login">Login</a>
            </li>
            <li class="nav-item">
              <a class="nav-link text-white" href="/create">Create account</a>
            </li>
          <?php endif; ?>
        </ul>
      </div>
    </div>
  </nav>
  <div class="breadcrumb-container">
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb mb">
        <li class="breadcrumb-item"><a href="/">Home</a></li>
        <?php if (isset($_SESSION['controller']) && $_SESSION['controller'] !== 'home') : ?>
          <li class="breadcrumb-item"><a href="/<?php echo strtolower($_SESSION['controller']); ?>"><?php echo $_SESSION['controller'] === 'movie' ? 'Search' : ucwords($_SESSION['controller']); ?></a></li>
          <?php if (isset($_SESSION['movieTitle']) && $_SESSION['controller'] === 'movie') : ?>
            <li class="breadcrumb-item"><a href="/movie/search/<?php echo strtolower($_SESSION['movieTitle']); ?>"><?php echo ucwords($_SESSION['movieTitle']); ?></a></li>
            <?php if (isset($_SESSION['action']) && $_SESSION['action'] === 'review') : ?>
              <li class="breadcrumb-item active" aria-current="page">Review</li>
            <?php endif; ?>
          <?php endif; ?>
        <?php endif; ?>
      </ol>
    </nav>
  </div>
  <div class="content"></div>