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
    $pid=$_GET['pid'];
    $query_update_doctor = "UPDATE patient_hospital SET status = 1 WHERE patient_hospital = $id";
    $sql=mysqli_query($db,$query_update_doctor);
    echo $pid;
    $query_update_patient_inprogress = "UPDATE patient SET patient_status = 1 WHERE patient_id = $pid";
    $sql=mysqli_query($db,$query_update_patient_inprogress);
    if($sql){
        header('location: approve_patient_hospital.php');
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
						<!--patient table-->
						<!---------------------------------  Display records where complete = 0 --------------------------------------->
						<?php $results = mysqli_query($db, "SELECT * from patient_hospital WHERE status=0"); ?>
							<b><u>patient-Hospital</u></b>
							<table border='5'>
								<thead>
									<tr>
										<th>REQ ID</th>
										<th>patient Name</th>
										<th>Hospital Name</th>
										<th>Action</th>
		                                  
									</tr>
								</thead>
								
								<?php while ($row = mysqli_fetch_array($results)) {
                                    $patient_id=$row['patient_id'];
                                    $patient = mysqli_query($db, "SELECT patient_first_name, patient_last_name from patient WHERE patient_id=$patient_id");
                                    $patient_name=mysqli_fetch_array($patient);
    
                                    $hosp_id=$row['hospital_id'];
                                    $hosp = mysqli_query($db, "SELECT hospital_name from hospital WHERE hospital_id=$hosp_id");
                                    $hosp_name=mysqli_fetch_array($hosp);
                                ?>
									<tr>
										<td><?php echo $row['patient_hospital']; ?></td>
										<td><?php echo $patient_name['patient_first_name']." ".$patient_name['patient_last_name']; ?></td>
                                        <td><?php echo $hosp_name['hospital_name']; ?></td>
										<td><button class="editbtn"><a href="approve_patient_hospital.php?app=1&id=<?php echo $row['patient_hospital'];?>&pid=<?php echo $patient_id;?>">Approve</a></button></td>
									</tr>
								<?php } ?>
							</table>
						
						<br/>
						
						<br>
						
						
						<br/>
						<a href="home.php?logout='1'" style="color: red;">logout</a>
						<!-- This is the link to a form doctor has to fill about assigning patient to acceptor -->
					</small>

				<?php endif ?>
			</div>
		</div>
	</div>
</body>
    <script>
     
    </script>
</html>