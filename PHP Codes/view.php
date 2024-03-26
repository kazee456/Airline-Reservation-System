<?php
session_start();
//if(!isset($_SESSION["sess_id"])){  
//    header("location:member.php");  
//} else {  
?>
<!doctype html>
<html>

<head>
	<link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

	<title>View</title>
	<link rel="stylesheet" type="text/css" href="emp.css">
	<style>
		body {
			background-image: url("arrow.jpg");
			margin-top: 30px;
			margin-bottom: 50px;
			margin-right: 150px;
			margin-left: 80px;
			background-size: 100%;
			background-attachment: fixed;
			color: #261A15;
			font-family: 'Yantramanav', sans-serif;
			font-size: 100%;

		}

		.container {
			align-items: center;
			justify-content: center;
		}

		a {
			color: rgb(102, 51, 153);
		}

		table {
			border-collapse: collapse;
			width: 80%;
			color: #00332E;

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

	<div class="text-center justify-content-center">
		<h3> Booked Details: </h3><br>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col">
					<center>
						<form action="" method="POST">

							<!--	<input type="submit" value="View Booking" name="view" /><br><br>-->
							<?php
							//}
							//if(isset($_POST["view"])){

							$con = @mysqli_connect('localhost', 'root', '@pes1234', 'Airline');

							//$lastInsertID =  mysqli_insert_id($con);


							$sql = "select * from Records";
							if ($result = mysqli_query($con, $sql)) {
								$numrows = mysqli_num_rows($result);
								if ($numrows > 0) {
									echo "<div class='table-responsive'>";
									echo "<table border='1'>";
									echo "<tr>";
									echo "<th>Username</th>";
									echo "<th>Booking id</th>";
									echo "<th>Departure date</th>";
									echo "<th>Pyment Type</th>";
									echo "<th>Pid</th>";
									echo "<th>Pickup</th>";
									echo "<th>Destination</th>";
									//echo "<th>Email</th>";
									echo "<th>Fare</th>";
									echo "</tr>";
									while ($row = mysqli_fetch_assoc($result)) {

										$deptime = $row['Dep_Time'];
										$flightid = $row['Flight_ID'];
										$query1 = "SELECT * from Aircraft where Dep_Time='$deptime' AND Flight_ID='$flightid'";
										$result1 = mysqli_query($con, $query1);
										$row1 = mysqli_fetch_assoc($result1);
							?>
										<?php echo "<tr>"; ?>
										<td><b><?php echo $row['User_Name']; ?></b></td>
										<td><?php echo $row['Book_ID']; ?></td>
										<td><b><?php echo $row['Dep_Time']; ?></b></td>
										<td><b><?php echo $row['Payment_Type']; ?></b></td>
										<td><?php echo $row['Flight_ID']; ?></td>
										<td><b><?php echo $row1['Src']; ?></b></td>
										<td><b><?php echo $row1['Dstn']; ?></b></td>
										<td><b><?php echo $row1['Fare']; ?></b></td>
										<?php echo "</tr>"; ?>
							<?php
									}
									echo "</table>";
								}
								mysqli_free_result($result);
								//}
							}

							?>
							<br><br>

							<?php
							//if(isset($_POST["view"])){
							//$con=@mysqli_connect('localhost','root','','airline') or die(mysql_error());  
							//$result=mysqli_query($con,"CALL no_of_Users") or die("Query Fail:".mysql_error());
							//while($row=mysqli_fetch_array($result)){
							//echo $row[0];
							//}
							//}
							?>

							<div class="container">
								<div class="row">
									<div class="col">
										<input type="button" value="Insert Flights" onclick="location.href='enter.php';" style="color:black" class="btn btn-primary">
									</div>
									<div class="col text-end">
										<button class="btn btn-danger">
											<a href="logout.php" style="color:black">Logout</a>
										</button>
									</div>
								</div>
							</div>
						</form>
					</center>
				</div>
			</div>
		</div>


	</div>

</body>

</html>