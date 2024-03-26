<?php
session_start();
if (!isset($_SESSION["sess_ename"])) {
    header("location: emplogin.php");
} else {
?>
    <!doctype html>
    <html>

    <head>
        <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

        <title>Welcome Employee</title>
        <style>
            body {
                background-image: url("arrow.jpg");
                margin-top: 40px;
                margin-bottom: 100px;
                margin-right: 150px;
                margin-left: 80px;
                background-size: 100%;
                background-attachment: fixed;
                color: #261A15;
                font-family: 'Yantramanav', sans-serif;
                ;
                font-size: 100%;

            }

            h3 {
                color: rgb(44, 62, 80);
                font-family: verdana;
                font-size: 110%;
            }

            h4 {
                font-size: 100%;
            }

            a {
                color: rgb(102, 51, 153);
            }

            .custom-card {
                background-color: black;
                color: white;
                opacity: 0.9;
            }
        </style>
        <link rel="stylesheet" type="text/css" href="emp.css">
    </head>

    <body>
        <h3 class="fs-2 text-center text-bold text-dark">AIRLINE RESERVATION SYSTEM</h3>
        <h4 class="text-success">Welcome</h4>
        <form action="" method=" POST">
            <div class="card custom-card">
                <div class="card-body">
                    <div class="text-center justify-content-center">
                        <h2>Enter Flight Details:</h2><br>
                        <div class="form-group w-50 m-auto">
                            <label for="fid">Flight id:</label>
                            <input type="text" class="form-control mb-3" id="fid" name="fid" required="required">
                        </div>
                        <div class="form-group w-50 m-auto">
                            <label for="planename">Plane name:</label>
                            <input type="text" class="form-control mb-3" id="planename" name="planename" required="required">
                        </div>
                        <div class="form-group w-50 m-auto">
                            <label for="from">Pickup:</label>
                            <input type="text" class="form-control mb-3" id="from" name="from" required="required">
                        </div>
                        <div class="form-group w-50 m-auto">
                            <label for="to">Destination:</label>
                            <input type="text" class="form-control mb-3" id="to" name="to" required="required">
                        </div>
                        <div class="form-group w-50 m-auto">
                            <label for="deptime">Departure Time:</label>
                            <input type="text" class="form-control mb-3" id="deptime" name="deptime" required="required">
                        </div>
                        <div class="form-group w-50 m-auto">
                            <label for="arrtime">Arrival Time:</label>
                            <input type="text" class="form-control mb-3" id="arrtime" name="arrtime" required="required">
                        </div>
                        <div class="form-group w-50 m-auto">
                            <label for="fare">Fare:</label>
                            <input type="number" class="form-control mb-3" id="fare" name="fare" required="required">
                        </div>
                        <div class="form-group w-50 m-auto">
                            <label for="depdate">Departure Date:</label>
                            <input type="text" class="form-control mb-4" id="depdate" name="depdate" required="required">
                        </div>
                        <button type="submit" class="btn btn-primary" style="color:black" name="insert">Insert flight details</button>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">

        </div>
        <div class="d-flex justify-content-between">
            <form action="view.php" method="POST">
                <div class="mt-3">
                    <button type="button" class="btn btn-primary" style="color:black" onclick="location.href='view.php';">View Booking</button>
                </div>
            </form>
            <div class="d-flex justify-content-end mt-3">
                <button class="btn btn-danger">
                    <a href="logout.php" style="color:black">Logout</a></button>
            </div>
        </div>
        </form>
    </body>

    </html>

<?php
    if (isset($_POST["insert"])) {
        if (!empty($_POST['fid']) && !empty($_POST['planename']) && !empty($_POST['from']) && !empty($_POST['to']) && !empty($_POST['deptime']) && !empty($_POST['fare']) && !empty($_POST['arrtime']) && !empty($_POST['depdate'])) {
            $fid = $_POST['fid'];
            $planename = $_POST['planename'];
            $from = $_POST['from'];
            $to = $_POST['to'];
            $deptime = $_POST['deptime'];
            $arrtime = $_POST['arrtime'];
            $fare = $_POST['fare'];
            $depdate = $_POST['depdate'];
            $con = mysqli_connect('localhost', 'root', '@pes1234', 'Airline');
            $sql_a = "SELECT * FROM Aircraft WHERE Dep_Time='$deptime' AND Flight_ID='$fid'";
            $query = mysqli_query($con, $sql_a);
            $numrows = mysqli_num_rows($query);
            echo "$numrows";
            if ($numrows == 0) {
                $sql = "INSERT INTO Aircraft(Flight_ID, Dep_Time, Arr_Time, Plane_Name, Src, Dstn, Fare, Dep_Date) VALUES('$fid', '$deptime', '$arrtime', '$planename', '$from', '$to', '$fare', '$depdate')";
                $result = mysqli_query($con, $sql);
                if ($result) {
                    echo "<script>alert('Successfully Inserted');</script>";
                } else {
                    echo "<script>alert('Insertion Failed');</script>";
                }
            } else {
                echo "<script>alert('That entry (or Pid) already exists! Please try again with another.');</script>";
            }
        } else {
            echo " <script>window.alert('Please fill all the fields');</script>";
        }
    }
}
?>