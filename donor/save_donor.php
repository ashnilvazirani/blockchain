<?php
if(isset($_POST['save_donor_details'])){
    include_once("../functions.php");
    save_donor_details();
}

function save_donor_details(){
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
$donor_medical_document=$_FILES["pdf_file"]["name"];

$allowedExts = array("pdf");
$temp = explode(".", $_FILES["pdf_file1"]["name"]);
$extension = end($temp);
$upload_pdf=$_FILES["pdf_file1"]["name"];
move_uploaded_file($_FILES["pdf_file1"]["tmp_name"],"uploads/identity_documents/" . $_FILES["pdf_file1"]["name"]);
$donor_identity=$_FILES["pdf_file1"]["name"];

$query="INSERT INTO `donor` (`user_id`, `donor_first_name`, `donor_last_name`, `donor_phone`, `donor_address`, `donor_blood_group`, `donor_age`, `donor_organ`, `donor_identity`, `donor_medical_document`, `donor_additional_comments`, `donor_status`) VALUES($user_id, '$donor_first_name', '$donor_last_name', $donor_phone, '$donor_address', '$donor_blood_group', $donor_age, '$donor_organ', '$donor_identity', '$donor_medical_document', '$donor_additional_comments', 0)";

echo $query;
$sql=mysqli_query($con,$query);
echo $user_id;
$query_update_donor_inprogress = "UPDATE user_details SET user_record_stores = 1 WHERE user_id = $user_id;";
$sql=mysqli_query($con,$query_update_donor_inprogress);
//echo $query;
if($sql){
	echo "Data Submit and update Successful";
    header('location: view_donor_details.php');
}
else{    
	echo "Data Submit Error!!";
}

}
?>