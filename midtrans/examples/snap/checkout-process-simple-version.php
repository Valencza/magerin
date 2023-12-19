<?php

namespace Midtrans;

require_once dirname(__FILE__) . '/../../Midtrans.php';
// Set Your server key
// can find in Merchant Portal -> Settings -> Access keys
Config::$serverKey = 'SB-Mid-server-pK2dYyC2JRE6sp3r1_i9Vy9n';
Config::$clientKey = 'SB-Mid-client-6aun0dALMFOh3Tj6';

// non-relevant function only used for demo/example purpose
printExampleWarningMessage();

// Uncomment for production environment
// Config::$isProduction = true;
Config::$isSanitized = Config::$is3ds = true;

// Required
include '../../../config/koneksi.php';
session_start();



if (isset($_SESSION['username']) && $_SESSION['level'] == 'user') {
} else {
  echo '<script>alert("Anda harus login / jadi terlebih dahulu untuk mengakses halaman ini.");</script>';
  echo '<script>window.location.href = "../login.php";</script>';
  exit;
}

$email = $_SESSION['email'];
$username = $_SESSION['username'];
$order_id = rand();
$query = mysqli_query($conn, "SELECT * FROM tbl_transaksi WHERE order_id = '".$order_id. "'");
$data = mysqli_fetch_array($query);

$video = $data['video'];
$harga = $data['harga'];

$transaction_details = array(
    'order_id' => $order_id, 
    'gross_amount' => $harga, 
);
// Optional
$item_details = array (
    array(
        'id' => 'a1',
        'price' => $harga,
        'quantity' => 1,
        'name' => "PEMBAYARAN MAGERINXXI"
    ),
  );
// Optional
$customer_details = array(
    'first_name'    => "$username",
    'last_name'     => "",
    'email'         => "$email",
    'phone'         => "",
);
// Fill transaction details
$transaction = array(
    'transaction_details' => $transaction_details,
    'customer_details' => $customer_details,
    'item_details' => $item_details,
);

$snap_token = '';
try {
    $snap_token = Snap::getSnapToken($transaction);
}
catch (\Exception $e) {
    echo $e->getMessage();
}
echo "snapToken = ".$snap_token;

function printExampleWarningMessage() {
    if (strpos(Config::$serverKey, 'your ') != false ) {
        echo "<code>";
        echo "<h4>Please set your server key from sandbox</h4>";
        echo "In file: " . __FILE__;
        echo "<br>";
        echo "<br>";
        echo htmlspecialchars('Config::$serverKey = \'SB-Mid-server-pK2dYyC2JRE6sp3r1_i9Vy9n\';');
        die();
    } 
}

?>

<!DOCTYPE html>
<html>
    <body>
        <button id="pay-button">Pay!</button>
        <!-- TODO: Remove ".sandbox" from script src URL for production environment. Also input your client key in "data-client-key" -->
        <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey;?>"></script>
        <script type="text/javascript">
            document.getElementById('pay-button').onclick = function(){
                // SnapToken acquired from previous step
                snap.pay('<?php echo $snap_token?>');
            };
        </script>
    </body>
</html>
