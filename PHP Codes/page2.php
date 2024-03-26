<?php
session_start();
if (!isset($_SESSION['sess_from']) && !isset($_SESSION['sess_user']) && !isset($_SESSION['sess_to']) && !isset($_SESSION['sess_depdate'])) {
	header("location:page1.php");
	exit();
} else {
	$pattern = '/[ ]/';
	$string = "1998-11-09 15:00:00";
	//echo '<pre>', print_r( preg_split($pattern, $string), 1 ), '</pre>';
	//echo $string

?>
	<!doctype html>

	<html>

	<head>
		<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
		<title>Welcome2</title>
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
		<link rel="stylesheet" type="text/css" href="page.css">
		<style>
			table {
				border-collapse: collapse;
				width: 80%;
				border: 1px solid #343a40;
				color: #000;
			}

			th,
			td {
				text-align: left;
				padding: 8px;
			}


			tr:nth-child(even) {
				background-color: #f2f2f2
			}

			tr:nth-child(odd) {
				background-color: #f2f2f2
			}

			th {
				background-color: #343a40;
				color: white;
			}

			.custom-card {
				background-color: black;
				color: white;
				opacity: 0.7;
			}
		</style>

	</head>

	<body>
		<h3 class="fs-2 text-center text-bold text-dark">AIRLINE RESERVATION SYSTEM</h3>
		<h2>Flight Details:</h2><br>
		<form action="" method="POST">

			<div class="card custom-card">
				<div class="card-body">
					<div class="text-center justify-content-center">


						<?php
						//$aid=$_SESSION['sess_aid'];
						//echo $aid;
						$con = @mysqli_connect('localhost', 'root', '@pes1234', 'Airline');

						$depdate = $_SESSION['sess_depdate'];
						$user = $_SESSION['sess_user'];
						$from = $_SESSION['sess_from'];
						$to = $_SESSION['sess_to'];
						//	echo $depdate;
						//	echo $to;
						//	echo $from;

						$sql = "SELECT Flight_ID,Dep_Time,Arr_Time,Plane_Name,Src,Dstn,Fare,Dep_Date FROM Aircraft WHERE Src='$from' and Dstn='$to' and Dep_Date='$depdate'";
						//$sql="SELECT Flight_ID,Dep_Time,Arr_Time,Plane_Name,Src,Dstn,Fare,Dep_Date FROM Aircraft";
						if ($result = mysqli_query($con, $sql)) {
							$numrows = mysqli_num_rows($result);
							if ($numrows > 0) {
								echo "
						<h2>Available Flights: </h2>";

								echo $numrows . " Plane(s) Available..";
								echo "<br><br><table class='table table-bordered border-dark'>";
								echo "<tr>";
								echo "<th>Plane id</th>";
								echo "<th>Departure</th>";
								echo "<th>Arrival</th>";
								echo "<th>Seats</th>";
								echo "<th>From</th>";
								echo "<th>To</th>";
								echo "<th>Fare</th>";
								//echo "<th>Action</th>";
								echo "</tr>";
								while ($row = mysqli_fetch_assoc($result)) {
						?>

									<?php
									$pname = $row['Plane_Name'];
									$seat_query = "SELECT Seats FROM Planes WHERE Plane_Name='$pname'";
									$seats = mysqli_query($con, $seat_query);
									$seats1 = mysqli_fetch_assoc($seats);
									$tot_seats = (int)$seats1['Seats'];
									$sql_1 = "SELECT Flight_ID,Dep_Time FROM Aircraft";
									$fid = $row['Flight_ID'];
									$var = $row['Dep_Time'];
									$booked_seats = "SELECT * FROM Records where Flight_ID='$fid' and Book_Time='$var'";
									$res = mysqli_query($con, $booked_seats);
									$numseats = mysqli_num_rows($res);
									$availSeats = $tot_seats - $numseats;

									echo "<tr>"; ?>

									<td><?php echo $row['Flight_ID']; ?></td>
									<td><?php echo $row['Dep_Time']; ?></td>
									<td><?php echo $row['Arr_Time']; ?></td>
									<td><?php echo $availSeats; ?></td>
									<td><?php echo $row['Src']; ?></td>
									<td><?php echo $row['Dstn']; ?></td>
									<td><?php echo $row['Fare']; ?></td>
									<?php echo "</tr>"; ?>
								<?php
								}
								echo "</table><br><br>";

								?>
								<div class="row">

									<div class="col form-inline">
										<b>Flight id:</b>
										<input type="text" name="flight_id" placeholder="Flight Id">
									</div>
									<!-- <div class="col">
										<input type="text" name="flight_id" placeholder="Flight Id">
									</div> -->

									<div class="col form-inline">
										<b>Dep_Time:</b>
										<input type="text" name="dptime" placeholder="Depature Time">
									</div>
									<!-- <div class="col">
										<input type="text" name="dptime" placeholder="Depature Time">
									</div> -->
									<div class="col form-inline">
										<b>Payment Mode: </b>
										<select name="Booking_Method" class="form-select p-1">
											<option value="Paytm">Paytm</option>
											<option value="Card">Credit Card</option>
											<option value="UPI">UPI</option>
											<option value="Wallet">Wallet</option>
										</select>
									</div>
									<div class="col form-inline">
										<input type="submit" value="Book" name="book" class="btn btn-primary">
									</div>
								</div>
								<?php


								mysqli_free_result($result);
							} else {
								echo "<h2 class='text-center text-danger'>No planes matching your requirements were found.</h2>";
							}
						}
						$user = $_SESSION['sess_user'];

						if (isset($_POST['book'])) {
							if (!empty($_POST['flight_id']) && !empty($_POST['dptime']) && !empty($_POST['Booking_Method'])) {
								$flight_id = $_POST['flight_id'];
								$dptime = $_POST['dptime'];
								$payment = $_POST['Booking_Method'];

								$con = @mysqli_connect('localhost', 'root', '@pes1234', 'Airline');
								$sql_Air = "SELECT * FROM Aircraft";
								$result = mysqli_query($con, $sql_Air);
								$row = mysqli_fetch_assoc($result);

								$pname = $row['Plane_Name'];

								$seat_query = "SELECT Seats FROM Planes WHERE Plane_Name='$pname'";

								$seats = mysqli_query($con, $seat_query);
								$seats1 = mysqli_fetch_assoc($seats);
								$tot_seats = (int)$seats1['Seats'];

								$fid = $row['Flight_ID'];
								$var = $row['Dep_Time'];
								$booked_seats = "SELECT * FROM Records where Flight_ID='$fid' and Dep_Time='$var'";
								echo "$booked_seats";
								$res = mysqli_query($con, $booked_seats);
								$numseats = mysqli_num_rows($res);
								$availSeats = $tot_seats - $numseats;
								echo "$tot_seats";
								echo "$num_seats";

								if ($availSeats == 0) {

								?>
									// <script>
										window.alert('Seats completely filled.. Press Back..');
										window.history.back();
									</script>
									// <?php
									} else {
										echo "booking";
										$today = date('Y-m-d H:i:s');

										$sql = "INSERT INTO Records (Flight_ID,Dep_Time,Book_Time,User_Name,Payment_Type) values('$flight_id','$dptime','$today','$user','$payment')";
										$sql1 = "SELECT Book_ID FROM Records WHERE Flight_ID='$flight_id' AND Dep_Time='$dptime' AND Book_Time='$today'";
										if ($result = mysqli_query($con, $sql)) {

											if ($result1 = mysqli_query($con, $sql1)) {

												$row1 = mysqli_fetch_assoc($result1);
												$bookid = $row1['Book_ID'];

												$_SESSION['sess_user'] = $user;
												$_SESSION['sess_aid'] = $aid;
												$_SESSION['sess_bookid'] = $bookid;

												header("Location: page3.php");
											}
										} else {
											echo "Error: " . $sql . "<br>" . mysqli_error($con);
										}

										mysqli_close($con);
									}
								}
								// }
								// } else {
								// 	echo "Insert all the required fields";
								// }
							}
						}
										?><br>
					</table>
					<button type="button" class="btn btn-secondary" onclick="location.href='page1.php';">Back</button><br><br>
					</div>
				</div>
			</div>
		</form>
	</body>

	</html>