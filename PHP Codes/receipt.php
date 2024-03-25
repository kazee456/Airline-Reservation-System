<?php
session_start();

if (!isset($_SESSION['sess_user']) && !isset($_SESSION['sess_aid']) && !isset($_SESSION['sess_bookid'])) {
    echo "Booking ID is not set or empty.";
    exit();
}

?>
<!DOCTYPE html>
<html>

<head>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <!-- font awesome link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        .title {
            font-size: 24px;
            color: #333;
            margin: 0;
        }

        .subtitle {
            font-size: 18px;
            color: #777;
            margin: 0;
        }

        .section {
            margin-bottom: 20px;
        }

        .section-title {
            font-size: 18px;
            color: #333;
            margin-bottom: 10px;
        }

        .payment-details {
            border-collapse: collapse;
            width: 100%;
            margin-bottom: 20px;
        }

        .payment-details th,
        .payment-details td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        .payment-details th {
            background-color: #f2f2f2;
        }

        .footer {
            text-align: center;
            color: #777;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <h1 class="title">Receipt</h1>
            <p class="subtitle">Thank you for your booking!</p>
        </div>

        <div class="section">
            <h2 class="section-title">Kenya Airline</h2>
            <table class="payment-details">
                <tr>
                    <th>Booking ID</th>
                    <th>Departure Date</th>
                    <th>Payment Type</th>
                    <th>Pane Id</th>
                    <th>Pickup</th>
                    <th>Destination</th>
                    <th>Fare</th>
                </tr>
                <?php
                $bookid = $_SESSION['sess_bookid'];
                $con = @mysqli_connect('localhost', 'root', '@pes1234', 'Airline');
                $sql = "SELECT * FROM Records WHERE Book_ID=$bookid";
                if ($result = mysqli_query($con, $sql)) {
                    $numrows = mysqli_num_rows($result);
                    if ($numrows > 0) {
                        while ($row = mysqli_fetch_assoc($result)) {

                            $deptime = $row['Dep_Time'];
                            $flightid = $row['Flight_ID'];
                            $query1 = "SELECT * FROM Aircraft WHERE Dep_Time='$deptime' AND Flight_ID='$flightid'";
                            $result1 = mysqli_query($con, $query1);
                            $row1 = mysqli_fetch_assoc($result1);
                ?>
                            <tr>

                                <td><?php echo $row['Book_ID']; ?></td>
                                <td><?php echo $row['Dep_Time']; ?></td>
                                <td><?php echo $row['Payment_Type']; ?></td>
                                <td><?php echo $row['Flight_ID']; ?></td>
                                <td><?php echo $row1['Src']; ?></td>
                                <td><?php echo $row1['Dstn']; ?></td>
                                <td><?php echo $row1['Fare']; ?></td>
                            </tr>

                <?php
                        }
                    }
                } else {
                    echo "Query execution failed: " . mysqli_error($con);
                }

                mysqli_free_result($result);

                ?>

            </table>
        </div>

        <div class="section row d-flex justify-content">
            <div class="col-lg-6 col-xl-6">
                <h2 class="section-title">Customer Information</h2>
                <?php
                $bookid = $_SESSION['sess_bookid'];
                $con = @mysqli_connect('localhost', 'root', '@pes1234', 'Airline');
                $sql = "SELECT * FROM Records WHERE Book_ID=$bookid";
                if ($result = mysqli_query($con, $sql)) {
                    $numrows = mysqli_num_rows($result);
                    if ($numrows > 0) {
                        mysqli_data_seek($result, 0); // Reset the result pointer to the first row
                        while ($row = mysqli_fetch_assoc($result)) {

                ?>
                            <p><strong>Username:</strong> <?php echo $row['User_Name']; ?></p>
                            <p><strong>Flight ID:</strong> <?php echo $row['Flight_ID']; ?></p>
            </div>
            <div class="col-lg-6 col-xl-4">
                <?php $serialNumber = mt_rand(100000, 999999); // Generate a random 6-digit number
                ?>
                <p class="serial-number"><span class="bar"></span>Serial Number: <?php echo $serialNumber; ?>
                    <i class="fa-solid fa-barcode"></i> <i class="fa-solid fa-barcode"></i> <i class="fa-solid fa-barcode"></i> <i class="fa-solid fa-barcode"></i> <i class="fa-solid fa-barcode"></i> <i class="fa-solid fa-barcode"></i> <i class="fa-solid fa-barcode"></i> <i class="fa-solid fa-barcode"></i>
                </P>
            </div>
            <hr> <!-- Add a horizontal line -->
<?php
                        }
                    }
                }
                mysqli_close($con); // Close the database connection
?>
        </div>
        <td><?php echo $row['User_Name']; ?></td>
        <div class="footer">
            <p>For any inquiries, please contact us at kenyaAirline@gmail.com</p>
        </div>
    </div>
</body>

</html>