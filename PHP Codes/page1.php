<?php
session_start();
if (!isset($_SESSION["sess_user"])) {
    header("location:userlogin.php");
} else {
?>
    <!doctype html>

    <html>

    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <title>Welcome</title>
        <style>
            body {
                background-image: url("hello.jpg");
                margin-top: 30px;
                margin-bottom: 100px;
                margin-right: 150px;
                margin-left: 80px;
                background-size: 100%;
                background-attachment: fixed;
                color: #261A15;
                font-family: 'Yantramanav', sans-serif;
                font-size: 100%;
                overflow: hidden;

            }



            h2 {
                color: rgb(1, 50, 67);
                font-family: verdana;
                font-size: 100%;
            }

            a {
                color: rgb(102, 51, 153);
            }

            .custom-card {
                background-color: black;
                color: white;
                opacity: 0.7;
            }
        </style>
        <link rel="stylesheet" type="text/css" href="page.css">
    </head>

    <body>
        <h3 class="fs-2 text-center text-bold text-dark">AIRLINE RESERVATION SYSTEM</h3>
        <br>
        <p class="text-bold" class="fs-3"> Thank you.. Successfully Logged In..</p>


        <h2>Welcome, <?php echo $_SESSION["sess_user"]; ?></h2><br>
        <div class="right">
        </div>


        <form method="POST" action="">

            <div class="card custom-card">
                <div class="card-body">


                    <div class="text-center">
                        <div class="form-outline">
                            <b>Depart On:</b>
                            <input type="date" class="form-control w-50 mx-auto" name="depdate" value="Today" required="required"><br>

                            <div class="row justify-content-center">

                                <div class="col-lg-5 col-xl-5">
                                    <b>From: </b>
                                    <div class="input-group">
                                        <input type="text" class="form-control w-50 mx-auto" name="from1" required="required">
                                    </div>
                                </div>
                                <div class="col-lg-2 col-xl-2"></div>
                                <div class="col-lg-5 col-xl-5">
                                    <b>To:</b>
                                    <div class="input-group">
                                        <input type="text" class="form-control w-50 mx-auto" name="to1" required="required">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <input type="submit" value="Proceed" name="proceed" class="btn btn-primary text-light" style="font-weight: bold;" />
                    </div>

                </div>
            </div>



            </div>
            <?php

            if (isset($_POST["proceed"])) {
                if (!empty($_POST['from1']) && !empty($_POST['to1']) && !empty($_POST['depdate'])) {
                    $from = $_POST['from1'];
                    $to = $_POST['to1'];
                    $depdate = $_POST['depdate'];

                    //$var = '20/04/2012';
                    $date = str_replace('/', '-', $depdate);
                    $depdate = date('Y-m-d', strtotime($date));

                    $con = @mysqli_connect('localhost', 'root', '@pes1234', 'Airline');
                    $user = $_SESSION["sess_user"];
                    $today = strtotime('today');
                    $date_timestamp = strtotime($depdate);

                    if ($date_timestamp < $today) {
            ?>
                        <script>
                            window.alert('Enter Valid Date!!..');
                            window.history.back();
                        </script>
                        <?php
                    } else {

                        if ($from == $to) {
                        ?>
                            <script>
                                window.alert('Pickup and Destination cannot be same');
                                window.history.back();
                            </script>
        <?php
                        } else {
                            //$sql="INSERT INTO airport(pick,dest,depdate,airportid) VALUES('$from','$to','$depdate','')";  

                            if (mysqli_connect('localhost', 'root', '@pes1234', 'Airline')) {
                                //$last_id = mysqli_insert_id($con);
                                $_SESSION['sess_depdate'] = $depdate;
                                $_SESSION['sess_user'] = $user;
                                $_SESSION['sess_from'] = $from;
                                $_SESSION['sess_to'] = $to;

                                header("Location: page2.php");
                            } else {
                                echo "Error: " . $sql . "<br>" . mysqli_error($con);
                            }
                            mysqli_close($con);
                        }
                    }
                } else {

                    echo " <script>
                                window.alert('Please fill all the fields'); 
                            </script>";
                }
            }
        }
        ?>
        </div>
        </div>

        </form><br><br>
        <div class="d-flex justify-content-between">
            <div>
                <a href="view1.php" class="btn btn-primary">View Bookings</a>
            </div>
            <div>
                <a href="logout1.php" class="btn btn-danger">Logout</a>
            </div>
        </div>
    </body>

    </html>