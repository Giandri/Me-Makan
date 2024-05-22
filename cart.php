<?php
session_start();

function displayCart()
{
  if (empty($_SESSION['cart'])) {
    return "<p>Keranjang Anda kosong.</p>";
  } else {
    $totalPrice = 0;
    $output = '<table class="table">';
    $output .= '<thead><tr><th>Nama Produk</th><th>Harga</th><th>Quantity</th><th>Subtotal</th><th>Aksi</th></tr></thead><tbody>';
    foreach ($_SESSION['cart'] as $id => $item) {
      $subtotal = intval(preg_replace('/[^\d]/', '', $item['price'])) * $item['quantity'];
      $totalPrice += $subtotal;
      $output .= "<tr>";
      $output .= "<td>" . htmlspecialchars($item['title']) . "</td>";
      $output .= "<td>" . htmlspecialchars($item['price']) . "</td>";
      $output .= "<td>" . htmlspecialchars($item['quantity']) . "</td>";
      $output .= "<td>Rp " . number_format($subtotal, 0, ',', '.') . "</td>";
      $output .= "<td><button onclick='updateCart(\"decrease\", $id)' class='btn btn-secondary btn-sm'>-</button> ";
      $output .= "<button onclick='updateCart(\"remove\", $id)' class='btn btn-danger btn-sm'>x</button></td>";
      $output .= "</tr>";
    }
    $output .= '</tbody></table>';
    $output .= '<p>Total Harga: Rp ' . number_format($totalPrice, 0, ',', '.') . '</p>';
    return $output;
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Keranjang Belanja</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<body>
  <nav class="navbar bg-body-tertiary fixed-top">
    <div class="container-lg">
      <a class="navbar-brand" href="#"><i class="fa-solid fa-drumstick-bite"></i> Me-Makan.</a>
      <div class="d-flex justify-content-end">
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
  <div class="container mt-5">
    <div class="mb-3">
      <a href="index.php" class="btn btn-primary mt-5">Kembali ke Menu</a>
    </div>
    <h2>Keranjang Belanja Anda</h2>
    <?php echo displayCart(); ?>
  </div>

  <script>
    function updateCart(action, id) {
      fetch('update_cart.php', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
          },
          body: 'action=' + action + '&id=' + id
        })
        .then(response => response.text())
        .then(text => {
          window.location.reload();
        });
    }
  </script>
</body>

</html>