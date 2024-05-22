<?php
session_start();

$products = [
  1 => ['title' => 'Ayam Geprek', 'price' => 17000],
  2 => ['title' => 'Ayam Goreng', 'price' => 13000],
  3 => ['title' => 'Ayam Bakar', 'price' => 15000],
  4 => ['title' => 'Ayam Cripy', 'price' => 15000],
  5 => ['title' => 'Ayam Telur', 'price' => 17000],
  6 => ['title' => 'Ayam Gepuk', 'price' => 17000],
  7 => ['title' => 'Es Teh', 'price' => 5000],
  8 => ['title' => 'Es Jeruk', 'price' => 5000],
  9 => ['title' => 'Es Milo', 'price' => 5000],
];

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = [];
}

$id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_NUMBER_INT);

if ($id && isset($products[$id])) {
  if (!isset($_SESSION['cart'][$id])) {
    $_SESSION['cart'][$id] = $products[$id];
    $_SESSION['cart'][$id]['quantity'] = 1;
  } else {
    $_SESSION['cart'][$id]['quantity'] += 1;
  }
  $response = [
    'success' => true,
    'message' => 'Produk ditambahkan',
    'title' => $products[$id]['title'],
    'quantity' => $_SESSION['cart'][$id]['quantity'],
    'total_price' => $_SESSION['cart'][$id]['quantity'] * $products[$id]['price']
  ];
} else {
  $response = [
    'success' => false,
    'message' => 'Produk tidak ditemukan'
  ];
}

header('Content-Type: application/json');
echo json_encode($response);
