<?php

$order_id = $_GET['order_id'];

$server_key = 'SB-Mid-server-28hOA4BV_juYcAFK7fmnllWh';
$base64EncodedKey = base64_encode($server_key);

$url = 'https://api.sandbox.midtrans.com/v2/' . $order_id . '/status';
$options = [
  'http' => [
    'method' => 'GET',
    'header' => [
      'Content-Type: application/json',
      'Accept: application/json',
      'Authorization: Basic ' . $base64EncodedKey,
    ],
  ],
];

$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);

if ($response === FALSE) {
  die('Error occurred while fetching data');
}

$data = json_decode($response, true);

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MagerinXXI</title>
  <link rel="shortcut icon" href="../Images/Logo/Tittle.png" type="image/x-icon">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Inter', sans-serif;
      margin: 0;
      padding: 0;
      background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url(https://blog-content.ixigo.com/wp-content/uploads/2020/04/Bollyquiz2.jpeg) no-repeat center center fixed;
      background-size: cover;
      color: white;
    }

    .container {
      position: relative;
      width: 80%;
      margin: 0 auto;
      padding: 20px;
      background-color: rgba(21, 18, 18, 0.8);
      margin-top: 50px;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
    }

    h1 {
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    th,
    td {
      padding: 12px;
      border: 1px solid #ddd;
      text-align: left;
    }

    th {
      background-color: #f2f2f2;
    }

    .back-button {
      position: absolute;
      top: 20px;
      left: 20px;
      display: inline-block;
      padding: 10px 15px;
      background-color: whitesmoke;
      color: black;
      text-decoration: none;
      border-radius: 5px;
      margin-top: 20px;
    }
  </style>
</head>

<body>
  <div class="container">
    <a href="javascript:history.back()" class="back-button">Back</a>
    <h1>Transaction Details</h1>

    <table>
      <tr>
        <th>Field</th>
        <th>Value</th>
      </tr>
      <?php
      foreach ($data as $key => $value) {
        echo '<tr>';
        echo '<td>' . str_replace('_', ' ', $key) . '</td>';
        echo '<td>' . (is_array($value) ? json_encode($value) : $value) . '</td>';
        echo '</tr>';
      }
      ?>
    </table>
  </div>
</body>

</html>