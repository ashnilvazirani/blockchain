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
include_once("save_donor.php");    
?>
<body>


<div class="container">
 <form method="post" role="form" enctype="multipart/form-data" action="save_donor.php"> 
 <div class="row">
    <div class="col-25">
      <label for="donor_first_name">First Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="donor_first_name" name="donor_first_name" placeholder="Your name..">
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="donor_last_name">Last Name</label>
    </div>
    <div class="col-75">
      <input type="text" id="donor_last_name" name="donor_last_name" placeholder="Your family name..">
    </div>
  </div>
<div class="row">
    <div class="col-25">
      <label for="donor_phone">Phone Number</label>
    </div>
    <div class="col-75">
      <input type="text" id="donor_phone" name="donor_phone" placeholder="Your contact number..">
    </div>
  </div>
      <div class="row">
    <div class="col-25">
      <label for="donor_address">Address</label>
    </div>
    <div class="col-75">
      <textarea id="donor_address" name="donor_address" placeholder="Enter your residential address.." style="height:100px"></textarea>
    </div>
  </div>
  <div class="row">
    <div class="col-25">
      <label for="donor_blood_group">Blood Group</label>
    </div>
    <div class="col-75">
      <select id="donor_blood_group" name="donor_blood_group">
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
      <label for="donor_age">Age</label>
    </div>
    <div class="col-75">
      <input type="text" id="donor_age" name="donor_age" placeholder="Your age..">
    </div>
  </div>

<div class="row">
    <div class="col-25">
      <label for="donor_organ">Organ</label>
    </div>
    <div class="col-75">
      <input type="text" id="donor_organ" name="donor_organ" placeholder="Your organ..">
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
      <label for="pdf_file">Medical Documents</label>
    </div>
    <div class="col-75">
 <input type="file" name="pdf_file" id="pdf_file" accept="application/pdf" />
	 </div>
  </div>
      
  <div class="row">
    <div class="col-25">
      <label for="donor_additional_comments">Some Additional Comments</label>
    </div>
    <div class="col-75">
      <textarea id="donor_additional_comments" name="donor_additional_comments" placeholder="Please enter something additional you'd wish to share with us.." style="height:200px"></textarea>
    </div>
  </div>
  <div class="row">
    <input type="submit" value="save_donor_details" name="save_donor_details">
  </div>
  </form>
</div>

</body>
</html>
