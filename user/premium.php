<?php

namespace Midtrans;

include '../config/koneksi.php';
require_once '../midtrans/Midtrans.php';

Config::$serverKey = "SB-Mid-server-28hOA4BV_juYcAFK7fmnllWh";
Config::$clientKey = "SB-Mid-client-J7n4q7183q2vmTpC";
Config::$isProduction = false; // Set to true if already in production

session_start();

if (isset($_SESSION['username'])) {
  $username = $_SESSION['username'];
  $query_user_id = mysqli_query($conn, "SELECT id_user FROM tbl_user WHERE username = '$username'");
  $user = mysqli_fetch_assoc($query_user_id);
  $_SESSION['user_id'] = $user['id_user'];
} else {

  echo '<script>alert("Anda harus login / jadi terlebih dahulu untuk mengakses halaman ini.");</script>';
  echo '<script>window.location.href = "../login.php";</script>';
  exit;
}

$username = $_SESSION['username'];
$profil = mysqli_query($conn, "SELECT * FROM tbl_user WHERE username ='$username'");
$data = mysqli_fetch_assoc($profil);

if (isset($_SESSION['username']) && $_SESSION['level'] == 'user') {
} else {
  header("Location: login.php");
  exit;
}

// get all user transaction
$transactions = mysqli_query($conn, "SELECT * FROM tbl_transaction WHERE `user_id` = " . $_SESSION['id_user']);
$transac_data = mysqli_fetch_all($transactions, MYSQLI_ASSOC);

// get user subscription
$subscription = mysqli_query($conn, "SELECT * FROM tbl_subscription WHERE `id_user` = " . $_SESSION['id_user']);
$subscription_data = mysqli_fetch_assoc($subscription);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>MagerinXXI</title>
  <link rel="shortcut icon" href="../Images/Logo/Tittle.png" type="image/x-icon">

  <!-- Font  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link href="../static/style.css" rel="stylesheet" type="text/css" />
  <link href="../static/premium.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  <link rel="stylesheet" href="../static/bootstrap.min.css">
  <link rel="stylesheet" href="../static/style-min.css">
  <link rel="stylesheet" href="cards.css">

  <style>
    #nav:hover {
      background-color: #e60e23 !important;

    }

    /* CSS untuk memposisikan modal di tengah halaman */
    .modal {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
      margin: 0;
      padding: 0;
      overflow: auto;
      margin-top: 100px;
    }

    /* CSS untuk mengatur posisi modal content */
    .modal-content {
      width: 70%;
      max-width: 400px;
      padding: 20px;
      text-align: center;
      background-color: #800000;
      border-radius: 10px;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }


    .close {
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 20px;
      cursor: pointer;
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }

    .logo {
      width: 110px;
      height: 90px;
      padding: 3px;
      margin: 0;
      padding: 0;
    }

    .fas:hover {
      background: none !important;
    }

    .nav-item {
      flex-wrap: wrap;
    }

    .menu li a:hover {
      color: red !important;
      opacity: 0.5;
    }

    /* CSS FOR FOOTER */
    .footer {
      margin-bottom: 15px;
      font-family: Verdana, Geneva, Tahoma, sans-serif;
    }

    .footer-content {
      display: flex;
      justify-content: space-between;
      padding: 10px 20px;
    }

    .footer-logo {
      width: 150px;
      height: 120px;
      padding: 3px;
      margin: 0px 0px 0px 10px;
      padding: 0;
    }

    .nav-item :hover {
      margin-bottom: 10px;
      /* background-color: aquamarine; */
      border-bottom: 3px;
      border-color: red;
      border-bottom-style: solid;
    }

    /* CSS untuk memposisikan modal di tengah halaman */
    .modal {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100%;
      margin: 0;
      padding: 0;
      overflow: auto;
      margin-top: 100px;
    }

    /* CSS untuk mengatur posisi modal content */
    .modal-content {
      width: 70%;
      max-width: 400px;
      padding: 20px;
      text-align: center;
      background-color: #800000;
      border-radius: 10px;
      box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
    }


    .close {
      position: absolute;
      top: 10px;
      right: 10px;
      font-size: 20px;
      cursor: pointer;
    }

    /* CSS untuk memposisikan dan merapikan label dan input */
    .form-group {
      margin-bottom: 20px;
    }

    label {
      display: block;
      font-weight: bold;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="password"] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      font-size: 16px;
    }

    .footer-heading {
      color: white;
    }

    .footer-left,
    .footer-right,
    .footer-middle {
      text-align: center;
    }

    .icons {
      margin-left: -30px;
    }

    .footer-links i {
      font-size: 30px;
      width: 40px;
      height: 40px;
      padding: 5px;
      margin-top: 30px;
    }

    .footer-middle a i:hover {
      background-color: white;
      border-radius: 50px;
      color: red;
    }

    .footer-middle-list-item {
      list-style: none;
      font-size: 15px;
      font-family: cursive;
      margin: 5px 0px 0px 15px;
      text-align: left;
    }

    .footer-middle-list-item a {
      text-decoration: none;
      color: white;
    }

    .footer-middle-list-item a:hover {
      color: red;
    }

    .footer-right {
      margin-top: -15px;
    }

    .footer-contact-button {
      font-size: 20px;
      background-color: red;
      color: black;
      padding: 10px;
      border: none;
      border-radius: 10px;
      text-decoration: none;
    }

    .footer-contact-button:hover {
      background-color: white;
      color: red;
    }

    .footer-bottom-tagline {
      color: white;
      font-size: 15px;
      font-family: cursive;
      margin-bottom: 25px;
    }


    .footer-copyright {
      text-align: center;
      color: white;
      margin-top: 20px;
      font-size: 18px;
    }

    .footer-hr {
      color: grey;
      font-weight: bold;
    }

    /***************** Media Queries *********************/

    @media (max-width: 600px) {
      .footer-content {
        display: block;
        text-align: center;
      }

      .footer-middle-list-item {
        text-align: center;
        margin-left: -20px;
      }

      .footer-left,
      .footer-middle,
      .footer-right {
        margin-top: 50px;
      }
    }

    #header-nav .nav-link {
      color: white;
      font-size: 20px;
      margin-left: 20px;
    }

    @media only screen and (max-width: 1400px) {
      #header-nav .nav-link {
        color: white;
        font-size: 18px;
        margin-left: 18px;
      }
    }

    @media only screen and (min-width: 1133px) and (max-width: 1275px) {
      #header-nav .nav-link {
        color: white;
        font-size: 15px;
        margin-left: 10px;
      }
    }

    @media only screen and (min-width: 1035px) and (max-width: 1132px) {
      #header-nav .nav-link {
        color: white;
        font-size: 15px;
        margin-left: 10px;
      }

      #searchText {
        width: 120px;
      }

      #submitBtn {
        width: 60px;
        display: flex;
        justify-content: center;
      }
    }

    @media only screen and (min-width: 993px) and (max-width: 1034px) {
      #header-nav .nav-link {
        color: white;
        font-size: 14px;
        margin-left: 10px;
      }

      #searchText {
        width: 100px;
      }

      #submitBtn {
        width: 50px;
        display: flex;
        justify-content: center;
      }
    }
  </style>


</head>

<body>
  <!-- Notifikasi -->
  <div id="notification" name="notification" class="alert" style="display: none;"></div>

  <!-- navbar starts -->

  <div class="scroll-bar">

    <nav class="navbar navbar-expand-lg navbar-light bg-dark" id="header-nav">
      <div class="container-fluid">
        <a class="navbar-brand" href="home.php"><img class="logo" src="../Images/Logo/Tittle.png" alt="" width="30" height="24"></a>
        <button id="nav" class="navbar-toggler" id="nav" style="background-color:#8b0000" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon" style="background-color:dark-grey;"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item ">
              <a class="nav-link active s" aria-current="page" href="home.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='white'">Home</a>
              <li class="nav-item">
                <a class="nav-link" href="rating.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='white'">Rating</a>
              </li>

            <li class="nav-item">
              <a class="nav-link" href="premium.php" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='white'">Premium</a>
            </li>

            <li>
    <!-- Genre dropdown starts-->
    <div>
        <div class="dropdown" style="position: relative; disPlay: inline-block; padding-top: 5px; padding-left: 15px;">
            <button class="btn btn-outline-danger dropdown-toggle" type="button" id="dropdownMenuButton" style="font-size:20px;">
                Kategori
            </button>
            <div class="dropdown-content" style="color: white;">
                <?php
                // Check if the user is logged in and get the user ID from the session
                $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

                if ($user_id !== null) {
                    // Check if the user has a subscription
                    $query_subscription = mysqli_query($conn, "SELECT type_subscription FROM tbl_subscription WHERE id_user = $user_id");
                    
                    // Check if the query was successful and returned a result
                    if ($query_subscription) {
                        $subscription = mysqli_fetch_assoc($query_subscription);

                        // Fetch and display categories
                        $query_kategori = mysqli_query($conn, "SELECT id_kategori, nama_kategori FROM tbl_kategori");

                        while ($kategori = mysqli_fetch_array($query_kategori)) {
                            $kategori_id = $kategori['id_kategori'];
                            $kategori_nama = $kategori['nama_kategori'];

                            // Check if the category is "Premium" and the user has a subscription
                            if ($kategori_nama === 'Premium' && ($subscription === null || $subscription['type_subscription'] !== 'basic')) {
                                // Skip displaying "Premium" category if the user has a basic subscription or no subscription
                                continue;
                            }

                            // Tampilkan kategori sebagai tautan di navbar
                            echo "<a href='tampil_kategori.php?kategori_id=$kategori_id'>$kategori_nama</a>";
                        }
                    } else {
                        // Handle the case when the query fails (optional)
                        echo "<p>Error fetching subscription data.</p>";
                    }
                } else {
                    // Handle the case when the user is not logged in (optional)
                    echo "<p>Login required to access categories.</p>";
                }
                ?>
            </div>
        </div>
    </div>
    <!-- Genre dropdown ends-->
</li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- navbar ends -->

    <?php
    $edit = mysqli_query($conn, "SELECT * FROM tbl_user");
    $update = mysqli_fetch_assoc($edit);
    ?>

    <div id="editProfileModal" class="modal" style="display: none;">
      <div class="modal-content">
        <span class="close" onclick="closeModal()">&times;</span>
        <h5>Edit Profile</h5>
        <form id="editProfileForm" method="post" action="update_user.php" enctype="multipart/form-data" autocomplete="off">
          <div class="form-group">
            <label for="newProfilePicture" class="profile-button">
              <img src="<?php echo $data['foto_profile'] ?>" id="currentProfileImage" alt style="width: 60px; height: 60px; border: 1px solid white; border-radius: 30px; cursor: pointer;">
            </label>
            <input type="file" id="newProfilePicture" name="newProfilePicture" accept="image/*" style="display: none;">
          </div>
          <div class="form-group">
            <label for="newEmail">Email:</label>
            <input type="text" id="newEmail" name="newEmail" value="<?php echo $_SESSION['email'] ?>">
          </div>
          <div class="form-group">
            <label for="newUsername">Username:</label>
            <input type="text" id="newUsername" name="newUsername" value="<?php echo $_SESSION['username'] ?>">
          </div>
          <div class="form-group">
            <label for="oldPassword">Old Password:</label>
            <input type="password" id="oldPassword" name="oldPassword">
          </div>
          <div class=" form-group">
            <label for="newPassword">New Password:</label>
            <input type="password" id="newPassword" name="newPassword">
          </div>
          <div class="form-group">
            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword">
          </div>
          <button type="submit" class="btn btn-primary" name="simpan">SIMPAN</button>
        </form>
      </div>
    </div>

    <!-- Modal Invoice -->
    <div class="modal" id="invoiceModal" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title">Invoice <span id="type-plan">-</span> plan</h4>
            <button type="button" class="close" data-dismiss="modal" onclick="closeBeliSekarangModal()">&times;</button>
          </div>
          <div class="modal-body">
            <form>
              <input type="hidden" name="type" id="type_plan" value="">
              <div class="form-group">
                <label for="email">Email:</label>
                <input type="text" class="form-control" name="email" id="email" value="<?php echo $_SESSION['email'] ?>">
              </div>
              <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" id="username" value="<?php echo $_SESSION['username'] ?>">
              </div>
              <div class="form-group">
                <label for="harga">Harga:</label>
                <input type="text" class="form-control" name="harga" id="harga" readonly>
              </div>

              <button type="button" class="btn btn-primary" onclick="generateInvoice()">Pesan Sekarang</button>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="container">
      <div class="section-title">
        <h3>Fitur Premium</h3><br>
        <ul>
          <li>
            <p class="points">Dapat menonton video premium</p>
          </li>
          <li>
            <p class="points">Dapat menonton sampai akhir zaman</p>
          </li>
        </ul>
      </div>

      <!-- make table -->
      <div class="section-title">
        <h3>
          Transaction History
        </h3><br>
        <table class="table" style="background-color: #0602024f;">
          <thead>
            <tr>
              <th>ID Transaction</th>
              <th>Order ID</th>
              <th>Type Subscription</th>
              <th>Email</th>
              <th>Status</th>
              <th>User ID</th>
            </tr>
          </thead>
          <tbody>
            <?php
            foreach ($transac_data as $row) {
              echo '<tr>';
              echo '<td>' . $row['id_transaction'] . '</td>';
              echo '<td><a href="status_transaction.php?order_id=' . $row['order_id'] . '">' . $row['order_id'] . '</a></td>';
              echo '<td>' . $row['type_subscription'] . '</td>';
              echo '<td>' . $row['email'] . '</td>';
              echo '<td>' . $row['status'] . '</td>';
              echo '<td>' . $row['user_id'] . '</td>';
              echo '</tr>';
            }
            ?>
          </tbody>
        </table>
      </div>

      <?php
      if (!$subscription_data) {
      ?>
        <div class="row no-gutters justify-content-center" id="premiumcards">
          <?php
          $premium = mysqli_query($conn, "SELECT * FROM tbl_premium");

          while ($row = mysqli_fetch_assoc($premium)) :
          ?>
            <center>
              <div class="column col-lg-4 col-md-6  row__item">
                <div class="box1 featured" data-aos="fade-right">
                  <h3><?php echo $row['judul'] ?></h3>
                  <h4><?php echo 'Rp ' . number_format($row['harga'], 0, ',', '.'); ?></h4>
                  <p><?php echo $row['durasi'] ?></p>
                  <br>
                  <p>
                    <?php echo $row['deskripsi'] ?>
                  </p>
                  <h5>
                    Available on:
                  </h5>
                  <ul class="devices">
                    <li>Mobile</li>
                    <li>Computer</li>
                  </ul>
                  <br>
                  <button type="button" class="btn btn-danger" data-harga="<?php echo $row['harga']; ?>" data-type="<?php echo $row['type']; ?>">
                    Beli Sekarang
                  </button>
                </div>
              </div>
            </center>
          <?php
          endwhile;
          ?>
          </center>
        </div>
      <?php
      } else {
      ?>
        <div class="section-title">
          <h3>
            Subscription
          </h3><br>
          <p class="points">
            Your subscription will end on <span style="color: #800000; text-decoration: underline;">
              <?php echo $subscription_data['time_end']; ?>
            </span>
          </p>
        </div>
      <?php
      }
      ?>
    </div>
  </div>
  <!-- End Pricing Section -->
  <br>
  <br>
  <!-------------------------------Footer-------------------------------->
  <footer class="footer">
    <hr class="footer-hr">
    <div class="footer-content">
      <div class="footer-left">
        <a href="home.php"><img class="footer-logo" src="../Images/Logo/Tittle.png" alt="" width="30" height="24"></a>
      </div>
      <div class="footer-middle">
          <h2 class="footer-heading">Follow Us</h2>
          <ul class="footer-middle-list icons">
            <a class="footer-links" href="https://www.facebook.com/home.php" target="_blank"><i class="fab fa-facebook-f facebook" style="color:red"></i></a>
            <a class="footer-links" href="https://twitter.com/login?lang=en" target="_blank"><i class="fab fa-twitter twitter" style="color:red"></i></a>
            <a class="footer-links" href="https://www.linkedin.com/feed/" target="_blank"><i class="fab fa-linkedin linkedin" style="color:red"></i></a>
            <a class="footer-links" href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram instagram" style="color:red"></i></a>
            <a class="footer-links" href="https://github.com/" target="_blank"><i class="fab fa-github github" style="color:red"></i></a>
          </ul>
        </div>
        <div class="footer-middle">
          <h2 class="footer-heading">Services</h2>
          <ul class="footer-middle-list">
            <li class="footer-middle-list-item">Website saya bernama MageriXXI</li>
            <li class="footer-middle-list-item">yang bertema video streaming.</li>
            <li class="footer-middle-list-item">Website saya memiliki video yang </li>
            <li class="footer-middle-list-item">seru seru dan juga update, jadi </li>
            <li class="footer-middle-list-item">penonton juga dapat menonton video </li>
            <li class="footer-middle-list-item">yang kalian inginkan. </li>
          </ul>
        </div>

    </div>
    <hr class="footer-hr">
    <div class="footer-copyright">
      <p>Copyright &copy; and &reg; Since
        <script>
          document.write(new Date().getFullYear())
        </script> Under MagerinXXI.com
      </p>
    </div>
  </footer>

  <!-- footer scripts -->

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="http://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <script src="https://daniellaharel.com/raindrops/js/raindrops.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <script src="../js/main-min.js"></script>

  <script>
    jQuery('#waterdrop').raindrops({
      color: '#292c2f',
      canvasHeight: 150,
      density: 0.1,
      frequency: 20
    });
  </script>
  <!-- bootsstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous"></script>
  <script src="../static/script.js"></script>

  <!-- Mitrans Snap -->
  <script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="<?php echo Config::$clientKey; ?>"></script>

  <!-- edit profile -->
  <script>
    // Function untuk membuka modal
    function openEditProfileModal() {
      var modal = document.getElementById("editProfileModal");
      modal.style.display = "block";
    }

    // Function untuk menutup modal
    function closeModal() {
      var modal = document.getElementById("editProfileModal");
      modal.style.display = "none";
    }

    // Event listener untuk membuka modal saat "Edit Profile" diklik
    var editProfileLink = document.getElementById("editProfileDropdown");
    editProfileLink.addEventListener("click", openEditProfileModal);

    // Event listener untuk menutup modal saat tombol "Close" di modal diklik
    var closeModalButton = document.querySelector(".close");
    closeModalButton.addEventListener("click", closeModal);

    // Function untuk mengganti gambar profil saat gambar yang baru dipilih
    document.getElementById("newProfilePicture").addEventListener("change", function() {
      var input = this;
      var image = document.getElementById("currentProfileImage");
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
          image.src = e.target.result;
        };
        reader.readAsDataURL(input.files[0]);
      }
    });
  </script>

  <!-- Additional script for Beli Sekarang button -->
  <script>
    // Function untuk membuka modal Beli Sekarang
    function openBeliSekarangModal() {
      var modal = document.getElementById("invoiceModal");
      modal.style.display = "block";
    }

    // Function untuk menutup modal Beli Sekarang
    function closeBeliSekarangModal() {
      var modal = document.getElementById("invoiceModal");
      modal.style.display = "none";
    }

    function generateInvoice() {
      var email = document.getElementById("email").value;
      var username = document.getElementById("username").value;
      var harga = document.getElementById("harga").value;
      var type = document.getElementById("type_plan").value;

      console.log(email, username, harga, type);

      fetch("proses_invoice.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/x-www-form-urlencoded",
          },
          body: "email=" + encodeURIComponent(email) + "&username=" + encodeURIComponent(username) + "&harga=" + encodeURIComponent(harga) + "&type=" + encodeURIComponent(type),
        })
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.text();
        })
        .then(data => {
          snap.pay(data, {
            // Optional
            onSuccess: function(result) {
              window.location.href = "status_transaction.php?notification=success" + "&order_id=" + result.order_id;
            },
            // Optional
            onPending: function(result) {
              window.location.href = "status_transaction.php?notification=pending" + "&order_id=" + result.order_id;
            },
            // Optional
            onError: function(result) {
              window.location.href = "status_transaction.php?notification=error" + "&order_id=" + result.order_id;
            }
          });
        })
        .catch(error => {
          // Handle errors during the fetch
          console.error('Fetch error:', error);
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
      var btns = document.getElementsByClassName('btn-danger');

      Array.from(btns).forEach(function(btn) {
        btn.addEventListener('click', function() {
          var harga = this.getAttribute('data-harga');
          var type = this.getAttribute('data-type');
          document.getElementById("harga").value = harga;
          document.getElementById("type-plan").innerHTML = type;
          document.getElementById("type_plan").value = type;

          // Your adapted script to open the Beli Sekarang modal
          openBeliSekarangModal();
        });
      });
    });
  </script>

  <!-- JavaScript untuk menampilkan pesan notifikasi -->
  <script>
    function showNotification(notification) {
      const notificationElement = document.getElementById("notification");
      notificationElement.innerHTML = notification;
      notificationElement.style.display = "block";

      setTimeout(function() {
        notificationElement.style.display = "none";
      }, 2000); // Pesan notifikasi akan hilang setelah 5 detik (5000 milidetik)
    }

    // Ambil pesan notifikasi dari URL (jika ada)
    const urlParams = new URLSearchParams(window.location.search);
    const notification = urlParams.get("notification");
    if (notification) {
      showNotification(notification);
    }
  </script>

</body>

</html>