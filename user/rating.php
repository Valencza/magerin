<?php
include '../config/koneksi.php';
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

// Rest of your code remains unchanged
$username = $_SESSION['username'];
$profil = mysqli_query($conn, "SELECT * FROM tbl_user WHERE username ='$username'");

$data = mysqli_fetch_assoc($profil);

if (isset($_SESSION['username']) && $_SESSION['level'] == 'user') {
} else {
  echo '<script>alert("Anda harus login / jadi terlebih dahulu untuk mengakses halaman ini.");</script>';
  echo '<script>window.location.href = "../login.php";</script>';
  
  
exit;
}

if (isset($_SESSION['notification'])) {
  echo $_SESSION['notification'];
  unset($_SESSION['notification']); // Clear the notification message
}

// get all user notifications
$query_notifikasi = mysqli_query($conn, "SELECT * FROM tbl_notifikasi WHERE id_user = " . $_SESSION['user_id'] . " ORDER BY id DESC");
$query_notifikasi_data = mysqli_fetch_all($query_notifikasi, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>


  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MagerinXXI</title>

  <!-- Font  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400&display=swap" rel="stylesheet">

  <link rel="shortcut icon" href="../Images/Logo/Title.jpeg" type="image/x-icon">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="webStyle.css">

  <!------------------------Scroll to top button------------------------------------------------>
  <style>
    #scrollToTopButton {
      position: fixed;
      bottom: 40px;
      right: 25px;
      font-size: 25px;
      z-index: 99;
      width: 50px;
      height: 50px;
      background-color: red;
      color: black;
      border: none;
      cursor: pointer;
      outline: none;
      padding: 6px;
      border-radius: 50%;
    }

    #scrollToTopButton:hover,
    i:hover {
      background-color: white;
      color: red;
    }

    #nav:hover {
      background-color: #e60e23 !important;

    }

    .carousel-inner {
      cursor: pointer;
    }

    .nav-item :hover {
      margin-bottom: 10px;
      /* background-color: aquamarine; */
      border-bottom: 3px;
      border-color: red;
      border-bottom-style: solid;
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

    .navbar-nav {
      display: flex;
      align-items: center;
      padding: 0px 7.5px;
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
    margin-left: 600px;
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
      padding: 5px;
      height: 40px;
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

    /* .footer-right a:hover{transform:scale(1.1); -webkit-transform:scale(1.1);} */

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

    #waterdrop {
      height: 30px;
    }

    #waterdrop canvas {
      bottom: -70px !important;
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

    @media only screen and (max-width: 531px) {
      .poster {
        margin: 50px auto !important;
        width: 230px !important;
      }
    }

    .poster {
      margin: 50px 20px;
    }
  </style>


</head>

<body style="background-color:black;" color="height:auto;">

  <!-- Notifikasi -->
  <div id="notification" name="notification" class="alert" style="display: none;"></div>

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
              <a class="nav-link" href="#" onMouseOver="this.style.color='red'" onMouseOut="this.style.color='white'">Rating</a>
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

          <li class="dropdown" style="
              position: relative; 
              display: inline-block;
              margin-left: 200px; 
              padding-top: 15px; 
              padding-left: 15px; 
              cursor: pointer;
              margin-bottom: 15px;
              ">
            <a class="rounded-circle mb-3" id="profileDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="<?php echo $data['foto_profile'] ?>" alt style="width: 50px; height: 50px; border: 1px solid white; border-radius: 30px; margin-left: 700px;" />
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
              <a class="dropdown-item" id="editProfileDropdown"">
                  <i class=" fas fa-user-edit me-2"></i> Edit Profile
              </a>
              <hr>
              <a class="dropdown-item" href="../logout_user/logout.php">
                <i class="fas fa-sign-out-alt me-2"></i> Logout
              </a>
            </div>
          </li>

        </ul>
        <form id="searchForm" class="d-flex" method="get" action="search.php" onsubmit="handleSearch(); return false;" autocomplete="off">
            <input class="form-control me-3" type="text" id="searchText" name="searchText" placeholder="Search" aria-label="Search" style="width: 220px;">
            <button class="btn btn-danger" type="submit">Search</button>
        </form>
    </div>
  </nav>
      <!-- navbar ends -->

       <!-- MODAL EDIT PROFILE -->
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

      <div class="main-content">

        <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
          <div class="carousel-inner">
            <div class="carousel-item active">
              <img src="../image/action/the-flash.jpg" height="400" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="../image/action/first-hitman.jpg" height="400" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="../image/horror/MyCandy.jpg" height="400" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="../image/romance/theoutlaws.jpg" height="400" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
              <img src="../Images/ckd.jpg" height="400" class="d-block w-100" alt="...">
            </div>
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
          </a>
        </div>

      </div>

      <?php
        // Query database untuk mengambil ID kategori "Populer" jika ada
        $query_populer_kategori = mysqli_query($conn, "SELECT kategori.id_kategori FROM tbl_kategori kategori
        JOIN tbl_video video ON kategori.id_kategori = video.id_kategori
        WHERE kategori.nama_kategori = 'populer'
        ORDER BY video.id_video DESC LIMIT 8");
        $populer_kategori = mysqli_fetch_assoc($query_populer_kategori);

        $nama_kategori = "Populer";

        ?>

      <div class="row poster">
        <div class="container">
          <div id="movies" class="row"></div>
        </div>
        <hr>
        <div class="row">
          <h3 class="section-title text-center"><?= $nama_kategori ?></h3>
        </div>

        <?php
          $populer_kategori_id = 7;

          $query_view = mysqli_query($conn, "SELECT * FROM tbl_video WHERE id_kategori = $populer_kategori_id");

          while ($populer = mysqli_fetch_assoc($query_view)) :
          ?>

        <div class="col-3">
          <div class="card movie_card">
            <img src="../img/poster/<?php echo $populer['image_video'];?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title"><?php echo $populer['judul'];?></h5>
              <span class="movie_info_rating"><i class="fas fa-star"></i>IMDb <?php echo $populer['rating'];?> / 10</span>
            </div>
          </div>
        </div>
        <?php
        endwhile;
        ?>
      </div>


      <?php
        // Query database untuk mengambil ID kategori "Populer" jika ada
        $query_populer_kategori = mysqli_query($conn, "SELECT kategori.id_kategori FROM tbl_kategori kategori
        JOIN tbl_video video ON kategori.id_kategori = video.id_kategori
        WHERE kategori.nama_kategori = 'action'
        ORDER BY video.id_video DESC LIMIT 8");
        $populer_kategori = mysqli_fetch_assoc($query_populer_kategori);

        $nama_kategori = "Action";

        ?>

      <div class="row poster">
        <div class="container">
          <div id="movies" class="row"></div>
        </div>
        <hr>
        <div class="row">
          <h3 class="section-title text-center"><?= $nama_kategori ?></h3>
        </div>

        <?php
          $populer_kategori_id = 8;

          $query_view = mysqli_query($conn, "SELECT * FROM tbl_video WHERE id_kategori = $populer_kategori_id");

          while ($action = mysqli_fetch_assoc($query_view)) :
          ?>

        <div class="col-3">
          <div class="card movie_card">
            <img src="../img/poster/<?php echo $action['image_video'];?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title"><?php echo $action['judul'];?></h5>
              <span class="movie_info_rating"><i class="fas fa-star"></i>IMDb <?php echo $action['rating'];?> / 10</span>
            </div>
          </div>
        </div>
        <?php
        endwhile;
        ?>
      </div>

      <?php
        // Query database untuk mengambil ID kategori "Populer" jika ada
        $query_populer_kategori = mysqli_query($conn, "SELECT kategori.id_kategori FROM tbl_kategori kategori
        JOIN tbl_video video ON kategori.id_kategori = video.id_kategori
        WHERE kategori.nama_kategori = 'horror'
        ORDER BY video.id_video DESC LIMIT 8");
        $populer_kategori = mysqli_fetch_assoc($query_populer_kategori);

        $nama_kategori = "Horror";

        ?>

      <div class="row poster">
        <div class="container">
          <div id="movies" class="row"></div>
        </div>
        <hr>
        <div class="row">
          <h3 class="section-title text-center"><?= $nama_kategori ?></h3>
        </div>

        <?php
          $populer_kategori_id = 9;

          $query_view = mysqli_query($conn, "SELECT * FROM tbl_video WHERE id_kategori = $populer_kategori_id");

          while ($horror = mysqli_fetch_assoc($query_view)) :
          ?>

        <div class="col-3">
          <div class="card movie_card">
            <img src="../img/poster/<?php echo $horror['image_video'];?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title"><?php echo $horror['judul'];?></h5>
              <span class="movie_info_rating"><i class="fas fa-star"></i>IMDb <?php echo $horror['rating'];?> / 10</span>
            </div>
          </div>
        </div>
        <?php
        endwhile;
        ?>
      </div>

      <?php
        // Query database untuk mengambil ID kategori "Populer" jika ada
        $query_populer_kategori = mysqli_query($conn, "SELECT kategori.id_kategori FROM tbl_kategori kategori
        JOIN tbl_video video ON kategori.id_kategori = video.id_kategori
        WHERE kategori.nama_kategori = 'comedy'
        ORDER BY video.id_video DESC LIMIT 8");
        $populer_kategori = mysqli_fetch_assoc($query_populer_kategori);

        $nama_kategori = "Comedy";

        ?>

      <div class="row poster">
        <div class="container">
          <div id="movies" class="row"></div>
        </div>
        <hr>
        <div class="row">
          <h3 class="section-title text-center"><?= $nama_kategori ?></h3>
        </div>

        <?php
          $populer_kategori_id = 10;

          $query_view = mysqli_query($conn, "SELECT * FROM tbl_video WHERE id_kategori = $populer_kategori_id");

          while ($comedy = mysqli_fetch_assoc($query_view)) :
          ?>

        <div class="col-3">
          <div class="card movie_card">
            <img src="../img/poster/<?php echo $comedy['image_video'];?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title"><?php echo $comedy['judul'];?></h5>
              <span class="movie_info_rating"><i class="fas fa-star"></i>IMDb <?php echo $comedy['rating'];?> / 10</span>
            </div>
          </div>
        </div>
        <?php
        endwhile;
        ?>
      </div>

      
      <div class="row poster">
        <div class="container">
          <div id="movies" class="row"></div>
        </div>
        <hr>
        <div class="row">
          <h3 class="section-title text-center"><?= $nama_kategori ?></h3>
        </div>

        <?php
          $populer_kategori_id = 11;

          $query_view = mysqli_query($conn, "SELECT * FROM tbl_video WHERE id_kategori = $populer_kategori_id");

          while ($romance = mysqli_fetch_assoc($query_view)) :
          ?>

        <div class="col-3">
          <div class="card movie_card">
            <img src="../img/poster/<?php echo $romance['image_video'];?>" class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title"><?php echo $romance['judul'];?></h5>
              <span class="movie_info_rating"><i class="fas fa-star"></i>IMDb <?php echo $romance['rating'];?> / 10</span>
            </div>
          </div>
        </div>
        <?php
        endwhile;
        ?>
      </div>

          <?php
            // Query database untuk mengambil ID kategori "Populer" jika ada
            $query_populer_kategori = mysqli_query($conn, "SELECT kategori.id_kategori FROM tbl_kategori kategori
            JOIN tbl_video video ON kategori.id_kategori = video.id_kategori
            WHERE kategori.nama_kategori = 'premium'
            ORDER BY video.id_video DESC LIMIT 8");
            $populer_kategori = mysqli_fetch_assoc($query_populer_kategori);
    
            $nama_kategori = "Premium";
    
            ?>
    
          <div class="row poster">
            <div class="container">
              <div id="movies" class="row"></div>
            </div>
            <hr>
            <div class="row">
              <h3 class="section-title text-center"><?= $nama_kategori ?></h3>
            </div>
    
            <?php
              $populer_kategori_id = 13;
    
              $query_view = mysqli_query($conn, "SELECT * FROM tbl_video WHERE id_kategori = $populer_kategori_id");
    
              while ($premium = mysqli_fetch_assoc($query_view)) :
              ?>
    
            <div class="col-3">
              <div class="card movie_card">
                <img src="../img/poster/<?php echo $premium['image_video'];?>" class="card-img-top" alt="...">
                <div class="card-body">
                  <h5 class="card-title"><?php echo $premium['judul'];?></h5>
                  <span class="movie_info_rating"><i class="fas fa-star"></i>IMDb <?php echo $premium['rating'];?> / 10</span>
                </div>
              </div>
            </div>
            <?php
            endwhile;
            ?>
          </div>
  </div>

  <!-------------------------------Footer-------------------------------->
  <footer class="footer">
    <hr class="footer-hr">
    <div class="footer-content">
      <div class="footer-left">
        <a href="home.php"><img class="footer-logo" src="../Images/Logo/Tittle.png" alt="" width="30" height="24"></a>
        <p class="footer-bottom-tagline">MagerinXXI</p>
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

  <!----------------------scroll back to top button-->
  <button id="scrollToTopButton" title="Go to top" class="ml-5">
    <i class="fa fa-angle-double-up" aria-hidden="true"></i>
  </button>
  <script>
    $(document).ready(function() {
      var scrollTopButton = document.getElementById("scrollToTopButton");
      window.onscroll = function() {
        scrollFunction()
      };

      function scrollFunction() {
        if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
          scrollTopButton.style.display = "block";
        } else {
          scrollTopButton.style.display = "none";
        }
      }

      $("#scrollToTopButton").click(function() {
        $('php ,body').animate({
          scrollTop: 0
        }, 800)
      });
    });
  </script>

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

    <!-- JavaScript untuk menampilkan pesan notifikasi -->
<script>
  function showNotification(notification) {
    const notificationElement = document.getElementById("notification");
    notificationElement.innerHTML = notification;
    notificationElement.style.display = "block";

    setTimeout(function () {
      notificationElement.style.display = "none";
      localStorage.removeItem("notification");
      window.history.replaceState({}, document.title, window.location.pathname);
    }, 2000);
  }

  document.addEventListener("DOMContentLoaded", function () {
    const notification = localStorage.getItem("notification");
    if (notification) {
      showNotification(notification);
    }
  });
</script>

<script>
  function handleSearch() {
    var searchText = document.getElementById("searchText").value;
    window.location.href = "search.php?searchText=" + searchText;
  }
</script>

</body>

</html>