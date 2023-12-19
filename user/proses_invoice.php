<?php

namespace Midtrans;

include '../config/koneksi.php';
require_once '../midtrans/Midtrans.php';

session_start();

$email = $_SESSION['email'];
$username = $_SESSION['username'];

if (isset($_SESSION['username']) && $_SESSION['level'] == 'user') {
} else {
  echo '<script>alert("Anda harus login / jadi terlebih dahulu untuk mengakses halaman ini.");</script>';
  echo '<script>window.location.href = "../login.php";</script>';
  exit;
}

// Set API Key Midtrans
Config::$serverKey = "SB-Mid-server-28hOA4BV_juYcAFK7fmnllWh";
Config::$clientKey = "SB-Mid-client-J7n4q7183q2vmTpC";
Config::$isProduction = false; // Set to true if already in production

$user_id = $_SESSION['id_user'];
$email = $_POST['email'];
$type = $_POST['type']; // Corrected variable name

function user_notif($id_user, $message)
{
  global $conn;
  $sql = "INSERT INTO tbl_notifikasi (id_user, pesan) VALUES ($id_user, '$message')";
  $result = mysqli_query($conn, $sql);
  return $result;
}

// Generate a unique order_id
$order_id = 'magerin_' . rand(1, 100000) . '_' . $type;

// insert into database
mysqli_query($conn, "INSERT INTO tbl_transaction (order_id, type_subscription, email, `user_id`) VALUES ('$order_id', '$type', '$email', $user_id)");

// notification
user_notif($user_id, 'Anda telah melakukan transaksi pembelian subsription tipe ' . $type . '. Silahkan cek status transaksi Anda di halaman status transaksi.');

// get detail product
$detail = mysqli_query($conn, "SELECT * FROM tbl_premium WHERE `type` = '$type'");
$detail = mysqli_fetch_assoc($detail);

// mitrans things
$transaction_details = array(
  'order_id' => $order_id,
  'gross_amount' => 10000, // no decimal allowed for creditcard
);

$customer_details = array(
  'first_name'    => $username,
  'email'         => $email,
);

$item_details = array(
  'id' => 'a' . $detail['id'],
  'price' => $detail['harga'],
  'quantity' => 1,
  'name' => $detail['type']
);

$params = array(
  'transaction_details' => $transaction_details,
  'customer_details' => $customer_details,
  'item_details' => array($item_details),
);

$snapToken = Snap::getSnapToken($params);

echo $snapToken;
