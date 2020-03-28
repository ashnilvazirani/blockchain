<?php 
include('../functions.php');
include_once('sidebar.php');
if (!isAdmin()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: ../login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: ../login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
	<style>
	.header {
		background: #003366;
	}
	button[name=register_btn] {
		background: #003366;
	}
	</style>
</head>
<body>
	<div class="header">
		<h2>Admin - Home Page</h2>
	</div>
	<div class="content">
		<!-- notification message -->
		<?php if (isset($_SESSION['success'])) : ?>
			<div class="error success" >
				<h3>
					<?php 
						echo $_SESSION['success']; 
						unset($_SESSION['success']);
					?>
				</h3>
			</div>
		<?php endif ?>

		<!-- logged in user information -->
		<div class="profile_info">
			<img src="../images/admin_profile.png"  >

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong><?php echo $_SESSION['user']['username']; ?></strong>

					<small>
						<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['user_type']); ?>)</i> 
						<br>
						<!--Doctor table-->
						<!---------------------------------  Display records where complete = 0 --------------------------------------->
						<?php $results = mysqli_query($db, "SELECT doctor_id, doctor_first_name, doctor_last_name, doctor_qualification, doctor_speciality from dcotor WHERE doctor_status=1"); ?>
							<b><u>Approved Doctors</u></b>
							<table border='5'>
								<thead>
									<tr>
										<th>First Name</th>
										<th>Last Name</th>
										<th>Qualification</th>
										<th>Speciality</th>
		                                  
									</tr>
								</thead>
								
								<?php while ($row = mysqli_fetch_array($results)) { ?>
									<tr>
										<td><?php echo $row['doctor_first_name']; ?></td>
										<td><?php echo $row['doctor_last_name']; ?></td>
										<td><?php echo $row['doctor_qualification']; ?></td>
										<td><?php echo $row['doctor_speciality']; ?></td>
                                        <td><button class="editbtn"><a href="../doctor/view_doctor_details.php?doc_id=<?php echo $row['doctor_id'];?>">View</a></button></td>
                                        <td><button class="editbtn"><a href="approve_doctor.php?app=1&doc_id=<?php echo $row['doctor_id'];?>">EDIT</a></button></td>
									</tr>
								<?php } ?>
							</table>
						
						<br/>
						
						<br>
						<!--Approval pending Table-->
						<!---------------------------------  Display records where complete = 0 --------------------------------------->	
						<?php $results = mysqli_query($db, "SELECT doctor_id, doctor_first_name, doctor_last_name, doctor_qualification, doctor_speciality from dcotor WHERE doctor_status=0"); ?>
							<b><u>Pending Doctors</u></b>
							<table border='5'>
								<thead>
									<tr>
										<th>First Name</th>
										<th>Last Name</th>
										<th>Qualification</th>
										<th>Speciality</th>
		                                  
									</tr>
								</thead>
								
								<?php while ($row = mysqli_fetch_array($results)) { ?>
									<tr>
										<td><?php echo $row['doctor_first_name']; ?></td>
										<td><?php echo $row['doctor_last_name']; ?></td>
										<td><?php echo $row['doctor_qualification']; ?></td>
										<td><?php echo $row['doctor_speciality']; ?></td>
                                        <td><button class="editbtn"><a href="../doctor/view_doctor_details.php?doc_id=<?php echo $row['doctor_id'];?>">View</a></button></td>
                                        <td><button class="editbtn"><a href="approve_doctor.php?app=1&doc_id=<?php echo $row['doctor_id'];?>">EDIT</a></button></td>
									</tr>
								<?php } ?>
							</table>
						
						<br/>
						<a href="home.php?logout='1'" style="color: red;">logout</a>
						<!-- This is the link to a form doctor has to fill about assigning donor to acceptor -->
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>
</body>
    <script>
     
    </script>
</html>