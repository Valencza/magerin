<?php

namespace Midtrans;

include '../config/koneksi.php';
require_once '../midtrans/Midtrans.php';

Config::$isProduction = false;
Config::$serverKey = "SB-Mid-server-28hOA4BV_juYcAFK7fmnllWh";

$notif = new Notification();

$transaction = $notif->transaction_status;
$type = $notif->payment_type;
$order_id = $notif->order_id;
$fraud = $notif->fraud_status;

// get user id 
$sql = "SELECT `user_id`, type_subscription FROM tbl_transaction WHERE order_id = '$order_id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

$message = 'ok';

function update_status($order_id, $status)
{
    global $conn;
    $sql = "UPDATE tbl_transaction SET status = '$status' WHERE order_id = '$order_id'";
    $result = mysqli_query($conn, $sql);
    return $result;
}

function create_new_subscription($id_user, $type_subscription)
{
    global $conn;

    if ($type_subscription == 'basic') {
        $time_end = date('Y-m-d H:i:s', strtotime('+1 month'));
    }

    $sql = "INSERT INTO tbl_subscription (time_end, id_user, type_subscription) VALUES ('$time_end', $id_user, '$type_subscription')";
    $result = mysqli_query($conn, $sql);
    return $result;
}

if ($transaction == 'capture') {
    $message = "Transaction order_id: " . $order_id . " successfully captured using " . $type;
} elseif ($transaction == 'settlement') {
    update_status($order_id, 'success');
    create_new_subscription(
        $row['user_id'],
        $row['type_subscription']
    );
    $message = "Transaction order_id: " . $order_id . " successfully transfered using " . $type;
} elseif ($transaction == 'pending') {
    update_status($order_id, 'pending');
    $message = "Waiting customer to finish transaction order_id: " . $order_id . " using " . $type;
} elseif ($transaction == 'deny') {
    update_status($order_id, 'deny');
    $message = "Payment using " . $type . " for transaction order_id: " . $order_id . " is denied.";
} elseif ($transaction == 'expire') {
    update_status($order_id, 'expire');
    $message = "Payment using " . $type . " for transaction order_id: " . $order_id . " is expired.";
} elseif ($transaction == 'cancel') {
    update_status($order_id, 'cancel');
    $message = "Payment using " . $type . " for transaction order_id: " . $order_id . " is canceled.";
}

$filename = $order_id . ".txt";
$dirpath = 'log';
is_dir($dirpath) || mkdir($dirpath, 0777, true);

echo file_put_contents($dirpath . "/" . $filename, $message);
