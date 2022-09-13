<?php

include_once 'includes/function.php';
include_once 'includes/session.php';
include_once 'config/db.php';

if (isset($_POST['booking'])) {

  $type =  ($_POST['ambulance_type']);
  $date_of_departing = mysqli_real_escape_string($con, trim($_POST['date_of_departing']));
  $source_address = mysqli_real_escape_string($con, trim($_POST['source_address']));
  $destination_address = mysqli_real_escape_string($con, trim($_POST['destination_address']));
  $name = mysqli_real_escape_string($con, trim($_POST['customer_name']));
  $phone = mysqli_real_escape_string($con, trim($_POST['contact_number']));


  $sql = "INSERT INTO `booking`(`ambulance_type`, `Departing_date`, `source`, `destination`, `name`, `phone`) VALUES ('$type','$date_of_departing','$source_address','$destination_address','$name','$phone')";

  if ($con->query($sql) == true) {
    redirect('booking.php', 'We received your message. We will contact you as soon as possiable. Typically replies within 5 minutes');
  } else {
    echo "Error: " . $sql . "<br>" . $con->error;
  }
}


?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
  <link rel="stylesheet" href="style.css" />
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
      <?php include_once('includes/msg.php') ?>
      <div class="row">
        <div class="col-2"></div>
        <div class="col-8">
          <div class="text-center my-3">
            <h3>Fill the booking form</h3>
          </div>
          <form method="POST" action="booking.php">
            <label for="ambulance-type" class="form-lable">Ambulance Type</label>
            <select class="form-select" name="ambulance_type" id="ambulance_type">
              <option value="AC" selected>AC Ambulance</option>
              <option value="Non AC">Non AC Ambulance</option>
              <option value="Frezing">Frezing Ambulance</option>
              <option value="ICU ">ICU Ambulance</option>
              <option value="HDU">HDU Ambulance</option>
              <option value="Air">Air Ambulance</option>

            </select>

            <label for="date" class="form-lable">Departing Date</label>
            <input type="text" class="form-control" name="date_of_departing" id="date" placeholder="DD/MM/YYYY" required />
            <label for="source_address" class="form-lable">From</label>
            <input type="text" class="form-control" name="source_address" id="address" required placeholder="e.g. Dhanmondi" />
            <label for="destination_address" class="form-lable">To</label>
            <input type="text" class="form-control" name="destination_address" id="address" required placeholder="e.g. Noakhali" />
            <label for="customer-name" class="form-lable">Your Name</label>
            <input type="text" class="form-control" name="customer_name" id="customer_name" required placeholder="e.g. Maria" />

            <label for="contact_number" class="form-lable">Contact Number:</label>
            <input type="tel" class="form-control" name="contact_number" id="phone" required placeholder="e.g 01555566677" />

            <div class="text-center mt-4">

              <button type="submit" name="booking" class="btn btn-primary mb-3">
                Send Message
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>

  <footer>
    <div class="footer-container">
      <p>Copyright&copy; 2022</p>
    </div>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>

</html>