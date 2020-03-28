<?php include('../functions.php');
include_once('sidebar.php');
   if(isset($_GET['logout'])){
        session_destroy();
	unset($_SESSION['user']);
}
if(isset($_POST['link_btn'])){
    extract($_POST);
    $con=mysqli_connect('localhost', 'root', '', 'multi_login');
    $query = "INSERT INTO doctor_hospital(doctor_id, hospital_id) VALUES($doctor_id, $hospital_id)";
    $sql=mysqli_query($con,$query);
    if($sql){
        flush();
    }else{
        echo "error!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Registration system PHP and MySQL</title>
	<link rel="stylesheet" type="text/css" href="../style.css">
</head>
<body>
	<div class="header">
		<h2>Login</h2>
	</div>
	<form method="post" action="">
		<?php echo display_error(); ?>
		<div class="input-group">
			<label>Doctor</label>
    <?php $results = mysqli_query($db, "SELECT doctor_id, doctor_first_name, doctor_last_name from dcotor"); ?>
            
			<select id="doctor_id" name="doctor_id">
                <option value='0'>SELECT</option>
                <?php while ($row = mysqli_fetch_array($results)) { ?>    
                        <option value="<?php echo $row['doctor_id'];?>"><?php echo $row['doctor_first_name']." ".$row['doctor_last_name'];?></option>
                <?php }?>
            </select>
            
		</div>
		
        <div class="input-group">
			<label>Hospital</label>
			
    <?php $results = mysqli_query($db, "SELECT hospital_id, hospital_name from hospital"); ?>
            
			<select id="hospital_id" name="hospital_id">
                <option value='0'>SELECT</option>
                <?php while ($row = mysqli_fetch_array($results)) { ?>    
                        <option value="<?php echo $row['hospital_id'];?>"><?php echo $row['hospital_name'];?></option>
                <?php }?>
            </select>
            
		</div>
		<div class="input-group">
			<button type="submit" class="btn" name="link_btn">Link</button>
        </div>
        <a href="home.php?logout='1'" style="color: red;">logout</a>
						
	</form>
</body>
</html>