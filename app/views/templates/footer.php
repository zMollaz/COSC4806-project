<head>
  <style>
    body {
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    .content {
      flex: 1;
    }

    .footer-padding {
      padding-top: 20px;
    }
  </style>
</head>
<div class="content"></div>
<footer class="bg-light text-center text-lg-start footer-padding">
  <div class="container-fluid py-3" style="background-color: rgba(0, 0, 0, 0.2);">
    <div class="row align-items-center">
      <div class="col-lg-4 col-md-12 mb-4 mb-lg-0 text-center">
        <span>© 2024 Movie Critic All rights reserved.</span>
      </div>
      <div class="col-lg-4 col-md-12 text-lg-end text-center">
        <ul class="list-unstyled d-flex justify-content-lg-end justify-content-center mb-0">
          <li class="me-3">
            <?php echo isset($_SESSION["username"]) ? ' <a href="/" class="text-dark">Home</a>' : ''; ?>
          </li>
        </ul>
      </div>
    </div>
  </div>
</footer>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
</body>
</html>
