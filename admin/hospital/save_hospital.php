<?php
if(isset($_POST['save_hospital_details'])){
    include_once("../../functions.php");
    save_hospital_details();
}

function save_hospital_details(){
extract($_POST);    
$user_id= 10; //admin's id-->>$_SESSION['user']['user_id'];
$con = mysqli_connect('localhost', 'root', '', 'multi_login');

$allowedExts = array("pdf");
$temp = explode(".", $_FILES["pdf_file"]["name"]);
$extension = end($temp);
$upload_pdf=$_FILES["pdf_file"]["name"];
move_uploaded_file($_FILES["pdf_file"]["tmp_name"],"uploads/identity_documents/" . $_FILES["pdf_file"]["name"]);
$hospital_medical_document=$_FILES["pdf_file"]["name"];

$query="INSERT INTO `hospital` (`hospital_name`, `hospital_address`, `hospital_city`, `hospital_state`, `hospital_phone`, `hospital_incharege_details`, `hospital_speciality`, `hospital_documents`, `hospital_saved_by`, `hospital_additional_comments`, `hospital_status`) VALUES ('$hospital_name', '$hospital_address', '$hospital_city', '$hospital_state', $hospital_phone, '$hospital_incharege_details', '$hospital_speciality', '$hospital_medical_document', $user_id, '$hospital_additional_comments', '0');";

echo $query;
$sql=mysqli_query($con,$query);
if($sql){
	echo "Data Submit Successful";
    header('location: view_hospital_list.php');
}
else{    
	echo "Data Submit Error!!";
}

}
?>