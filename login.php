<?php
/**
* NIM : 2257401048
* Nama : Saefullah
* Kelas : MI22B
*/
session_start();

include('config.php');  

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Escape input to prevent SQL Injection
  $username = mysqli_real_escape_string($conn, $username);
  $password = mysqli_real_escape_string($conn, $password);

  // Query untuk mengecek username dan password
  $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  $result = mysqli_query($conn, $sql);

  // Debugging: Cek apakah query berhasil
  if (!$result) {
      die("Query failed: " . mysqli_error($conn));
  }

  // Debugging: Cek hasil query
  if (mysqli_num_rows($result) == 1) {
      $_SESSION['username'] = $username;
      header("Location: admin.php");
      exit();
  } else {
      // Debugging: Menampilkan pesan jika username/password salah
      echo "Username / Password tidak sesuai";
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<section class="vh-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card text-white" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <div class="mb-md-5 mt-md-4 pb-5">
              <h2 class="fw-bold mb-2 text-uppercase">Login</h2>
              <p class="text-white-50 mb-5">Please enter your login and password!</p>

              <form method="POST" action="">
                <div class="form-floating mb-4">
                  <input type="text" name="username" id="typeUsername" class="form-control form-control-lg" placeholder="Username" required />
                  <label for="typeUsername">Username</label>
                </div>

                <div class="form-floating mb-4">
                  <input type="password" name="password" id="typePassword" class="form-control form-control-lg" placeholder="Password" required />
                  <label for="typePassword">Password</label>
                </div>

                <p class="small mb-5 pb-lg-2"><a class="text-white-50" href="#!">Forgot password?</a></p>

                <button class="btn btn-outline-light btn-lg px-5" type="submit">Login</button>
                <?php if (isset($error)) { echo "<p style='color:red;'>$error</p>"; } ?>
              </form>

              <div class="d-flex justify-content-center text-center mt-4 pt-1">
                <a href="#!" class="text-white"><i class="fab fa-facebook-f fa-lg"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-twitter fa-lg mx-4 px-2"></i></a>
                <a href="#!" class="text-white"><i class="fab fa-google fa-lg"></i></a>
              </div>

            </div>

            <div>
              <p class="mb-0">Don't have an account? <a href="#!" class="text-white-50 fw-bold">Sign Up</a></p>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>
</section>
</body>
</html>
