<html lang="en">
<head>
	<meta charset="utf-8" />
	<title>View Donor Details</title>
	<meta name="viewport" content="initial-scale=1.0; maximum-scale=1.0; width=device-width;">
</head>
<?php
include_once("sidebar.php");
include_once("../functions.php");
?>
<?php
    $con = mysqli_connect('localhost', 'root', '', 'multi_login');
    $user_id=$_SESSION['user']['user_id'];
    $query="SELECT * FROM donor WHERE user_id=$user_id";    
    $data=mysqli_query($con, $query);
    $row=$data->fetch_array();
    extract($row);
?>

<style>
@import url(https://fonts.googleapis.com/css?family=Roboto:400,500,700,300,100);
body {
  background-color: #3e94ec;
  font-family: "Roboto", helvetica, arial, sans-serif;
  font-size: 16px;
  font-weight: 400;
  text-rendering: optimizeLegibility;
}

div.table-title {
   display: block;
  margin: auto;
  max-width: 600px;
  padding:5px;
  width: 100%;
}

.table-title h3 {
   color: #fafafa;
   font-size: 30px;
   font-weight: 400;
   font-style:normal;
   font-family: "Roboto", helvetica, arial, sans-serif;
   text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
   text-transform:uppercase;
}


/*** Table Styles **/

.table-fill {
  background: white;
  border-radius:3px;
  border-collapse: collapse;
  height: 320px;
  margin: auto;
  max-width: 600px;
  padding:5px;
  width: 100%;
  box-shadow: 0 5px 10px rgba(0, 0, 0, 0.1);
  animation: float 5s infinite;
}
 
th {
  color:#D5DDE5;;
  background:#1b1e24;
  border-bottom:4px solid #9ea7af;
  border-right: 1px solid #343a45;
  font-size:23px;
  font-weight: 100;
  padding:24px;
  text-align:left;
  text-shadow: 0 1px 1px rgba(0, 0, 0, 0.1);
  vertical-align:middle;
}

th:first-child {
  border-top-left-radius:3px;
}
 
th:last-child {
  border-top-right-radius:3px;
  border-right:none;
}
  
tr {
  border-top: 1px solid #C1C3D1;
  border-bottom: 1px solid #C1C3D1;
  color:#666B85;
  font-size:16px;
  font-weight:normal;
  text-shadow: 0 1px 1px rgba(256, 256, 256, 0.1);
}
 
tr:hover td {
  background:#4E5066;
  color:#FFFFFF;
  border-top: 1px solid #22262e;
}
 
tr:first-child {
  border-top:none;
}

tr:last-child {
  border-bottom:none;
}
 
tr:nth-child(odd) td {
  background:#EBEBEB;
}
 
tr:nth-child(odd):hover td {
  background:#4E5066;
}

tr:last-child td:first-child {
  border-bottom-left-radius:3px;
}
 
tr:last-child td:last-child {
  border-bottom-right-radius:3px;
}
 
td {
  background:#FFFFFF;
  padding:20px;
  text-align:left;
  vertical-align:middle;
  font-weight:300;
  font-size:18px;
  text-shadow: -1px -1px 1px rgba(0, 0, 0, 0.1);
  border-right: 1px solid #C1C3D1;
}

td:last-child {
  border-right: 0px;
}

th.text-left {
  text-align: left;
}

th.text-center {
  text-align: center;
}

th.text-right {
  text-align: right;
}

td.text-left {
  text-align: left;
}

td.text-center {
  text-align: center;
}

td.text-right {
  text-align: right;
}
    
</style>
<body>
<div class="table-title">
<h3>Data Table</h3>
</div>
<table class="table-fill">
<thead>
<tr>
<th class="text-left">Title</th>
<th class="text-left">Value</th>
</tr>
</thead>
<tbody class="table-hover">

<tr>
<td class="text-left">DONOR ID</td>
<td class="text-left"><?php echo $donor_id;?></td>
</tr>
    
<tr>
<td class="text-left">USER ID</td>
<td class="text-left"><?php echo $user_id;?></td>
</tr>

<tr>
<td class="text-left">Donor Name</td>
<td class="text-left"><?php echo $donor_first_name." ".$donor_last_name;?></td>
</tr>

<tr>
<td class="text-left">Phone number</td>
<td class="text-left"><?php echo $donor_phone;?></td>
</tr>

<tr>
<td class="text-left">Blood group</td>
<td class="text-left"><?php echo $donor_blood_group;?></td>
</tr>

<tr>
<td class="text-left">Age</td>
<td class="text-left"><?php echo $donor_age;;?></td>
</tr>

<tr>
<td class="text-left">Organ Submitted</td>
<td class="text-left"><?php echo $donor_organ;?></td>
</tr>
    
<tr onclick="openIdentity()">
<td class="text-left">Identity Document</td>
<td class="text-left"><?php echo $donor_identity;?></td>
</tr>

<tr onclick="openReports()">
<td class="text-left">Medical Reports</td>
<td class="text-left"><?php echo $donor_medical_document;?></td>
</tr>

<tr>
<td class="text-left">Status</td>
<td class="text-left"><?php echo $donor_status;?></td>
</tr>
    <?php
    if($donor_status!=0){
        $query="SELECT * FROM donor_hospital WHERE donor_id=$donor_id";    
        $data=mysqli_query($con, $query);
        $hospital_name="";
//        print_r($data);
        while($row=$data->fetch_array()){
            if($row['status']==1){
            $hid=$row['hospital_id'];
            $query="SELECT hospital_name FROM hospital WHERE hospital_id=$hid";    
            $data1=mysqli_query($con, $query);
            $row1=$data1->fetch_array() ;   
            $hospital_name.=" ".$row1['hospital_name'].",";
        }
        }if($hospital_name==""){
            $hospital_name="Not yet approved!";
        }
        }else if($donor_status==0){
        $hospital_name="Not yet Linked to a hospital";
    }
    ?>
<tr>
<td class="text-left">Hospital</td>
<td class="text-left"><?php echo $hospital_name;?></td>
</tr>    
<tr>
<td class="text-left">Logout</td>
<td class="text-left">		<a href="../login.php?logout=1" style="color: red;">logout</a>
				</td>
</tr>

</tbody>
</table>
    
</body>
    <script>
        function openIdentity() {
            alert("HELLO");
            window.open("http://localhost/blockchain/donor/view_document.php?var=1&value=<?php echo $donor_identity;?>");   
        }
        function openReports() {
            alert("HELLO");
            window.open("http://localhost/blockchain/donor/view_document.php?var=2&value=<?php echo $donor_medical_document;?>");   
        }
      </script>
</html>