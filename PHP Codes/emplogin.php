<!doctype html>
<html>

<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Admin Login</title>
    <style>
        body {
            background-image: url("arrow.jpg");
            margin-top: 4echo0px;
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

        h1 {
            color: red;
        }

        h3 {
            color: rgb(44, 62, 80);
            font-family: verdana;
            font-size: 100%;
        }

        a {
            color: rgb(102, 51, 153);
        }

        .custom-card {
            background-color: black;
            color: white;
            opacity: 0.8;
        }
    </style>
</head>

<body>
    <h3 class="fs-2 text-center text-bold text-dark">AIRLINE RESERVATION SYSTEM</h3>
    <div class="card custom-card mt-5">
        <div class="card-body">
            <div class="text-center justify-content-center">
                <br>
                <h3>Admin Login Form</h3>
                <form action="" method="POST">
                    <br /><b>Employee name: </b>&nbsp;<input type="text" name="empname"><br />
                    <br /><b>Password: </b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="password" name="emppass"><br /> <br>
                    <button type="submit" class="btn btn-primary" name="submit">Login</button>
            </div>
        </div>
    </div>
    </form>
    <?php
    $con = mysqli_connect("localhost", "root", "@pes1234", "Airline");
    //mysql_select_db("Practice")
    //if (isset($_POST['email']))

    if (isset($_POST['submit'])) {
        $empname = $_POST['empname'];
        $emppass = $_POST['emppass'];

        $sql = "SELECT * FROM Admin WHERE Name='" . $empname . "' AND Pswd='" . $emppass . "'";
        $query = mysqli_query($con, $sql);
        $numrows = mysqli_num_rows($query);
        if ($numrows != 0) {
            while ($row = mysqli_fetch_assoc($query)) {
                $dbename = $row['Name'];
                $dbpassword = $row['Pswd'];
            }

            if ($empname == $dbename && $emppass == $dbpassword) {
                session_start();
                $_SESSION['sess_ename'] = $empname;
                echo "<script>alert('You have registered successfully.')</script>";
                echo "<script>window.open('enter.php','_self')</script>";
                /* Redirect browser */
                // header("Location: enter.php");
            }
        } else {
            echo "<script>alert('Invalid username or password!')</script>";
        }
    }

    ?>

</body>

</html>