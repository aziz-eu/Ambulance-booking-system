<?php
include_once 'includes/function.php';
include_once 'includes/session.php';
include_once 'config/db.php';
guard('admin.php', 'You must login first');


$sql = "SELECT * FROM contact";
$results = $con->query($sql);

if (isset($_GET['delete'])) {
    $id = $_GET['delete'];

    $sql = "DELETE FROM `contact` WHERE `id` = '$id'";

    if ($con->query($sql) == true) {
        redirect('messages.php', 'Successfullay Deleted.');
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
    <title>BD Ambulancee</title>
    <link rel="stylesheet" href="style.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" />
    <link rel="stylesheet" href="//cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
    <!-- <link rel="stylesheet" href="css/bootstrap.min.css"> -->
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
            <?php include_once './includes/msg.php' ?>
            <div class="dashboard mt-3">
                <table class="table table-striped table-dark pt-4" id="myTable">
                    <h3 class="py-3">Messages :</h3>
                    <thead>
                        <tr>
                            <th scope="col">Sl no</th>
                            <th scope="col">Name</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Email</th>
                            <th scope="col">Message</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $i = 0;
                        while ($row = $results->fetch_assoc()) :
                            $i = $i + 1;
                        ?>
                            <tr>

                                <td><?php echo $i ?></td>
                                <td><?php echo $row['name'] ?></td>
                                <td><?php echo $row['phone'] ?></td>
                                <td><?php echo $row['email'] ?></td>
                                <td><?php echo $row['message'] ?></td>
                                <td>
                                    <button class='delete btn btn-sm btn-danger' id="<?php echo $row['id'] ?>">Delete</button>
                                </td>
                            </tr>

                        <?php endwhile; ?>
                    </tbody>
                </table>

                <?php
                while ($row = $results->fetch_assoc()) {
                    // pr($row);
                    echo "<tr>";
                    echo "<td> " . $row['patient_name'] . " </td>";
                    echo "<td> " . $row['blood_group'] . " </td>";
                    echo "<td> " . $row['contact_number'] . " </td>";
                    echo "<td> " . $row['city'] . " </td>";
                    echo "</tr>";
                }

                ?>
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
                    window.location = `messages.php?delete=${delId}`;

                } else {
                    console.log("no");
                }
            })
        })
    </script>


</body>

</html>