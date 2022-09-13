<?php
include_once 'includes/function.php';
include_once 'includes/session.php';
include_once 'config/db.php';


if (isset($_POST['loginBtn'])) {
  $username = trim($_POST['username']);
  $password = (trim($_POST['password']));



  if (login($username, $password)) {
    redirect('booking_request.php', 'You\'re logged in');
  } else {
    $_GET['msg'] = "Username or password does not match";
    $_GET['type'] = 'danger';
  }
} else {
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <title>BD Ambulance</title>
</head>

<body>
    <header>
        <nav>
            <div class="nav-center">
                <div class="logo">
                    <h2>Bangladesh Ambulance</h2>
                </div>
                <div class="navitem">
                    <ul class="navlinks">
                        <li><a href="./index.php">Home</a></li>
                        <li><a href="./services.php">Our Services</a></li>
                        <li><a href="./booking.php">Booking Ambulance</a></li>
                        <li><a href="./about.php">About us</a></li>
                        <li><a href="./contact.php">Contact us</a></li>
                        <li><a href="./faq.php">FAQs</a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <main>
        <div class="container">
            <div class="row">
                <div class="col-4"></div>
                <div class="col-4 card my-5">
                    <?php include_once('./includes/msg.php') ?>
                    <h3 class="text-center">Admin Login</h3>

                    <form action="./admin.php" method="POST">
                        <label for="username">User Name</label>
                        <input type="text" class="form-control" name="username" id="username" required placeholder="Enter Your Username">
                        <label for="password" class="form-lable">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required placeholder="Enter Your Password">
                        <div class="text-center">
                            <input type="submit" name="loginBtn" value="Login" class="btn btn-outline-primary my-4">
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </main>


    <footer>
        <div class="footer-container">
            <p>Copyright &copy;2022</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>