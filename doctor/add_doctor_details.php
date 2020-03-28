<!DOCTYPE html>

<html>
<head>
<style>
*{
  box-sizing: border-box;
}

input[type=text], select, textarea {
  width: 100%;
  padding: 12px;
  border: 1px solid #ccc;
  border-radius: 4px;
  resize: vertical;
}

label {
  padding: 12px 12px 12px 0;
  display: inline-block;
}

input[type=submit] {
  background-color: #4CAF50;
  color: white;
  padding: 12px 20px;
  border: none;
  border-radius: 4px;
  cursor: pointer;
  float: right;
}

input[type=submit]:hover {
  background-color: #45a049;
}

.container {
  border-radius: 5px;
  background-color: #f2f2f2;
  padding: 20px;
}

.col-25 {
  float: left;
  width: 25%;
  margin-top: 6px;
}

.col-75 {
  float: left;
  width: 75%;
  margin-top: 6px;
}

/* Clear floats after the columns */
.row:after {
  content: "";
  display: table;
  clear: both;
}

/* Responsive layout - when the screen is less than 600px wide, make the two columns stack on top of each other instead of next to each other */
@media screen and (max-width: 600px) {
  .col-25, .col-75, input[type=submit] {
    width: 100%;
    margin-top: 0;
  }
}
</style>
</head>
<?php
include_once("save_doctor.php");    
?>
<body>


<div class="container">
 <form method="post" role="form" enctype="multipart/form-data" action="save_doctor.php"> 
 <div class="row">
    <div class="col-25">
      <label for="doctor_first_name">First Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="doctor_first_name" name="doctor_first_name" placeholder="Your name..">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="doctor_last_name">Last Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="doctor_last_name" name="doctor_last_name" placeholder="Your family name..">
    </div>
  </div>
<div class="row">
    <div class="col-25">
      <label for="doctor_phone">Phone Number</label>
    </div>
    <div class="col-75">
      <input type="text" id="doctor_phone" name="doctor_phone" placeholder="Your contact number..">
    </div>
  </div>
      <div class="row">
    <div class="col-25">
      <label for="doctor_address">Address</label>
    </div>
    <div class="col-75">
      <textarea id="doctor_address" name="doctor_address" placeholder="Enter your residential address.." style="height:100px"></textarea>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="doctor_blood_group">Blood Group</label>
    </div>
    <div class="col-75">
      <select id="doctor_blood_group" name="doctor_blood_group">
        <option value="A">A</option>
        <option value="A+">A+</option>
        <option value="A-">A-</option>
          <option value="B">B</option>
          <option value="B+">B+</option>
          <option value="B-">B-</option>
          <option value="O+">O+</option>
          <option value="O-">O-</option>
          <option value="AB-">AB-</option>
          <option value="AB+">AB+</option>
      </select>
    </div>
  </div>
      <div class="row">
    <div class="col-25">
      <label for="doctor_age">Age</label>
    </div>
    <div class="col-75">
      <input type="text" id="doctor_age" name="doctor_age" placeholder="Your age..">
    </div>
  </div>

<div class="row">
    <div class="col-25">
      <label for="doctor_qualification">Qualification</label>
    </div>
    <div class="col-75">
      <input type="text" id="doctor_qualification" name="doctor_qualification" placeholder="Your qualification..">
    </div>
  </div>
     
     <div class="row">
    <div class="col-25">
      <label for="doctor_speciality">Speciality</label>
    </div>
    <div class="col-75">
      <input type="text" id="doctor_speciality" name="doctor_speciality" placeholder="You are special in?..">
    </div>
  </div>

<div class="row">
    <div class="col-25">
      <label for="pdf_file1">Identity Document</label>
    </div>
    <div class="col-75"><input type="file" name="pdf_file1" id="pdf_file1" accept="application/pdf" />
	    </div>
  </div>
      
         <div class="row">
    <div class="col-25">
      <label for="pdf_file">Medical Identity Documents</label>
    </div>
    <div class="col-75">
 <input type="file" name="pdf_file" id="pdf_file" accept="application/pdf" />
	 </div>
  </div>
      
  <div class="row">
    <div class="col-25">
      <label for="doctor_additional_comments">Some Additional Comments</label>
    </div>
    <div class="col-75">
      <textarea id="doctor_additional_comments" name="doctor_additional_comments" placeholder="Please enter something additional you'd wish to share with us.." style="height:200px"></textarea>
    </div>
  </div>
  <div class="row">
    <input type="submit" value="save_doctor_details" name="save_doctor_details">
  </div>
  </form>
</div>

</body>
</html>
