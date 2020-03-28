<?php
if(isset($_POST['save_doctor_details'])){
    include_once("../functions.php");
    save_doctor_details();
}

function save_doctor_details(){
extract($_POST);    
print_r($_SESSION);
$user_id=10;//$_SESSION['user']['user_id'];
echo $user_id;
$con = mysqli_connect('localhost', 'root', '', 'multi_login');

$allowedExts = array("pdf");
$temp = explode(".", $_FILES["pdf_file"]["name"]);
$extension = end($temp);
$upload_pdf=$_FILES["pdf_file"]["name"];
move_uploaded_file($_FILES["pdf_file"]["tmp_name"],"uploads/medical_documents/" . $_FILES["pdf_file"]["name"]);
$doctor_medical_document=$_FILES["pdf_file"]["name"];

$allowedExts = array("pdf");
$temp = explode(".", $_FILES["pdf_file1"]["name"]);
$extension = end($temp);
$upload_pdf=$_FILES["pdf_file1"]["name"];
move_uploaded_file($_FILES["pdf_file1"]["tmp_name"],"uploads/identity_documents/" . $_FILES["pdf_file1"]["name"]);
$doctor_identity=$_FILES["pdf_file1"]["name"];

$query="INSERT INTO `dcotor` (`user_id`, `doctor_first_name`, `doctor_last_name`, `doctor_phone`, `doctor_address`, `doctor_blood_group`, `doctor_age`, `doctor_qualification`, `doctor_speciality`, `doctor_identity`, `doctor_medical_document`, `doctor_additional_comments`, `doctor_status`) VALUES ($user_id, '$doctor_first_name', '$doctor_last_name', $doctor_phone, '$doctor_address', '$doctor_blood_group', $doctor_age, '$doctor_qualification', '$doctor_speciality', '$doctor_identity', '$doctor_medical_document', '$doctor_additional_comments', 0)";

echo $query;
$sql=mysqli_query($con,$query);
echo $user_id;
//$query_update_doctor_inprogress = "UPDATE user_details SET user_record_stores = 1 WHERE user_id = $user_id;";
//$sql=mysqli_query($con,$query_update_doctor_inprogress);
//echo $query;
if($sql){
	echo "Data Submit Successful";
//    header('location: view_doctor_details.php');
}
else{    
	echo "Data Submit Error!!";
}

}
?>