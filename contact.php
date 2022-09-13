<?php

include_once 'includes/function.php';
include_once 'includes/session.php';
include_once 'config/db.php';

if (isset($_POST['send_message'])) {

 
  $name = mysqli_real_escape_string($con, trim($_POST['customer_name']));
  $email = mysqli_real_escape_string($con, trim($_POST['email']));
  $phone = mysqli_real_escape_string($con, trim($_POST['contact_number']));
  $message = mysqli_real_escape_string($con, trim($_POST['message']));


  $sql = "INSERT INTO `contact`(`name`, `email`, `phone`, `message`) VALUES ('$name','$email','$phone','$message')";

  if ($con->query($sql) == true) {
    redirect('contact.php', 'Thank You. We will reply you as soon as possiable');
  } else {
    echo "Error: " . $sql . "<br>" . $con->error;
  }
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
      <?php include_once ('./includes/msg.php') ?>
      <div class="row mt-4">
        <div class="col-2"></div>
        <div class="col-8">
        <form method="POST" action="./contact.php">
        <label for="client_name" class="form-lable">Your Name:</label>
        <input type="text" class="form-control" name="customer_name" id="client_name" required placeholder="e.g. Maria">
        <label for="email" class="form-lable">E-mail:</label>
        <input type="email" class="form-control" name="email" id="email" required placeholder="e.g. maria@emaxple.com">
        <label for="phone" class="form-lable">Phone:</label>
        <input type="tel" class="form-control" name="contact_number" id="phone" required placeholder="e.g 01555566677">
        <label for="message" class="form-lable">Your Message</label>
        <textarea name="message" class="form-control" id="" cols="30" rows="8" placeholder=""></textarea>
        <div class="text-center my-3">

          <button type="submit" name="send_message" class="btn btn-primary">Send</button>
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

</body>

</html>