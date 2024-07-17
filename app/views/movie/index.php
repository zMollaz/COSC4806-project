<?php
session_start();
if (isset($_SESSION['movieTitle'])) {
  unset($_SESSION['movieTitle']);
}

require_once 'app/views/templates/header.php';
?>

<head>
  <style>
    body,
    html {
      height: 100%;
      margin: 0;
      overflow: hidden;
    }

    .text-cyan-800 {
      color: #006064 !important;
    }

    .btn-cyan-800 {
      background-color: #006064 !important;
      border-color: #006064 !important;
      color: #ffffff !important;
    }

    .btn-cyan-800:hover {
      background-color: #004d4d !important;
      border-color: #004d4d !important;
    }

    .custom-background {
      background: url('public/images/background.png') no-repeat center center fixed;
      background-size: cover;
      animation: fadein 2s;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .search-section {
      background: rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(10px);
      padding: 2rem;
      text-align: center;
      border-radius: 0.5rem;
      width: 100%;
      max-width: 80%;
    }

    @keyframes fadein {
      from {
        opacity: 0;
      }

      to {
        opacity: 1;
      }
    }
  </style>
</head>
<div class="custom-background rouded-top">
  <div class="search-section">
    <h1 class="text-cyan-800">Search Movies</h1>
    <form action="/movie/search" method="post" class="mt-4">
      <div class="input-group">
        <input type="text" name="movie" class="form-control" placeholder="Enter movie name" required>
        <button class="btn btn-cyan-800 text-white" type="submit">Search</button>
      </div>
    </form>
  </div>
</div>
<?php require_once 'app/views/templates/footer.php'; ?>