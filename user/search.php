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

if (isset($_GET['searchText'])) {
  $searchText = mysqli_real_escape_string($conn, $_GET['searchText']);

  // Query untuk mencari video berdasarkan judul yang cocok dengan parameter pencarian
  $query_search = mysqli_query($conn, "SELECT v.*, k.nama_kategori FROM tbl_video v
      JOIN tbl_kategori k ON v.id_kategori = k.id_kategori
      WHERE v.judul LIKE '%$searchText%'");

  $search_results = mysqli_fetch_all($query_search, MYSQLI_ASSOC);
}

?>

<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>MagerinXXI</title>
  <link rel="shortcut icon" href="../Images/Logo/Tittle.png" type="image/x-icon">

  <!-- Font  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500&display=swap" rel="stylesheet">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
  <link href="../static/style.css" rel="stylesheet" type="text/css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

  <link rel="stylesheet" href="../static/bootstrap.min.css">
  <link rel="stylesheet" href="../static/style-min.css">
  <link rel="stylesheet" href="cards.css">

  <!------------------------Scroll to top button------------------------------------------------>
  <style>
    .poster {
      box-shadow: 0 0 15px red !important;

    }

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

    .navbar-nav {
      display: flex;
      align-items: center;
      padding: 0px 7.5px;
    }

    .dropdown {
      margin-bottom: 10px;
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


    .maincontainer h3 {
      color: white;
      text-align: center;
    }

    .container {
      text-align: center;
    }

    #navbarNav.nav-item.nav-link a:hover {
      color: red;
    }

    .nav-link:hover {
      color: red;
      align-items: center;
      justify-content: space;
    }

    .nav-item :hover {
      margin-bottom: 10px;
      /* background-color: aquamarine; */
      border-bottom: 3px;
      border-color: red;
      border-bottom-style: solid;
    }

    #header-nav .nav-link a:hover {
      color: red;
    }
  </style>
</head>

<body class="scroll-bar">
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
        <div class="dropdown" style="position: relative; disPlay: inline-block; padding-top: 5px; padding-left: 15px; margin-top: 10px;">
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
              ">
            <a class="rounded-circle mb-3" id="profileDropdown" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <img src="<?php echo $data['foto_profile'] ?>" alt style="width: 50px; height: 50px; border: 1px solid white; border-radius: 30px; margin-left: 40px;" />
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="profileDropdown">
              <a class="dropdown-item" id="editProfileDropdown"">
                  <i class=" fas fa-user-edit me-2"></i> Edit Profile
              </a>
              <hr>
              <a class="dropdown-item" id="notificationModal">
                <i class="fas fa-envelope me-2" style="color: #f7f9fd;"></i> Notifikasi
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
    </div>
  </nav>

  <div>

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


    <!-- Modal Notifikasi -->
    <div id="notificationButton" name="notification" class="modal" style="display: none;">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Notifikasi</h5>
            <button type="button" class="close" data-dismiss="modal" onclick="closeModal()">&times;</button>
          </div>
          <div class="modal-body">
            <ul style="list-style-type: none; padding: 0; margin: 0;">
              <?php foreach ($query_notifikasi_data as $notifikasi) : ?>
                <li style="background-color: #f0f0f0; padding: 10px; margin-bottom: 5px; border-radius: 5px; color: black;">
                  <?= $notifikasi['pesan'] ?>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>

    <div class="container" id="Movies">
    <!-- Tampilkan hasil pencarian jika parameter pencarian ada -->
    <?php if (isset($search_results)) : ?>
        <h2><?php echo htmlspecialchars($searchText); ?></h2>
        <hr>

        <?php
        // Ambil user_id dari sesi (pastikan pengguna sudah login)
        $user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

        foreach ($search_results as $row) :
            // Cek apakah video memiliki kategori premium
            $isPremiumVideo = $row['nama_kategori'] === 'Premium';

            // Cek apakah pengguna memiliki langganan premium atau video bukan premium
            if ($isPremiumVideo && $user_id !== null) {
                // Jika user belum berlangganan premium, lewati iterasi
                $query_subscription = mysqli_query($conn, "SELECT type_subscription FROM tbl_subscription WHERE id_user = $user_id");

                if ($query_subscription) {
                    $subscription = mysqli_fetch_assoc($query_subscription);

                    if ($subscription === null || $subscription['type_subscription'] !== 'basic') {
                        continue;
                    }
                } else {
                    // Handle ketika query langganan gagal (opsional)
                    echo "<p>Error fetching subscription data.</p>";
                }
            }
        ?>
            <div class="poster">
                <div class="flip-card_i">
                    <div class="flip-card-inner_i">
                        <div class="flip-card-front_i">
                            <img src="../img/poster/<?= $row['image_video'] ?>" alt="Avatar" style="width:250px;height:360px;">
                        </div>
                        <div class="flip-card-back_i">
                            <h1><?= $row['judul'] ?></h1>
                            <button class="btn_i b3_i" title="Year" style="color:white"><?= $row['tahun'] ?> </button>
                            <button class="btn_i b2_i" title="Minutes" style="color:white"><?= $row['durasi'] ?></button>
                            <button class="btn_i b1_i" title="IMDb" style="color:white"><?= $row['rating'] ?></button>
                            <br />
                            <br />
                            <p class="para_i"><?= $row['deskripsi'] ?></p>

                            <!-- Button to open the trailer on the tampil_trailer.php page -->
                            <button class="trailer_i" type="submit" value="" onclick="openTrailer(<?= $row['id_video'] ?>)">▶Trailer</button>
                            <script type="text/javascript">
                                function openTrailer(videoId) {
                                    window.location.href = "tampil_trailer.php?id_video=" + videoId;
                                }
                            </script>

                            <!-- Button Play Video -->
                            <button class="trailer_i" style="cursor: pointer;" onclick="playVideo(<?= $row['id_video'] ?>)">▶Play</button>
                            <script type="text/javascript">
                                function playVideo(videoId) {
                                    window.location.href = "tampil_video.php?id_video=" + videoId;
                                }
                            </script>
                        </div>
                    </div>
                    <div class="flim">
                        <b><?= $row['judul'] ?></b><br>IMDb - <?= $row['rating'] ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    <?php else : ?>
        <!-- Tampilkan pesan jika tidak ada hasil pencarian -->
        <h2>No results found for "<?php echo htmlspecialchars($searchText); ?>"</h2>
    <?php endif; ?>
</div>

    <div id="waterdrop"></div>

    <!-------------------------------Footer-------------------------------->
    <footer class="footer">
      <hr class="footer-hr">
      <div class="footer-content">
        <div class="footer-left">
          <a href="home.php"><img class="footer-logo" src="../Images/Logo/Tittle.png" alt="" width="30" height="24"></a>
          <div><br></div>
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

    <!-- notification modal -->
    <script>
      // Function untuk membuka modal
      function openNotificationModal() {
        var modal = document.getElementById("notificationButton");
        modal.style.display = "block";
      }

      // Function untuk menutup modal
      function closeModal() {
        var modal = document.getElementById("notificationButton");
        modal.style.display = "none";
      }

      // Event listener untuk membuka modal saat "Notifikasi" diklik
      var notificationLink = document.getElementById("notificationModal");
      notificationLink.addEventListener("click", openNotificationModal);

      // Event listener untuk menutup modal saat tombol "Close" di modal diklik
      var closeModalButton = document.querySelector(".close");
      closeModalButton.addEventListener("click", closeModal);
    </script>

    <!-- JavaScript untuk menampilkan pesan notifikasi -->
    <script>
      function showNotification(notification) {
        const notificationElement = document.getElementById("notification");
        notificationElement.innerHTML = notification;
        notificationElement.style.display = "block";

        setTimeout(function() {
          notificationElement.style.display = "none";
          localStorage.removeItem("notification");
          window.history.replaceState({}, document.title, window.location.pathname);
        }, 2000);
      }

      document.addEventListener("DOMContentLoaded", function() {
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

    <script>
      setTimeout(function() {
        $('.section').fadeToggle();
      }, 4000);
    </script>

</body>


</div>

</html>