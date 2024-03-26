<?php
session_start();
if (!isset($_SESSION['sess_user']) && !isset($_SESSION['sess_aid']) && !isset($_SESSION['sess_bookid'])) {
	header("location:page2.php");
	exit();
} else {

?>
	<!doctype html>

	<html>

	<head>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

		<title>Welcome3</title>
		<style>
			body {
				background-image: url("hello.jpg");
				margin-top: 40px;
				margin-bottom: 100px;
				margin-right: 150px;
				margin-left: 80px;
				background-size: 100%;
				background-attachment: fixed;
				color: #261A15;
				font-family: 'Yantramanav', sans-serif;
				overflow: hidden;
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
		<link rel="stylesheet" type="text/css" href="page.css">
		<style>
			.custom-card {
				background-color: black;
				color: white;
				opacity: 0.8;
			}

			table {
				border-collapse: collapse;
				border-color: #000;
				width: 80%;
				color: #000;
				opacity: 1;

			}

			th,
			td {
				text-align: left;
				padding: 8px;
			}

			tr:nth-child(even) {
				background-color: #f2f2f2;
			}

			tr:nth-child(odd) {
				background-color: #f2f2f2;
			}

			th {
				background-color: #343a40;
				color: white;
			}
		</style>

	</head>

	<body>
		<h3 class="fs-2 text-center text-bold text-dark">AIRLINE RESERVATION SYSTEM</h3>
		<form action="" method="POST">

			<div class="card custom-card mt-5">
				<div class="card-body">
					<div class="text-center justify-content-center">
						<br>
						<b>
							<p class="text-success">Successfully Booked.</p>
						</b>
						<br>
						<h2 class="text-success">Booked Flight Details:</h2><br>
						<?php
						$bookid = $_SESSION['sess_bookid'];
						$con = @mysqli_connect('localhost', 'root', '@pes1234', 'Airline');

						$sql = "SELECT * FROM Records WHERE Book_ID=$bookid";
						if ($result = mysqli_query($con, $sql)) {
							$numrows = mysqli_num_rows($result);
							if ($numrows > 0) {
								echo "<table class='table table-bordered border-dark'>";
								echo "<tr>";
								echo "<th>Username</th>";
								echo "<th>Booking id</th>";
								echo "<th>Departure date</th>";
								echo "<th>Payment Type</th>";
								echo "<th>Pid</th>";
								echo "<th>Pickup</th>";
								echo "<th>Destination</th>";
								echo "<th>Fare</th>";
								echo "</tr>";
								while ($row = mysqli_fetch_assoc($result)) {

									$deptime = $row['Dep_Time'];
									$flightid = $row['Flight_ID'];
									$query1 = "SELECT * FROM Aircraft WHERE Dep_Time='$deptime' AND Flight_ID='$flightid'";
									$result1 = mysqli_query($con, $query1);
									$row1 = mysqli_fetch_assoc($result1);
						?>
									<tr>
										<td><b><?php echo $row['User_Name']; ?></b></td>
										<td><?php echo $row['Book_ID']; ?></td>
										<td><b><?php echo $row['Dep_Time']; ?></b></td>
										<td><b><?php echo $row['Payment_Type']; ?></b></td>
										<td><?php echo $row['Flight_ID']; ?></td>
										<td><b><?php echo $row1['Src']; ?></b></td>
										<td><b><?php echo $row1['Dstn']; ?></b></td>
										<td><b><?php echo $row1['Fare']; ?></b></td>
									</tr>
						<?php
								}
								echo "</table>";
							}
							mysqli_free_result($result);
						}

						?>
						<div class="mb-3">
							<input type="submit" value="Cancel Flight" class="bg-info py-1 px-2 mb-0" name="cancel" onclick="return confirm('Are you sure you want to cancel the flight?');" />
							<button type="button" class="btn btn-info py-1"><a href="receipt.php" style="color:black">Receipt</a></button>
						</div>
					<?php
					if (isset($_POST["cancel"])) {
						$user = $_SESSION["sess_user"];
						$book_id = $_SESSION['sess_bookid'];

						$sql = "DELETE FROM Records WHERE Book_ID = $book_id";
						if (mysqli_query($con, $sql)) {
							echo "<script>alert('Successfully Canceled');</script>";
							$_SESSION['sess_user'] = $user;
							echo "<script>window.open('page1.php','_self')</script>";
							exit();
						} else {
							echo "Error: " . $sql . "<br>" . mysqli_error($con);
						}
					}
				}
					?>
					</div>
				</div>
			</div>
		</form>
		<div class="d-flex justify-content-between">
			<button type="button" class="btn btn-info mt-4"><a href="page2.php" style="color:black">Back</a></button>
			<button type="button" class="btn btn-danger mt-4"><a href="logout1.php" style="color:black">Logout</a></button>
		</div>
	</body>

	</html>