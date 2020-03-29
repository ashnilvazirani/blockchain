<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
body {
  font-family: "Lato", sans-serif;
}

.sidenav {
  height: 100%;
  width: 260px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 20px;
}

.sidenav a {
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
}

.sidenav a:hover {
  color: #f1f1f1;
}

.main {
  margin-left: 160px; /* Same as the width of the sidenav */
  font-size: 28px; /* Increased text to enable scrolling */
  padding: 0px 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 15px;}
  .sidenav a {font-size: 18px;}
}
</style>
</head>
<body>

<div class="sidenav">
    <a href="http://localhost/blockchain/admin/home.php">-Home</a>
  <a href="http://localhost/blockchain/admin/hospital/add_hospital_details.php">-Add hosiptal</a>
  <a href="http://localhost/blockchain/admin/hospital/view_hospital_list.php">-View Hospitals</a>
  <a href="http://localhost/blockchain/admin/approve_doctor.php">-Approve Doctor</a>
  <a href="http://localhost/blockchain/admin/view_list_doctors.php">-View Doctor</a>
  <a href="http://localhost/blockchain/admin/doctor_hospital.php">-Doctor-Hospital Link</a>
    <a href="http://localhost/blockchain/admin/approve_donor_hospital.php">-Donor-Hospital Request</a>
    <a href="http://localhost/blockchain/admin/donor_hospital_doctor.php">-Donor-Hospital-Doctor</a>
     <a href="http://localhost/blockchain/admin/approve_patient_hospital.php">-Patient-Hospital Request</a>
     <a href="http://localhost/blockchain/admin/patient_hospital_doctor.php">-Patient-Hospital-Doctor</a>
    <a href="http://localhost/blockchain/admin/view_doctor_hospital.php">-Doctor-Hospital View</a>
</div>   
</body>
</html> 
