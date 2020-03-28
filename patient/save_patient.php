<?php
if(isset($_POST['save_patient_details'])){
    include_once("../functions.php");
    save_patient_details();
}

function save_patient_details(){
extract($_POST);    
print_r($_SESSION);
$user_id=$_SESSION['user']['user_id'];
echo $user_id;
$con = mysqli_connect('localhost', 'root', '', 'multi_login');

$allowedExts = array("pdf");
$temp = explode(".", $_FILES["pdf_file"]["name"]);
$extension = end($temp);
$upload_pdf=$_FILES["pdf_file"]["name"];
move_uploaded_file($_FILES["pdf_file"]["tmp_name"],"uploads/medical_documents/" . $_FILES["pdf_file"]["name"]);
$patient_medical_document=$_FILES["pdf_file"]["name"];

$allowedExts = array("pdf");
$temp = explode(".", $_FILES["pdf_file1"]["name"]);
$extension = end($temp);
$upload_pdf=$_FILES["pdf_file1"]["name"];
move_uploaded_file($_FILES["pdf_file1"]["tmp_name"],"uploads/identity_documents/" . $_FILES["pdf_file1"]["name"]);
$patient_identity=$_FILES["pdf_file1"]["name"];

$query="INSERT INTO `patient` (`user_id`, `patient_first_name`, `patient_last_name`, `patient_phone`, `patient_address`, `patient_blood_group`, `patient_age`, `patient_organ`, `patient_identity`, `patient_medical_document`, `patient_additional_comments`, `patient_status`) VALUES($user_id, '$patient_first_name', '$patient_last_name', $patient_phone, '$patient_address', '$patient_blood_group', $patient_age, '$patient_organ', '$patient_identity', '$patient_medical_document', '$patient_additional_comments', 0)";

echo $query;
$sql=mysqli_query($con,$query);
echo $user_id;
$query_update_patient_inprogress = "UPDATE user_details SET user_record_stores = 1 WHERE user_id = $user_id;";
$sql=mysqli_query($con,$query_update_patient_inprogress);
//echo $query;
if($sql){
	echo "Data Submit and update Successful";
    header('location: view_patient_details.php');
}
else{    
	echo "Data Submit Error!!";
}

}
?>