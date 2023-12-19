<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width">
  <title>Sign In</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">

  <!-- Font  -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Ubuntu&display=swap" rel="stylesheet">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="shortcut icon" href="Images/Logo/Tittle.png" type="image/x-icon">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js" integrity="sha512-AA1Bzp5Q0K1KanKKmvN/4d3IRKVlv9PYgwFPvm32nPO6QS8yH1HO7LbgB1pgiOxPtfeg5zEn2ba64MUcqJx6CA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <link href="./static/style.css" rel="stylesheet" type="text/css" />
  <link href="./static/login.css" rel="stylesheet" type="text/css">
  <meta name="google-signin-client_id" content="556331998780-jhmmulhgm2s2fgrqqln50vmtp1fh41vc.apps.googleusercontent.com">
  <script src="https://apis.google.com/js/platform.js" async defer></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
  <div class="login-div">
    <form class="login" name="login" action="proses_login.php" role="form" method="post" autocomplete="off" ">

      <h1 class=" sign">Sign In</h1>
      <div id="errormessage"></div>
      <span class="seperator"></span>

      <div class="input-text">
        <input type="text" name="username" required="" placeholder="Enter your name" />
      </div><i class></i>

      <div class="input-text">
        <input id="pass_signup" type="password" name="password" required="" placeholder="Password" /><i class="fa fa-fw fa-eye field-icon toggle-password" id="togglePassword"></i>
      </div>

      <div class="input-text">
        <input type="hidden" name="level" value="user" required="" />
      </div><i class></i>

      <span class="seperator"></span>
      <input class="signin-button" type="submit" name="submit_login" value="Sign In" />

      <div class="login-face">
        <br>
        <div class="new-members">
          New to MagerinXXI? <a href="signup.php" class="signup-link">Sign up now</a>.
        </div>
        <br>
      </div>
    </form>
  </div>

  <div class="bottom">
    <div class="bottom-width">
      <div class="questions">
        <span>Questions? <br>Send Message : <a href="mailto: garciavalencza@gmail.com" class="tel-link">garciavalencza@gmail.com</a></span>
      </div>
    </div>
  </div>

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
</body>

</html>