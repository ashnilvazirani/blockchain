<?php include('../functions.php');
   if(isset($_GET['logout'])){
        session_destroy();
	unset($_SESSION['user']);
}
if(isset($_SESSION)){
  $con = mysqli_connect('localhost', 'root', '', 'multi_login');
    $user_id=$_SESSION['user']['user_id'];
    $query="SELECT patient_id, patient_first_name, patient_last_name FROM patient WHERE user_id=$user_id";    
    $data=mysqli_query($con, $query);
    $row=$data->fetch_array();
    extract($row);
    if(isset($_POST['link_btn'])){
        extract($_POST);
        $query = "INSERT INTO patient_hospital(patient_id, hospital_id) VALUES($patient_id, $hospital_id)";
        $sql=mysqli_query($con,$query);
//        echo $query;
        if($sql){
            flush();
        }else{
            echo "error!";
        }
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
		<h2>REQUEST TO LINK TO HOSPITAL</h2>
	</div>
	<form method="post" action="">

		<?php echo display_error(); ?>

		<div class="input-group">
			<label>Username</label>
			<input type="text" name="username" value="<?php echo $patient_first_name." ".$patient_last_name;?>" disabled>
		</div>
		<div class="input-group">
			<label>Hospital</label>	
            <?php $results = mysqli_query($con, "SELECT hospital_id, hospital_name from hospital"); ?>
            
			<select id="hospital_id" name="hospital_id">
                <option value='0'>SELECT</option>
                <?php while ($row = mysqli_fetch_array($results)) { ?>    
                        <option value="<?php echo $row['hospital_id'];?>"><?php echo $row['hospital_name'];?></option>
                <?php }?>
            </select>
            
		</div>
		
		<div class="input-group">
			<button type="submit" class="btn" name="link_btn">LINK</button>
		</div>
        
	</form>
</body>
</html>