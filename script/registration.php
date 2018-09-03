<?php

include('lib/common.php');

if(is_post_request()) {

	$customer = [];
	$customer['FirstName'] = $_POST['FirstName'] ?? '';
	$customer['MiddleName'] = $_POST['MiddleName'] ?? '';
	$customer['LastName'] = $_POST['LastName'] ?? '';
	$customer['Email'] = $_POST['EmailAddress'] ?? '';
	$customer['Username'] = $_POST['EmailAddress'] ?? '';
	$email = $customer['Email'];
	$customer['Password'] = '';
	if ($_POST['Password'] == $_POST['Password1']) {
		$customer['Password'] = $_POST['Password'] ?? '';
	}

	$customer['Street'] = $_POST['StreetAddress'] ?? '';
	$customer['City'] = $_POST['City'] ?? '';
	$customer['State'] = $_POST['State'] ?? '';
	$customer['ZipCode'] = $_POST['ZipCode'] ?? '';
	$customer['PhoneNumber'] = ''; // primary phone number

	$primary = $_POST['primaryphone'];
	$primaryphone = $_POST[$primary.'Phone'] ?? '';
	$primary_areacode = '';
	$primary_phonenumber = '';
	$primary_extension = '';
	if (!empty($primaryphone)) {
			$primary_areacode = substr($primaryphone, 0, 3);
			$primary_phonenumber = substr($primaryphone, 4, 3) . substr($primaryphone, 8, 4);
			$primary_extension = substr($primaryphone, 13, 4);
	}
	$customer['AreaCode'] = $primary_areacode;
	$customer['MainNumber'] = $primary_phonenumber;
	$customer['Extension'] = $primary_extension;
	$customer['CreditCardNumber'] = str_replace(' ', '', $_POST['CreditCardNumber']) ?? '';
	$customer['NameOnCreditCard'] = $_POST['NameOnCreditCard'] ?? '';
	$customer['CVC'] = $_POST['CVC'] ?? '';
	$customer['ExpirationMonth'] = $_POST['ExpirationMonth'] ?? '';
	$customer['ExpirationYear'] = $_POST['ExpirationYear'] ?? '';

if (!empty($customer['Email'])) {
	$query = "SELECT *
						FROM Customer
						WHERE Email = '". $customer['Email'] . "'" ;
	$result = mysqli_query($db, $query);
	include('lib/show_queries.php');

	if (($result) && (mysqli_num_rows ( $result ) !== 0)){
	array_push($error_msg, "Customer email exist! Please log in or start a new registration!");// "Customer email exist! Please log in or start a new registration!");
	}
}




if (empty($customer['FirstName'])) {
		array_push($error_msg,  "Please enter a first name.");
}

if (empty($customer['MiddleName'])) {
	 array_push($error_msg,  "Please enter a middle name.");
}

if (empty($customer['LastName'])) {
	 array_push($error_msg,  "Please enter a last name.");
}

if (empty($customer['Email'])) {
	 array_push($error_msg,  "Please enter an email address.");
}

if (empty($customer['Password'])) {
	 array_push($error_msg,  "Please enter a password.");
}

if (empty($primaryphone)) {
	 array_push($error_msg,  "Please enter a primary phone.");
}

if (empty($customer['AreaCode'])) {
	 array_push($error_msg,  "Please enter an area code.");
}

if (empty($customer['MainNumber'])) {
	 array_push($error_msg,  "Please enter a main number.");
}

if (empty($customer['Extension'])) {
	 array_push($error_msg,  "Please enter a extension.");
}

if (empty($customer['CreditCardNumber'])) {
	 array_push($error_msg,  "Please enter a credit card number.");
}

if (empty($customer['NameOnCreditCard'])) {
	 array_push($error_msg,  "Please enter a name on credit card.");
}

if (empty($customer['CVC'])) {
	 array_push($error_msg,  "Please enter a CVC.");
}

if (empty($customer['ExpirationMonth'])) {
	 array_push($error_msg,  "Please enter an expiration month.");
}

if (empty($customer['ExpirationYear'])) {
	 array_push($error_msg,  "Please enter an expiration year.");
}

if (preg_match('~[0-9]~', $customer['NameOnCreditCard']) === 1){
	array_push($error_msg,  "Please enter a valid name on credit card");
}

if (preg_match('~[0-9]~', $customer['FirstName']) === 1){
	array_push($error_msg,  "Please enter a valid first name");
}

if (preg_match('~[0-9]~', $customer['MiddleName']) === 1){
	array_push($error_msg,  "Please enter a valid middle name");
}

if (preg_match('~[0-9]~', $customer['LastName']) === 1){
	array_push($error_msg,  "Please enter a valid last name");
}

$email_regex = '/\A[A-Z0-9._%+-]+@[A-Z0-9.-]+\.[A-Z]{2,}\Z/i';
if (preg_match($email_regex, $customer['Email']) !== 1 AND !empty($customer['Email'])){
	 array_push($error_msg,  "Please enter a valid email address");
}

if (has_length_greater_than($customer['CVC'], 3)){
	array_push($error_msg,  "CVC cannot have length greater than 3");
}

if(preg_match("/[a-z]/i", $customer['CVC'])){
	array_push($error_msg,  "CVC cannot contain letters");
}

			$phones = array('Home', 'Work', 'Cell');
			foreach ($phones as $phone){
				$phone_complete = $_POST[$phone.'Phone'] ?? '';
				if (!empty($phone_complete)) {
				$area_c = substr($phone_complete, 0, 3);
				$main_n = substr($phone_complete, 4, 3) . substr($phone_complete, 8, 4);
				$exten_n = substr($phone_complete, 13, 4);
				$query = 'INSERT INTO Phone (Email, PhoneType, AreaCode, MainNumber, Extension) VALUES ' ;
				$query = $query . "('" . $email . "', ";
				$query = $query. "'" . $phone . ' Phone' . "',";
				$query = $query. $area_c . ",";
				$query = $query. $main_n . ",";
				$query = $query. $exten_n . ')';
				$result = mysqli_query($db, $query);
				include('lib/show_queries.php');
				}
			}


			// insert into customer table

			$query = "INSERT INTO customer ";
			$query .= "(FirstName, MiddleName, LastName, Email, Username, Password ,Street, City, State, ZipCode, AreaCode, MainNumber, Extension, CreditCardNumber, NameOnCreditCard, CVC, ExpirationMonth, ExpirationYear) ";
			$query  .= "VALUES (";
			$query .= "'" . db_escape($db,$customer['FirstName']) . "',";
			$query  .= "'" . db_escape($db,$customer['MiddleName']) . "',";
			$query  .= "'" . db_escape($db,$customer['LastName']) . "',";
			$query  .= "'" . db_escape($db,$customer['Email']) . "',";
			$query  .= "'" . db_escape($db,$customer['Username']) . "',";
			$query  .= "'" . db_escape($db,$customer['Password']) . "',";
			$query  .= "'" . db_escape($db,$customer['Street']) . "',";
			$query  .= "'" . db_escape($db,$customer['City']) . "',";
			$query  .= "'" . db_escape($db,$customer['State']) . "',";
			$query  .= "'" . db_escape($db,$customer['ZipCode']) . "',";
			$query  .= "'" . db_escape($db,$customer['AreaCode']) . "',";
			$query  .= "'" . db_escape($db,$customer['MainNumber']) . "',";
			$query  .= "'" . db_escape($db,$customer['Extension']) . "',";
			$query  .= "'" . db_escape($db,$customer['CreditCardNumber']) . "',";
			$query  .= "'" . db_escape($db,$customer['NameOnCreditCard']) . "',";
			$query  .= "'" . db_escape($db,$customer['CVC']) . "',";
			$query  .= "'" . db_escape($db,$customer['ExpirationMonth']) . "',";
			$query  .= "'" . db_escape($db,$customer['ExpirationYear']) . "'";
			$query  .= ")";
			if (empty($error_msg)){
				$results = mysqli_query($db, $query );
			}
			include('lib/show_queries.php');

		/*	if($results === true) {
				redirect_to('registration_complete.php');
			} else {
				$errors = $results;
			} */



		}






		?>

		<!doctype html>

		<html lang="en">
		<?php include("lib/header.php"); ?>
		<title>Tools-4-Rent!</title>
	</head>
	<head>
		<title>Customer Registration Form</title>
		<meta charset="utf-8">
	</head>

	<body>
		<div id="main_container">
			<div id="header">
				<div class="logo">
					<img src="img/tools4rent_logo.png" width="820" height="100" style="opacity:0.5;background-color:E9E5E2;" border="0" alt=""     title="Tools4Rent Logo">
				</div>
			</div>
			<div class="center_content">
				<h1 class="well">Customer Registration Form</h1>
				<?php echo display_errors($errors); ?>

				<div class="col-lg-12 well">
					<div class="row">
						<form name="registrationform" action="registration.php" method="post">
							<div class="col-sm-12">
								<div class="row">
									<div class="col-sm-4 form-group">
										<input type="text" placeholder="First Name" class="form-control" name="FirstName">
									</div>
									<div class="col-sm-4 form-group">
										<input type="text" placeholder="Middle Name" class="form-control" name="MiddleName">
									</div>
									<div class="col-sm-4 form-group">
										<input type="text" placeholder="Last Name" class="form-control" name="LastName">
									</div>
								</div>
								<script src="js/jquery-3.2.1.js" type="text/javascript"></script>
								<script src="js/jquery.maskedinput.js" type="text/javascript"></script>
								<script type="text/javascript">
									jQuery(function($) {
										$('#HomePhone').mask("999-999-9999?x9999");
										$('#WorkPhone').mask("999-999-9999?x9999");
										$('#CellPhone').mask("999-999-9999?x9999");
										$('#ZipCode').mask("99999-9999");
										$('#CreditCardNumber').mask("9999 9999 9999 9999");
									})
								</script>
								<div class="row">
									<div class="col-sm-4 form-group">
										<input type="text" id="HomePhone" name="HomePhone" placeholder="Home Phone" class="form-control">
									</div>
									<div class="col-sm-4 form-group">
										<input type="text" id="WorkPhone" name="WorkPhone" placeholder="Work Phone" class="form-control">
									</div>
									<div class="col-sm-4 form-group">
										<input type="text" id="CellPhone" name="CellPhone" placeholder="Cell Phone" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label>Primary Phone :</label>
									<label class="radio-inline"><input type="radio" name="primaryphone" value="Home" checked="checked"> Home Phone </label>
									<label class="radio-inline"><input type="radio" name="primaryphone" value="Work"> Work Phone </label>
									<label class="radio-inline"><input type="radio" name="primaryphone" value="Cell"> Cell Phone </label>
								</div>
								<div class="row">
									<div class="col-sm-12 form-group">
										<input type="email" placeholder="Email Address" class="form-control" name="EmailAddress">
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6 form-group">
										<input type="password" placeholder="Password" class="form-control" name="Password">
									</div>
									<div class="col-sm-6 form-group">
										<input type="password" placeholder="Re-type Password" class="form-control" name="Password1">
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12 form-group">
										<input type="text" placeholder="Street Address" class="form-control" name="StreetAddress">
									</div>
								</div>
								<div class="row">
									<div class="col-sm-4 form-group">
										<input type="text" placeholder="City" class="form-control" name="City">
									</div>
									<div class="col-sm-4 form-group">
										<select class="form-control" name="State">
											<option value="State" disabled selected>State</option>
											<option value="AL">Alabama</option>
											<option value="AK">Alaska</option>
											<option value="AZ">Arizona</option>
											<option value="AR">Arkansas</option>
											<option value="CA">California</option>
											<option value="CO">Colorado</option>
											<option value="CT">Connecticut</option>
											<option value="DE">Delaware</option>
											<option value="DC">District Of Columbia</option>
											<option value="FL">Florida</option>
											<option value="GA">Georgia</option>
											<option value="HI">Hawaii</option>
											<option value="ID">Idaho</option>
											<option value="IL">Illinois</option>
											<option value="IN">Indiana</option>
											<option value="IA">Iowa</option>
											<option value="KS">Kansas</option>
											<option value="KY">Kentucky</option>
											<option value="LA">Louisiana</option>
											<option value="ME">Maine</option>
											<option value="MD">Maryland</option>
											<option value="MA">Massachusetts</option>
											<option value="MI">Michigan</option>
											<option value="MN">Minnesota</option>
											<option value="MS">Mississippi</option>
											<option value="MO">Missouri</option>
											<option value="MT">Montana</option>
											<option value="NE">Nebraska</option>
											<option value="NV">Nevada</option>
											<option value="NH">New Hampshire</option>
											<option value="NJ">New Jersey</option>
											<option value="NM">New Mexico</option>
											<option value="NY">New York</option>
											<option value="NC">North Carolina</option>
											<option value="ND">North Dakota</option>
											<option value="OH">Ohio</option>
											<option value="OK">Oklahoma</option>
											<option value="OR">Oregon</option>
											<option value="PA">Pennsylvania</option>
											<option value="RI">Rhode Island</option>
											<option value="SC">South Carolina</option>
											<option value="SD">South Dakota</option>
											<option value="TN">Tennessee</option>
											<option value="TX">Texas</option>
											<option value="UT">Utah</option>
											<option value="VT">Vermont</option>
											<option value="VA">Virginia</option>
											<option value="WA">Washington</option>
											<option value="WV">West Virginia</option>
											<option value="WI">Wisconsin</option>
											<option value="WY">Wyoming</option>
										</select>
									</div>
									<div class="col-sm-4 form-group">
										<input type="text" id="ZipCode" name="ZipCode" placeholder="Zip Code" class="form-control">
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6 form-group">
										<input type="text" placeholder="Name on Credit Card" class="form-control" name="NameOnCreditCard">
									</div>
									<div class="col-sm-6 form-group">
										<input type="text" id="CreditCardNumber" name="CreditCardNumber" placeholder="Credit Card #" class="form-control">
									</div>
								</div>
								<div class="row">
									<div class="col-sm-4 form-group">
										<select class="form-control" name="ExpirationYear">
											<option value="ExpirationYear" disabled selected>Expiration Year</option>
											<option value="2017">2017</option>
											<option value="2018">2018</option>
											<option value="2019">2019</option>
											<option value="2020">2020</option>
											<option value="2021">2021</option>
											<option value="2022">2022</option>
											<option value="2023">2023</option>
											<option value="2024">2024</option>
											<option value="2025">2025</option>
											<option value="2026">2026</option>
											<option value="2027">2027</option>
										</select>
									</div>
									<div class="col-sm-4 form-group">
										<select class="form-control" name="ExpirationMonth">
											<option value="ExpirationMonth" disabled selected>Expiration Month</option>
											<option value="01">January</option>
											<option value="02">February</option>
											<option value="03">March</option>
											<option value="04">April</option>
											<option value="05">May</option>
											<option value="06">June</option>
											<option value="07">July</option>
											<option value="08">August</option>
											<option value="09">September</option>
											<option value="10">October</option>
											<option value="11">November</option>
											<option value="12">December</option>
										</select>
									</div>
									<div class="col-sm-4 form-group">
										<input type="text" placeholder="CVC" class="form-control" name="CVC">
									</div>
								</div>
								<a href="javascript:registrationform.submit();"><button type="button" class="btn btn-lg btn-info">Submit</button></a>
								<a href="login.php"><button type="button" class="btn btn-lg btn-secondary">Back</button></a>
							</div>
						</form>
					</div>
				</div>
				<?php include("lib/error.php"); ?>
				<div class="clear"></div>
			</div>
			<?php include("lib/footer.php"); ?>
		</div>
	</body>
	</html>
