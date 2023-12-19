<!DOCTYPE html>
<link rel="shortcut icon" href="Images/Logo/Title.jpeg" type="image/x-icon">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="static/style.css" rel="stylesheet" type="text/css" />
<php>

  <head>
    <title>Sign Up</title>

    <!-- Font  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>


    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width">
    <!------------------------Scroll to top button------------------------------------------------>
    <style>
      h1 {
        margin: auto;
        width: max-content;
        color: white;
      }

      span {
        display: inline-block;
        padding: 5px;
      }

      .img-logo {
        height: 94px;
        margin-left: 45px;
      }

      .seperator {
        height: 12px;
        display: block;
      }

      .main {
        padding: 70px;
        width: 300px;
        height: auto;
        border: 1.5px grey solid;
        border-radius: 5px;
        margin: -4.5px auto;
      }

      label {
        font-weight: bold;
        color: white;
        font-size: 1.25em;
      }

      input {
        width: 280px;
        border: none;
        border-radius: 5px;
        padding: 8px;
        outline: none;
      }

      input[type="submit"] {
        width: 260px;
        background-color: red;
        font-weight: bold;
      }

      input[type="submit"]:hover {
        cursor: pointer;
        border: 2px gray solid;
        background-color: red;
        transform: scale(0.95);
      }

      body {
        margin: 0;
        padding: 0;
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.85)), url("Images/background3.png") no-repeat center center fixed;
        -webkit-background-size: cover;
        -moz-background-size: cover;
        -o-background-size: cover;
        background-size: cover;
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;

      }

      .brand {
        margin-bottom: 13px;
        color: red;
        padding-top: 15px;
      }

      #errormessage {
        display: flex;
        justify-content: center;
        border-radius: 12px;
      }

      p {
        display: inline-flex;
        font-size: 1em;
        align-items: center;
        background: rgb(220, 53, 69);
        padding: 0.5em;
        color: white;
        font-family: sans-serif;
      }

      p svg {
        width: 2em;
        height: 2em;
        margin-right: 0.5em;
        fill: lightgreen;
      }

      .login {
        margin: 0 auto;
        width: 400px;
        background-color: rgba(0, 0, 0, 0.6);
        border-radius: 5px;
        padding: 30px 70px 50px 70px;
        margin-bottom: 12px;
      }

      .login h1 {
        color: white;
        padding-bottom: 10px;
      }

      /* Custom styles for the file input */
      .file-input-container {
        position: relative;
      }

      .custom-file-input {
        display: none;
        width: 260px;
        /* Sesuaikan panjang dengan input username dan password */
        padding: 10px;
        /* Sesuaikan padding dengan input username dan password */

      }

      .custom-file-label {
        background-color: #333;
        /* Sesuaikan warna latar belakang dengan warna font input username dan password */
        color: white;
        /* Sesuaikan warna font dengan warna font input username dan password */

        border-radius: 5px;
        /* Rounded corners */
        padding: 10px;
        /* Spacing around the label text */
        cursor: pointer;
        width: 260px;
        /* Sesuaikan panjang dengan input username dan password */
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        /* Sesuaikan jenis font dengan input username dan password */
        transition: background-color 0.3s, color 0.3s;
        /* Animasi transisi warna latar belakang dan font */
      }

      .custom-file-label:hover {
        background-color: #808080;
        /* Background color when hovered */
      }

      /* Style for the file input label text */
      .custom-file-label::after {
        content: 'Choose a file';
        /* Initial label text */
        width: 260px;
        /* Sesuaikan panjang dengan input username dan password */
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        /* Sesuaikan jenis font dengan input username dan password */
      }

      /* Additional styling for the file input label when a file is selected */
      .custom-file-input:valid+.custom-file-label::after {
        content: attr(data-file-name);
        /* Display the selected file name */
        width: 260px;
        /* Sesuaikan panjang dengan input username dan password */
        font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif;
        /* Sesuaikan jenis font dengan input username dan password */
      }

      /* Style for the file input label icon (optional) */
      .custom-file-label::before {
        content: "\f07c";
        /* Font Awesome icon for file */
        font-family: FontAwesome;
        font-size: 17px;
        padding-right: 10px;
        color: #fff;
      }


      .bottom {
        background-color: rgba(0, 0, 0, 0.35);
        color: #bdc7c9;
        padding-bottom: 40px;
        padding-top: 0px;

      }

      .bottom-width {
        max-width: 1000px;
        padding: 8px 30px;
      }

      .bottom-flex {
        display: flex;
        flex-wrap: wrap;
        padding: 15px 0 0 0;
        justify-content: center;

      }

      .bottom-flex li a {
        font-size: 15px;
      }

      .bottom-flex li {
        list-style: none;
        margin: 0px 10px;
      }

      .list-bottom {
        /* width: 25%; */
        margin-top: 10px;
      }

      .link-bottom {
        text-decoration: none;
        color: #bdc7c9;
        font-size: 0.8rem;
      }

      .link-bottom:hover {
        text-decoration: underline;

      }

      .remember-flex {
        display: flex;
        justify-content: space-between;
        margin-top: 10px;
        font-size: 0.8rem;
      }

      .color_text {
        color: #bdc7c9;
      }

      .color_link {
        color: #bdc7c9;
      }

      .signup-link {
        color: white;
        text-decoration: none;
      }



      .signup-link:hover {
        text-decoration: underline;
      }

      .face_icon {
        color: #3b5998;
        margin-right: 6px;
        font-size: 20px;
      }

      .log_face {
        text-decoration: none;
        margin-left: 10px;
        font-size: 0.8rem;
      }

      .login-face {
        margin: 50px 0 15px 0;
        vertical-align: middle;
        color: #bdc7c9;
      }

      .new-members {
        margin-bottom: 10px;
        color: #bdc7c9;
      }

      .help a {
        text-decoration: none;
      }

      .help a:hover {
        text-decoration: underline;
      }

      .protection {
        font-size: 0.8rem;
        color: #bdc7c9;
      }

      .protection a {
        text-decoration: none;
      }

      .protection a:hover {
        text-decoration: underline;
      }

      .tel-link {
        text-decoration: none;
        color: #e1e5ea;
      }

      .tel-link:hover {
        text-decoration: underline;
      }

      .input-text {
        margin-bottom: 20px;
      }

      .input-text input {
        width: 100%;
        height: 45px;
        background-color: #333;
        color: white;
        border-radius: 5px;
        border: none;
        outline: transparent;
        text-indent: 18px;
      }

      .input-text input::-webkit-input-placeholder {
        font-size: 1rem;
        color: #bdc7c9;
      }

      .input-text input::-moz-placeholder {
        font-size: 1rem;
        color: #bdc7c9;
        text-indent: 40px;
      }

      .signin-button {
        margin-top: 20px;
        padding: 13px;
        border-radius: 5px;
        background-color: red;
        color: white;
        border: none;
        font-weight: bold;
        font-size: 1.05rem;
        cursor: pointer;
      }

      .field-icon {
        position: absolute;
        margin-left: -25px;
        margin-top: 15px;
        color: white;
      }

      .questions {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        justify-content: space-between;
      }

      @media only screen and (max-width: 450px) {

        .login,
        .aftersubmit {
          width: 300px;
          padding: 15px;
        }
      }

      @media only screen and (max-width: 350px) {

        .login,
        .aftersubmit {
          width: 240px;
          padding: 10px;
        }

        input[type="submit"] {
          width: 220px;
        }

        .help a {
          margin-left: 0% !important;
        }
      }
    </style>
    <link rel="shortcut icon" href="Images/logo/Tittle.png" type="image/x-icon">
  </head>

  <body>
    <div class="logo">
      <a href="home.php">
        <img src="Images/logo/Tittle.png" class="img-logo" />
      </a>
    </div>
    <div class="login-div">
      <form class="login" method="post" action="proses_regist.php" onsubmit="return DisplayResults()" name="regform" autocomplete="off" enctype="multipart/form-data">

        <h1 class="sign">Sign Up</h1>
        <div id="errormessage"></div>
        <span class="seperator"></span>

        <div class="input-text">
          <input type="text" name="username" required="" placeholder="Enter your name" />
        </div>
        <div class="input-text">
          <input id="pass_signup" type="password" name="password" required="" placeholder="Enter your password" /><i class="fa fa-fw fa-eye field-icon toggle-password" id="togglePassword"></i>
        </div>
        <div>
          <input id="level" type="hidden" name="level" value="user"> <!-- Tambahkan level ke form -->
        </div>
        <div class="input-text">
          <input id="pass_signup2" type="password" name="retypepassword" required="" placeholder="Confirm password" />
          <i class="fa fa-fw fa-eye field-icon toggle-password2" id="togglePassword2"></i>
        </div>
        <div class="file-input-container">
          <input type="file" name="foto_profile" id="foto_profile" class="custom-file-input" required="" onchange="updateFileName(this)">
          <label for="foto_profile" class="custom-file-label"></label>
        </div>

        <input class="signin-button" name="submit" type="submit" value="Sign Up" />
        <div class="remember-flex"></div>

        <div class="login-face">
          <div class="new-members">
            Entry to MagerinXXI? <a href="login.php" class="signup-link">Log in now</a>.
          </div>
        </div>
      </form>

    </div>
    <div class="bottom">
      <div class="bottom-width">
        <div class="questions">
          <span> Questions? <br>Send Message : <a href="mailto: garciavalencza@gmail.com" class="tel-link">garciavalencza@gmail.com</a></span>
        </div>
      </div>
    </div>

    <script>
      function updateFileName(input) {
        // Dapatkan label yang sesuai dengan input file
        var label = input.nextElementSibling;

        // Cek apakah pengguna telah memilih file
        if (input.files.length > 0) {
          // Ubah teks label menjadi nama file yang dipilih
          label.textContent = input.files[0].name;
        } else {
          // Jika tidak ada file yang dipilih, kembalikan teks label ke semula
          label.textContent = "Upload Your Profile";
        }
      }
    </script>

    <script>
      $(".toggle-password").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        if ($("#pass_signup").attr("type") == "password") {
          $("#pass_signup").attr("type", "text");
        } else {
          $("#pass_signup").attr("type", "password");
        }
      });
    </script>
    <script>
      $(".toggle-password2").click(function() {
        $(this).toggleClass("fa-eye fa-eye-slash");
        if ($("#pass_signup2").attr("type") == "password") {
          $("#pass_signup2").attr("type", "text");
        } else {
          $("#pass_signup2").attr("type", "password");
        }
      });
    </script>
  </body>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://smtpjs.com/v3/smtp.js"></script>

  </html>