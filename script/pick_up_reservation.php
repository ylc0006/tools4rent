<?php

include('lib/common.php');

if(isset($_POST['login'])) {
  header('Location: login.php');
  exit();
}

if (!isset($_SESSION['email'])) {
	header('Location: login.php');
	exit();
}

$ReservationID = $_GET['id'];
$email = $_SESSION['email'];

// query for ReservationID & Customer Name
$query = "SELECT R.ReservationID, CONCAT(C.FirstName, ' ', C.LastName) AS CustomerName
FROM Customer AS C
INNER JOIN Reservation AS R
ON C.Email = R.Email
WHERE R.ReservationID =" . $ReservationID ;

$result = mysqli_query($db, $query);

include('lib/show_queries.php');

$row = mysqli_fetch_assoc($result);

// query for total deposit and total rental price
$sql = "SELECT SUM(0.15 * PurchasePrice) AS TotalRentalPrice, SUM(0.4 * PurchasePrice) AS TotalDepositPrice
FROM Tools
WHERE ToolID IN (SELECT ToolID
FROM Been
WHERE ReservationID =" . $ReservationID . ") " ;

$result = mysqli_query($db, $sql);

include('lib/show_queries.php');

$sql_row = mysqli_fetch_assoc($result);

// once confirmation pick up button is pressed
if (is_post_request()) {

  $CreditCardType =  $_POST['CreditCard'];

      // if use existing CreditCard
  if ($CreditCardType == ExistingCreditCard) {
            // update reservation table
    $query = "UPDATE Reservation
    SET PickUp_ClerkID = ( SELECT ClerkID FROM Clerk WHERE Email ='" . $email . "') " .
    "WHERE ReservationID = " . $ReservationID  ;

    $result = mysqli_query($db, $query);
    $Link = 'pick_up_confirmation.php?id=' . $ReservationID ;

    include('lib/show_queries.php');

    if ($result === True) {
      redirect_to($Link);
    }
  }

      // if use new CreditCard
  if ($CreditCardType == NewCreditCard) {
    $NameOnCreditCard = $_POST['NameOnCreditCard'] ?? '';
    $CreditCardNumber = $_POST['CreditCardNumber'] ?? '';
    $ExpirationYear = $_POST['ExpirationYear'] ?? '';
    $ExpirationMonth = $_POST['ExpirationMonth'] ?? '';
    $CVC = $_POST['CVC'] ?? '';

    if (empty($CreditCardNumber)) {
    	 array_push($error_msg,  "Please enter a credit card number.");
    }

    if (empty($NameOnCreditCard)) {
    	 array_push($error_msg,  "Please enter a name on credit card.");
    }

    if (empty($CVC)) {
    	 array_push($error_msg,  "Please enter a CVC.");
    }

    if (empty($ExpirationMonth)) {
    	 array_push($error_msg,  "Please enter an expiration month.");
    }

    if (empty($ExpirationYear)) {
    	 array_push($error_msg,  "Please enter an expiration year.");
    }

    if (preg_match('~[0-9]~', $NameOnCreditCard) === 1){
    	array_push($error_msg,  "Please enter a valid name on credit card");
    }

    if(preg_match("/[a-z]/i", $CVC)){
    	array_push($error_msg,  "CVC cannot contain letters");
    }

    if(preg_match("/[a-z]/i", $CreditCardNumber)){
    	array_push($error_msg,  "Credit card number cannot contain letters");
    }

    if (has_length_greater_than($CVC, 3)){
    	array_push($error_msg,  "CVC cannot have length greater than 3");
    }

    if (!has_length_exactly($CreditCardNumber, 16)){
    	array_push($error_msg,  "Credit card number must be 16 numbers");
    }





            // Update CreditCard Info
    $query = "UPDATE Customer
    SET NameOnCreditCard = '" . $NameOnCreditCard . "' ,  CreditCardNumber = '" . $CreditCardNumber . "', ExpirationYear = '" . $ExpirationYear . "', ExpirationMonth = '" . $ExpirationMonth . "' , CVC = '" . $CVC . "' " .
    "WHERE Email = (SELECT Email FROM Reservation WHERE ReservationID = " . $ReservationID . ")" ;
    if (empty($error_msg)){
      $result = mysqli_query($db, $query );
    }
    include('lib/show_queries.php');

            // update reservation table
    $query = "UPDATE Reservation
    SET PickUp_ClerkID = ( SELECT ClerkID FROM Clerk WHERE Email ='" . $email . "') " .
    "WHERE ReservationID = " . $ReservationID  ;

    if (empty($error_msg)){
      $result = mysqli_query($db, $query );
    }

    $Link = 'pick_up_confirmation.php?id=' . $ReservationID ;

    include('lib/show_queries.php');

    if ($result === True) {
      redirect_to($Link);
    }
  }

}



?>

<?php include("lib/header.php"); ?>
<title>Pick Up Reservations</title>
<script>
  function creditCardUpdate(str) {
    document.getElementById('NewCreditCard_ID').style.display="none";
    if (str == 'NewCreditCard') {
      document.getElementById('NewCreditCard_ID').style.display = "block";
    }
  }
</script>
</head>

<body>
  <div id="main_container">
    <?php include("lib/clerk_menu.php"); ?>
    <div class="center_content">
      <div class="features">
        <div class="profile_section">
          <form name="pick_up_form" action="<?php echo 'pick_up_reservation.php?id=' . $ReservationID ; ?>" method="POST">
            <div class="subtitle">Reservation Info</div>
            <table>
              <tr>
                <td class="item_label">Reservation ID: </td>
                <td>
                  <?php echo $row['ReservationID']; ?>
                </td>
              </tr>
              <tr>
                <td class="item_label">Customer Name: </td>
                <td>
                  <?php echo $row['CustomerName'];?>
                </td>
              </tr>
              <tr>
                <td class="item_label">Total Deposit: $</td>
                <td>
                  <?php echo $sql_row['TotalDepositPrice'] ?>
                </td>
              </tr>
              <tr>
                <td class="item_label">Total Rental Price: $</td>
                <td>
                  <?php echo $sql_row['TotalRentalPrice'] ?>
                </td>
              </tr>
              <tr>
                <td class="item_label">Credit Card:</td>
                <td>
                  <label class="col-sm-2 radio-inline"><input type="radio" name="CreditCard" value="ExistingCreditCard" checked="checked" onclick="creditCardUpdate(this.value)" >Existing</label>
                  <label class="col-sm-2 radio-inline"><input type="radio" name="CreditCard" value="NewCreditCard" onclick="creditCardUpdate(this.value)">New</label>
                </td>
              </tr>
            </table>
          </div>

          <div class="form-group" id="NewCreditCard_ID" style="display: none">
            <div class="row">
              <div class="col-sm-6 form-group">
                <input type="text" placeholder="Name on Credit Card" class="form-control" name="NameOnCreditCard">
              </div>
              <div class="col-sm-6 form-group">
                <input type="text" placeholder="Credit Card #" class="form-control" name="CreditCardNumber">
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
          </div>
        </div>

        <a href="javascript:pick_up_form.submit();"> <button type="button" class="btn btn-lg btn-info">Confirm Pick Up</button>	</a>
      </form>
    </div>
    <?php include("lib/error.php"); ?>

    <div class="clear"></div>
  </div>
  <?php include("lib/footer.php"); ?>
</div>
</body>
