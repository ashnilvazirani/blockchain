<?php include('../functions.php');
include_once('sidebar.php');
$con=mysqli_connect('localhost', 'root', '', 'multi_login');
    
   if(isset($_GET['logout'])){
        session_destroy();
	unset($_SESSION['user']);
}
if(isset($_GET['hid']) and isset($_GET['pid'])){
    $hospital_id=$_GET['hid'];
    $patient_id=$_GET['pid'];
    $hosp= mysqli_query($con, "SELECT hospital_name from hospital WHERE hospital_id=$hospital_id");
    $hosp_name=mysqli_fetch_array($hosp);
    
    $don= mysqli_query($con, "SELECT patient_first_name, patient_last_name from patient WHERE patient_id=$patient_id");
    $don_name=mysqli_fetch_array($don);
    extract($don_name);
}
if(isset($_POST['assign_doctor'])){
    extract($_POST);
    $query = "INSERT INTO patient_doctor(patient_id, doctor_id) VALUES($patient_id, $doctor_id)";
    $sql=mysqli_query($con,$query);
    $query1 = "UPDATE patient_hospital SET status = 2 WHERE patient_id = $patient_id and hospital_id = $hospital_id";
    $sql1=mysqli_query($con,$query1);
    unset($_GET['pid']);
    unset($_GET['hid']);
    if($sql and $sql1){
        flush();
//         header('location: approve_patient_hospital.php');
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
        <!--selected patient name-->
        <div class="input-group">
            <label>patient</label>
			<input type="text" name="username" value="<?php echo $patient_first_name." ".$patient_last_name;?>" disabled>
		</div>
        <!--Linked hospital name-->
        <div class="input-group">
			<label>HOSPITAL</label>
			<input type="text" name="username" value="<?php echo $hosp_name['hospital_name'];?>" disabled>
		</div>
        
		<div class="input-group">
			<label>Doctor</label>
    <?php $results = mysqli_query($con, "SELECT doctor_id from doctor_hospital WHERE hospital_id=$hospital_id"); ?>
            
			<select id="doctor_id" name="doctor_id">
                <option value='0'>SELECT</option>
                <?php while ($row = mysqli_fetch_array($results)) { 
                $doc_id=$row['doctor_id'];
                $doc = mysqli_query($con, "SELECT doctor_id, doctor_first_name, doctor_last_name from dcotor WHERE doctor_id=$doc_id");
                $doc_name=mysqli_fetch_array($doc);
                
                ?>
   
                        <option value="<?php echo $doc_name['doctor_id'];?>"><?php echo $doc_name['doctor_first_name']." ".$doc_name['doctor_last_name'];?></option>
                <?php }?>
            </select>
            
		</div>
		
		<div class="input-group">
			<button type="submit" class="btn" name="assign_doctor">Assign Doctor</button>
        </div>
        <a href="home.php?logout='1'" style="color: red;">logout</a>
						
	</form>
</body>
</html>