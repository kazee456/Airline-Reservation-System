<!doctype html>
<html>

<head>
    <title>Customer Register</title>
    <style>
        body {
            background-image: url("flight2.jpg");
            margin-top: 100px;
            margin-bottom: 100px;
            margin-right: 150px;
            margin-left: 80px;
            background-size: 100%;
            background-attachment: fixed;
            color: #261A15;
            font-family: 'Yantramanav', sans-serif;
            font-size: 100%;
        }

        h1 {
            color: rgb(44, 62, 80);
            font-family: verdana;
            font-size: 100%;
        }

        h2 {
            color: rgb(1, 50, 67);
            font-family: verdana;
            font-size: 100%;
        }

        a {
            color: rgb(102, 51, 153);
        }
    </style>
</head>

<body>
    <div class="text-center">
        <center>
            <h1><u> AIRLINE RESERVATION SYSTEM </u></h1>
        </center> <br>
        <center>
            <h2>Customer Registration Form</h2>
        </center> <br>
    </div>
    <form action="" method="POST" id="registerForm">
        <legend>
            <fieldset>

                <br /> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<b>User name: </b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="text" name="emp" id="emp" /><br />
                <br /> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<b>Email Id: </b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="text" name="emailid" id="emailid" /><br />
                <br /> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<b>Phone: </b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="text" name="phone" id="phone" /><br />
                <br /> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<b>Age: </b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="number" name="age" id="age" /><br />
                <!--<br /> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;Airport Id: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="number" name="aid"/><br />  -->
                <br /> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<b>Password: </b>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="password" name="emppass" id="emppass" /><br />
                <br /> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<b>Confirm Password: </b>&nbsp; &nbsp; &nbsp; &nbsp;<input type="password" name="empconf" id="empconf" /><br /><br>
                <br /> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="submit" value="Register" name="submit" />
                &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;<input type="reset" /><br>
                <br>
            </fieldset>
        </legend>
    </form>

    <?php
    if (isset($_POST["submit"])) {
        if (!empty($_POST['emp']) && !empty($_POST['emailid']) && !empty($_POST['phone']) && !empty($_POST['emppass']) && !empty($_POST['empconf']) && !empty($_POST['age'])) {
            $emp = $_POST['emp'];
            $emailid = $_POST['emailid'];
            $phone = $_POST['phone'];
            $age = $_POST['age'];
            $emppass = $_POST['emppass'];
            $empconf = $_POST['empconf'];

            if ($emppass != $empconf) {
                echo ("Error... Passwords do not match");
                exit;
            }

            $con = @mysqli_connect('localhost', 'root', '@pes1234', 'Airline');
            if (!$con) {
                die("Connection failed: " . mysqli_connect_error());
            }

            $sql = "SELECT * FROM Customer WHERE User_Name='" . $emp . "'";
            $query = mysqli_query($con, $sql);
            if (!$query) {
                die("Query failed: " . mysqli_error($con));
            }

            $numrows = mysqli_num_rows($query);

            $sql = "CALL insert_cust('$emp','$emppass','$emailid','$phone','$age')";
            $result = mysqli_multi_query($con, $sql);
            if (!$result) {
                echo "Error: " . mysqli_error($con);
            } else {

                echo "<script>alert('Employee Account Successfully Created.. Please Login..');</script>";
            }

            mysqli_close($con);
        } else {
            echo "All fields are required!";
        }
    }
    ?>

    <script>
        // Function to check if the username already exists
        function checkUsername() {
            var username = document.getElementById("emp").value;
            var xmlhttp = new XMLHttpRequest();
            xmlhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    if (this.responseText.trim() == "exists") {
                        alert("Username already exists! Please choose another.");
                    }
                }
            };
            xmlhttp.open("GET", "check_username.php?username=" + username, true);
            xmlhttp.send();
        }

        // Event listener for checking username on input change
        document.getElementById("emp").addEventListener("change", checkUsername);
    </script>
</body>

</html>