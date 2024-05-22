<?php
session_start();

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}
function displayCart()
{
  if (empty($_SESSION['cart'])) {
    return "Keranjang Anda kosong.";
  } else {
    $output = '<ul class="list-group">';
    foreach ($_SESSION['cart'] as $item) {
      $output .= '<li class="list-group-item">';
      $output .= htmlspecialchars($item['title']) . ' - ' . htmlspecialchars($item['price']);
      $output .= '</li>';
    }
    $output .= '</ul>';
    return $output;
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <title>Me-Makan Menu</title>

  <style>
    * {
      font-family: "Roboto", sans-serif;
    }

    a {
      text-decoration: none;
      color: darkgrey;
    }
  </style>
  <script>
    $(document).ready(function() {
      $('.add-to-cart').on('click', function() {
        var itemId = $(this).data('id');
        $.ajax({
          type: 'POST',
          url: 'add.php',
          data: {
            id: itemId
          },
          success: function(response) {
            alert('Item telah ditambahkan ke keranjang!');

          },
          error: function() {
            alert('Error menambahkan item ke keranjang.');
          }
        });
      });
    });
  </script>

</head>

<body>
  <nav class="navbar bg-body-tertiary fixed-top">
    <div class="container-lg">
      <a class="navbar-brand" href="#"><i class="fa-solid fa-drumstick-bite"></i> Me-Makan.</a>
      <div class="d-flex justify-content-end">
        <button class="navbar-toggler me-2" type="button">
          <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
        </button>
        <button class="navbar-toggler justify-content-end" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
      </div>
      <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
          <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
            <li class="nav-item">
              <a class="nav-link active " aria-current="page" href="index.php"><i class="fa-solid fa-house"></i> Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="fa-solid fa-circle-user"></i> Profile</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#"><i class="fa-solid fa-right-from-bracket"></i> Logout</a>
            </li>
          </ul>
        </div>
      </div>
    </div>
  </nav>


  <?php include "menu.php"; ?>

  <div class=" text-center mb-3">
    <h3 class="mb-5">Selamat Berbelanja.</h3>
    <i class="fa fa-copyright" aria-hidden="true"></i> Copyright 2024 | Giandri Aditio
  </div>
</body>

</html>