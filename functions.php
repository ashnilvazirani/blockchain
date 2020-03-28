<?php 
session_start();

// connect to database
$db = mysqli_connect('localhost', 'root', '', 'multi_login');

// variable declaration
$username = "";
$email    = "";
$errors   = array(); 

//*********************************************************************************************


//*********************************************************************************************

//*********************************calling the match function*******************************************

if (isset($_POST['match_btn'])) {
	match();
}

// call the register() function if register_btn is clicked

if (isset($_POST['register_btn'])) {
	register();
}


//MATCH THE USERS TO ASSIGN DONOR TO ACCEPTOR
function match()
{
	global $db, $errors, $username, $email;
	$donorname = e($_POST['donor_name']);
	$acceptorname = e($_POST['acceptor_name']);

	// make sure form is filled properly
	if (empty($donorname)) {
		array_push($errors, "Donor Name is required");
	}
	if (empty($acceptorname)) {
		array_push($errors, "Acceptor Name is required");
	}
	
	$query = "SELECT * FROM users WHERE username='$donorname' AND Complete=0 AND user_type='Donor' LIMIT 1 ";
	$results = mysqli_query($db, $query);
	
	$query_acceptor = "SELECT * FROM users WHERE username='$acceptorname' AND Complete=0 AND user_type='Acceptor' LIMIT 1";
		$results_acceptor = mysqli_query($db, $query_acceptor);
		
	//mechanism for same BLOOD GROUPS ********************************************************
	$query_blood_group_acceptor = "SELECT blood_group FROM users WHERE username='$acceptorname' AND Complete=0 AND user_type='Acceptor' LIMIT 1";
	$result_blood_group_acceptor = mysqli_query($db, $query_blood_group_acceptor);
	//echo (string($blood_group_acceptor));
	while ($query_executed = mysqli_fetch_assoc ($result_blood_group_acceptor)) 
    { 
        // these four line is for four column 
        $blood_group_acceptor = $query_executed['blood_group']; 
		//echo $blood_group_acceptor;
    } 
	
	$query_blood_group_donor = "SELECT blood_group FROM users WHERE username='$donorname' AND Complete=0 AND user_type='Donor' LIMIT 1";
	$result_blood_group_donor = mysqli_query($db, $query_blood_group_donor);
	while ($query_executed = mysqli_fetch_assoc ($result_blood_group_donor)) 
    { 
        // these four line is for four column 
        $blood_group_donor = $query_executed['blood_group']; 
		//echo $blood_group_donor;
    }
	
	//mechanism for same  AGE GROUPS ************************************************ 	
	$query_age_group_acceptor = "SELECT age_group FROM users WHERE username='$acceptorname' AND Complete=0 AND user_type='Acceptor' LIMIT 1";
	$result_age_group_acceptor = mysqli_query($db, $query_age_group_acceptor);
	//echo (string($blood_group_acceptor));
	while ($query_executed = mysqli_fetch_assoc ($result_age_group_acceptor)) 
    { 
        // these four line is for four column 
        $age_group_acceptor = $query_executed['age_group']; 
		//echo $age_group_acceptor;
    } 
	
	$query_age_group_donor = "SELECT age_group FROM users WHERE username='$donorname' AND Complete=0 AND user_type='Donor' LIMIT 1";
	$result_age_group_donor = mysqli_query($db, $query_age_group_donor);
	while ($query_executed = mysqli_fetch_assoc ($result_age_group_donor)) 
    { 
        // these four line is for four column 
        $age_group_donor = $query_executed['age_group']; 
		//echo $age_group_donor;
    }
	
	//mechanism for same  ORGAN ************************************************ 	
	$query_organ_acceptor = "SELECT organ FROM users WHERE username='$acceptorname' AND Complete=0 AND user_type='Acceptor' LIMIT 1";
	$result_organ_acceptor = mysqli_query($db, $query_organ_acceptor);
	//echo (string($blood_group_acceptor));
	while ($query_executed = mysqli_fetch_assoc ($result_organ_acceptor)) 
    { 
        // these four line is for four column 
        $organ_acceptor = $query_executed['organ']; 
		//echo $organ_acceptor;
    } 
	
	$query_organ_donor = "SELECT organ FROM users WHERE username='$donorname' AND Complete=0 AND user_type='Donor' LIMIT 1";
	$result_organ_donor = mysqli_query($db, $query_organ_donor);
	while ($query_executed = mysqli_fetch_assoc ($result_organ_donor)) 
    { 
        // these four line is for four column 
        $organ_donor = $query_executed['organ']; 
		//echo $organ_donor;
    }
	
		

	if (mysqli_num_rows($results) == 1  && mysqli_num_rows($results_acceptor) == 1) 
	{
		if($blood_group_donor == $blood_group_acceptor)
		{
			if($age_group_donor == $age_group_acceptor)
			{
				if($organ_donor == $organ_acceptor)
				{
					//header('location: home.php');
					//header('location: /test/test-python-script-run.php');
					//set the inprogress variable to 1
					$query_update_donor_inprogress = "UPDATE users SET inprogress = 1 WHERE username='$donorname'";
					$results_update_donor_inprogress = mysqli_query($db, $query_update_donor_inprogress);
					
					$query_update_acceptor_inprogress = "UPDATE users SET inprogress = 1 WHERE username='$acceptorname'";
					$results_update_acceptor_inprogress = mysqli_query($db, $query_update_acceptor_inprogress);
					//call python		
					$pyscript = 'C:\xampp\htdocs\blockchain\Client.py';
					$python = 'C:\Program Files (x86)\Python36-32\python.exe';	
					$cmd = "$python $pyscript";
					exec("$cmd", $output);
					//echo $output;
							
					$my_command = escapeshellcmd('C:\xampp\htdocs\blockchain\Client.py');
					$command_output = shell_exec($my_command);
					echo $command_output;
					////header('location: /test/test-python-script-run.php');
					//set Complete to 1 from the python code 
					$query_update_donor = "UPDATE users SET Complete = 1 WHERE username='$donorname'";
					$results_update_donor = mysqli_query($db, $query_update_donor);
					
					$query_update_acceptor = "UPDATE users SET Complete = 1 WHERE username='$acceptorname'";
					$results_update_acceptor = mysqli_query($db, $query_update_acceptor);
				}
				else{
					array_push($errors, "Organs being donated and accepted should be same");
				}
			}
			else{
				array_push($errors, "Age Groups should be same");
			}
		}
		else{
			array_push($errors, "Blood Groups should be same");
		}
	}
	else
	{
		array_push($errors, "Please Verify that the entered data is relevant with the database ");
	}
	
}

// REGISTER USER
function register(){
	// call these variables with the global keyword to make them available in function
	global $db, $errors, $username, $email;

	// receive all input values from the form. Call the e() function
    // defined below to escape form values
	$username    =  e($_POST['username']);
	$email       =  e($_POST['email']);
	$password_1  =  e($_POST['password_1']);
	$password_2  =  e($_POST['password_2']);
	$type   =  e($_POST['type']);
//	$blood =  e($_POST['blood']);
//	$age_group = e($_POST['age']);
//	$organ = e($_POST['organ']);
	//echo '$type';

	// form validation: ensure that the form is correctly filled
	if (empty($username)) { 
		array_push($errors, "Username is required"); 
	}
	if (empty($email)) { 
		array_push($errors, "Email is required"); 
	}
	if (empty($password_1)) { 
		array_push($errors, "Password is required"); 
	}
	if ($password_1 != $password_2) {
		array_push($errors, "The two passwords do not match");
	}
	

	// register user if there are no errors in the form
	if (count($errors) == 0) {
		$password = md5($password_1);//encrypt the password before saving in the database
        $query = "INSERT INTO `user_details` (`username`, `user_email`, `user_password`, `user_type`, `user_record_stores`) VALUES ( '$username', '$email', '$password', '$type', '0');";			
			$sql=mysqli_query($db, $query);
            // get id of the created user
			$logged_in_user_id = mysqli_insert_id($db);
        echo $logged_in_user_id;
			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "You are now logged in";
        print_r($_SESSION);
			header('location: index.php');				
		
		}
		
		
		
		//*************************CHANGED CODE*****************************
		/*if (($_POST['type'] == "Donor")) {
			$user_type = e($_POST['user_type']);
			$query = "INSERT INTO donor (username, email, type, password) 
					  VALUES('$username', '$email', '$user_type', '$password')";
			mysqli_query($db, $query);
			// get id of the created user
			$_SESSION['success']  = "New user successfully created!!"+$_POST['type'];
			header('location: home.php');
		}else{
			$query = "INSERT INTO acceptor (username, email, type, password) 
					  VALUES('$username', '$email', '$user_type', '$password')";
			mysqli_query($db, $query);

			// get id of the created user
			$logged_in_user_id = mysqli_insert_id($db);

			$_SESSION['user'] = getUserById($logged_in_user_id); // put logged in user in session
			$_SESSION['success']  = "You are now logged in";
			header('location: index.php');				
		}*/
		//***************************CHANGED CODE ENDS**************************************
		
	}


// return user array from their id
function getUserById($id){
	global $db;
	$query = "SELECT * FROM user_details WHERE user_id=".$id;
	$result = mysqli_query($db, $query);

	$user = mysqli_fetch_assoc($result);
	return $user;
}

// escape string
function e($val){
	global $db;
	return mysqli_real_escape_string($db, trim($val));
}

function display_error() {
	global $errors;

	if (count($errors) > 0){
		echo '<div class="error">';
			foreach ($errors as $error){
				echo $error .'<br>';
			}
		echo '</div>';
	}
}	

function isLoggedIn()
{
	if (isset($_SESSION['user'])) {
		return true;
	}else{
		return false;
	}
}

// log user out if logout button clicked
if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['user']);
	header("location: login.php");
}

// call the login() function if register_btn is clicked
if (isset($_POST['login_btn'])) {
	login();
}

// LOGIN USER
function login(){
	global $db, $username, $errors;

	// grap form values
	$username = e($_POST['username']);
	$password = e($_POST['password']);

	// make sure form is filled properly
	if (empty($username)) {
		array_push($errors, "Username is required");
	}
	if (empty($password)) {
		array_push($errors, "Password is required");
	}

	// attempt login if no errors on form
	if (count($errors) == 0) {
		$password = md5($password);

		$query = "SELECT * FROM user_details WHERE username='$username' AND user_password='$password' LIMIT 1";
		$results = mysqli_query($db, $query);

		if (mysqli_num_rows($results) == 1) { // user found
			// check if user is admin or user
			$logged_in_user = mysqli_fetch_assoc($results);
			if ($logged_in_user['user_type'] == 'admin') {
                
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				header('location: admin/home.php');		  
			}else{
				$_SESSION['user'] = $logged_in_user;
				$_SESSION['success']  = "You are now logged in";
				header('location: index.php');
			}
		}else {
			array_push($errors, "Wrong username/password combination");
		}
	}
}

function isAdmin()
{
	if (isset($_SESSION['user']) && $_SESSION['user']['user_type'] == 'admin' ) {
		return true;
	}else{
		return false;
	}
}