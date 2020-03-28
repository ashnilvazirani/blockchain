<?php 
	include('functions.php');
	if (!isLoggedIn()) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
	}
	
	if (isset($_SESSION)) {
		$id = $_SESSION['user']['user_id'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM user_details WHERE user_id=$id");

		if ($record != NULL ) {
			$n = mysqli_fetch_array($record);
			$name = $n['username'];
			$address = $n['user_email'];
            $status=$n['user_record_stores'];
            echo $name;
            echo $address;
            echo $status;
            if(isset($_SESSION['user']) && $_SESSION['user']['user_type']=='Donor'){
                if($status==0){
                    header('location: donor/add_donor_details.php');
                }else if($status==1){
                    header('location: donor/view_donor_details.php');
                }
        
            }else if(isset($_SESSION['user']) && $_SESSION['user']['user_type']=='Patient'){
                    if($status==0){
                    header('location: patient/add_patient_details.php');
                }else if($status==1){
                    header('location: patient/view_patient_details.php');
                }
                }//patient else if closing
		}//records closing
	}//session closin
        

?>
<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
	<link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="header">
		<h2>Home Page</h2>
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
			<center><img src="images/user_profile.png"  ></center>

			<div>
				<?php  if (isset($_SESSION['user'])) : ?>
					<strong>Welcome. Thank You for Registering on our portal.<br/> You will be notified shortly</strong>

					<small>
						<!--<i  style="color: #888;">(<?php echo ucfirst($_SESSION['user']['']); ?>)</i>--> 
						<br>
						<a href="index.php?logout='1'" style="color: red;">logout</a>
					</small>

				<?php endif;
                ?>
			</div>
		</div>
	</div>
</body>
</html>