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
						<!--Donor table-->
						<!---------------------------------  Display records where complete = 0 --------------------------------------->
						<?php $results = mysqli_query($db, "SELECT  patient_id, patient_first_name, patient_last_name, patient_blood_group, patient_age, patient_organ FROM patient"); ?><!--WHERE patient_status=1") ?>-->
							<b><u>Patients</u></b>
							<table border='5'>
								<thead>
									<tr>
										<th>Patient Name</th>
									   <th>Blood group</th>
										<th>Age</th>
										<th>Organ</th>
		
									</tr>
								</thead>
								
								<?php while ($row = mysqli_fetch_array($results)) { ?>
									<tr>
										<td><?php echo $row['patient_first_name']." ".$row['patient_last_name']; ?></td>
										<td><?php echo $row['patient_blood_group']; ?></td>
										<td><?php echo $row['patient_age']; ?></td>
										<td><?php echo $row['patient_organ']; ?></td>
                                        
									</tr>
								<?php } ?>
							</table>
						
						<br/>
						
						<br>
						<!--Acceptor Table-->
						<!---------------------------------  Display records where complete = 0 --------------------------------------->	
						<?php $results = mysqli_query($db, "SELECT donor_id, donor_first_name, donor_last_name,donor_blood_group, donor_age, donor_organ FROM donor"); ?><!-- WHERE donor_status = 1"); ?>-->
							<b><u>Donors</u></b>
							<table border='5'>
								<thead>
									<tr>
										<th>Donor Name</th>
										<th>Blood group</th>
										<th>Age</th>
										<th>Organ</th>
		
									</tr>
								</thead>
								
								<?php while ($row = mysqli_fetch_array($results)) { ?>
									<tr>
										<td><?php echo $row['donor_first_name']." ".$row['donor_last_name']; ?></td>
										<td><?php echo $row['donor_blood_group']; ?></td>
										<td><?php echo $row['donor_age']; ?></td>
										<td><?php echo $row['donor_organ']; ?></td>
			
									</tr>
								<?php } ?>
							</table>
						
						<br/>
						<a href="home.php?logout='1'" style="color: red;">logout</a>
						<!-- This is the link to a form doctor has to fill about assigning donor to acceptor -->
                       &nbsp; <a href="create_user.php"> Assign Donors to Acceptors</a>
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>
</body>
</html>