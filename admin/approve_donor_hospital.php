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
if(isset($_GET['id']) and $_GET['app']==1){
    $id=$_GET['id'];
    $did=$_GET['did'];
    $query_update_doctor = "UPDATE donor_hospital SET status = 1 WHERE donor_hospital = $id";
    $sql=mysqli_query($db,$query_update_doctor);
    echo $did;
    $query_update_donor_inprogress = "UPDATE donor SET donor_status = 1 WHERE user_id = $did";
    $sql=mysqli_query($db,$query_update_donor_inprogress);
    if($sql){
        header('location: approve_donor_hospital.php');
    }

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
						<!---------------------------------  Display records where status = 0 --------------------------------------->
						<?php $results = mysqli_query($db, "SELECT * from donor_hospital WHERE status=0"); ?>
							<b><u>Donor-Hospital(pending approval)</u></b>
							<table border='5'>
								<thead>
									<tr>
										<th>REQ ID</th>
										<th>Donor Name</th>
										<th>Hospital Name</th>
										<th>Action</th>
		                                  
									</tr>
								</thead>
								
								<?php while ($row = mysqli_fetch_array($results)) {
                                    $donor_id=$row['donor_id'];
                                    $donor = mysqli_query($db, "SELECT donor_first_name, donor_last_name from donor WHERE donor_id=$donor_id");
                                    $donor_name=mysqli_fetch_array($donor);
    
                                    $hosp_id=$row['hospital_id'];
                                    $hosp = mysqli_query($db, "SELECT hospital_name from hospital WHERE hospital_id=$hosp_id");
                                    $hosp_name=mysqli_fetch_array($hosp);
                                ?>
									<tr>
										<td><?php echo $row['donor_hospital']; ?></td>
										<td><?php echo $donor_name['donor_first_name']." ".$donor_name['donor_last_name']; ?></td>
                                        <td><?php echo $hosp_name['hospital_name']; ?></td>
										<td><button class="editbtn"><a href="approve_donor_hospital.php?app=1&id=<?php echo $row['donor_hospital'];?>&did=<?php echo $donor_id;?>">Approve</a></button></td>
									</tr>
								<?php } ?>
							</table>
						
						<br/>
						
						<br>
                        <!--List of already linked donor and hospitals-->
								<?php $results = mysqli_query($db, "SELECT * from donor_hospital WHERE status=1"); ?>
							<b><u>Donor-Hospital(pending Doctor assignment)</u></b>
							<table border='5'>
								<thead>
									<tr>
										<th>ID</th>
										<th>Donor Name</th>
										<th>Hospital Name</th>
										<th>Action</th>
		                                  
									</tr>
								</thead>
								
								<?php while ($row = mysqli_fetch_array($results)) {
                                    $donor_id=$row['donor_id'];
                                    $donor = mysqli_query($db, "SELECT donor_first_name, donor_last_name from donor WHERE donor_id=$donor_id");
                                    $donor_name=mysqli_fetch_array($donor);
    
                                    $hosp_id=$row['hospital_id'];
                                    $hosp = mysqli_query($db, "SELECT hospital_name from hospital WHERE hospital_id=$hosp_id");
                                    $hosp_name=mysqli_fetch_array($hosp);
                                ?>
									<tr>
										<td><?php echo $row['donor_hospital']; ?></td>
										<td><?php echo $donor_name['donor_first_name']." ".$donor_name['donor_last_name']; ?></td>
                                        <td><?php echo $hosp_name['hospital_name']; ?></td>
										<td><button class="editbtn"><a href="donor_doctor.php?ass=1&hid=<?php echo $hosp_id;?>&did=<?php echo $donor_id;?>">Assign Doctor</a></button></td>
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