<?php
include_once 'includes/function.php';
include_once 'includes/session.php';
include_once 'config/db.php';
guard('admin.php', 'You must login first');
// echo (getUserSession('password'));


if (isset($_POST['edit_admin'])) {

    $current_password = md5(trim($_POST['current_password']));
    $new_password = (trim($_POST['new_password']));
    $new_password_repeat = (trim($_POST['new_password_repeat']));

    if ($new_password != NULL) {
        $new_password = md5(trim($_POST['new_password']));
        $new_password_repeat =  md5(trim($_POST['new_password_repeat']));
    }


    if ($current_password == (getUserSession('password'))) {

        if ($new_password == NULL && $new_password == NULL) {

            $name =  mysqli_real_escape_string($con, trim($_POST['admin_name']));
            $email =  mysqli_real_escape_string($con, trim($_POST['email']));
            $phone =  mysqli_real_escape_string($con, trim($_POST['phone']));
            $username =  mysqli_real_escape_string($con, trim($_POST['user_name']));


            $sql = "UPDATE `admin` SET `name`='$name', `email` = '$email', `phone` = '$phone', `username` = '$username'";

            if ($con->query($sql) == true) {
                $sql = "SELECT * FROM `admin`";
                $result = $con->query($sql);
                $_SESSION['user']  = $result->fetch_assoc();
                redirect('admin_profile.php', 'Information Successfullay Updated.');
            } else {
                echo "Error: " . $sql . "<br>" . $con->error;
            }
        } else if ($new_password == $new_password_repeat) {

            $name =  mysqli_real_escape_string($con, trim($_POST['admin_name']));
            $email =  mysqli_real_escape_string($con, trim($_POST['email']));
            $phone =  mysqli_real_escape_string($con, trim($_POST['phone']));
            $username =  mysqli_real_escape_string($con, trim($_POST['user_name']));


            $sql = "UPDATE `admin` SET `name`='$name', `email` = '$email', `phone` = '$phone', `username` = '$username', `password` = '$new_password'";

            if ($con->query($sql) == true) {
                $sql = "SELECT * FROM `admin`";
                $result = $con->query($sql);
                $_SESSION['user']  = $result->fetch_assoc();
                redirect('admin_profile.php', 'Information Successfullay Updated.');
            } else {
                echo "Error: " . $sql . "<br>" . $con->error;
            }
        } else if ($new_password != $new_password_repeat) {

            redirect('admin_profile.php', 'new password and repeat password not matched', 'danger');
        } else {
            redirect('admin_profile.php', 'something want wrong', 'danger');
        }
    } else if ($current_password == NULL) {
        redirect('admin_profile.php', 'Please Provide your Current Password', 'danger');
    } else {
        redirect('admin_profile.php', 'You Didn\'t Provide your Correct Password', 'danger');
    }
}




?>





<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>BD Ambulance</title>
    <link rel="stylesheet" href="style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
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
                        <li><a href="./booking_request.php">Booking</a></li>
                        <li><a href="./messages.php">Messages</a></li>
                        <li><a href="./admin_profile.php">Admin Profile</a></li>
                        <li><a href="./logout.php" class="btn btn-primary text-white">Logout</a></li>

                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="container">
            <?php include_once('./includes/msg.php') ?>

            <div>
                <img src="./image/admin.png" alt="admin-static-image" width="140px">
            </div>
            <div class="pt-2">
                <p>Name : <?php echo getUserSession('name')  ?></p>
                <p>Email : <?php echo getUserSession('email')  ?></p>
                <p>Phone : <?php echo getUserSession('phone')  ?></p>
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Edit Info and Password
                </button>

            </div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Info</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="admin_profile.php" method="POST">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" require name="admin_name" class="form-control" id="name" value="<?php echo getUserSession('name') ?>">
                                <label for="email"  class="form-label">E-mail Address</label>
                                <input type="email" require name='email' class="form-control" id="name" value="<?php echo getUserSession('email') ?>">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="phone" require name='phone' class="form-control" id="name" value="<?php echo getUserSession('phone') ?>">

                                <label for="username" class="form-label">Username</label>
                                <input type="text" require name="user_name" class="form-control" id="username" value="<?php echo getUserSession('username') ?>">

                                <label for="New Password" class="form-label">New Password</label>
                                <input type="password" name="new_password" class="form-control" id="New Password" placeholder="If want to change">
                                <label for="New Password" class="form-label">Repeat New Password</label>
                                <input type="password" name="new_password_repeat" class="form-control" id="New Password" placeholder="Repeat new Password">
                                <label for="password" class="form-label" >Your Current Password</label>
                                <input type="password" class="form-control" name="current_password" id="password" placeholder="Enter your current password to save change">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" value="Save Changes" class="btn btn-primary" name="edit_admin">
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
    <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable({
                order: [
                    [0, 'asc']
                ],
            });
        });
    </script>

    <script>
        deletes = document.getElementsByClassName('delete');
        Array.from(deletes).forEach((element) => {
            element.addEventListener("click", (e) => {
                console.log("edit ");
                let delId = e.target.id;
                console.log(delId)

                if (confirm("Are you sure you want to delete this note!")) {
                    console.log("yes");
                    window.location = `booking_request.php?delete=${delId}`;

                } else {
                    console.log("no");
                }
            })
        })
    </script>


</body>

</html>