<?php
session_start();

if (isset($_POST['id']) && isset($_POST['action'])) {
  $id = $_POST['id'];
  $action = $_POST['action'];

  if ($action == 'decrease' && isset($_SESSION['cart'][$id]) && $_SESSION['cart'][$id]['quantity'] > 1) {
    $_SESSION['cart'][$id]['quantity']--;
  } elseif ($action == 'remove' && isset($_SESSION['cart'][$id])) {
    unset($_SESSION['cart'][$id]);
  }
}
