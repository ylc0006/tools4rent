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

// query for clerk name
$query = "SELECT CONCAT(FirstName, ' ', LastName) AS ClerkFullName
FROM Clerk
WHERE ClerkID = (SELECT PickUp_ClerkID
FROM Reservation
WHERE ReservationID = ". $ReservationID . ")"  ;
$result = mysqli_query($db, $query);

include('lib/show_queries.php');

$clerk = mysqli_fetch_assoc($result);

// query for customer name
$query = "SELECT CONCAT(FirstName, ' ', LastName) AS FullName
FROM Customer
WHERE Email = (SELECT Email
FROM Reservation
WHERE ReservationID = " . $ReservationID . ")" ;
$result = mysqli_query($db, $query);

include('lib/show_queries.php');

$customer = mysqli_fetch_assoc($result);

// query for CreditCardNumber
$query = "SELECT CreditCardNumber
FROM Customer
WHERE Customer.Email = (SELECT Email
FROM Reservation
WHERE ReservationID = ". $ReservationID . ")"  ;
$result = mysqli_query($db, $query);

include('lib/show_queries.php');

$CreditCard = mysqli_fetch_assoc($result);

// query for start date, end date
$query = "SELECT StartDate, EndDate
FROM Reservation
WHERE ReservationID = ". $ReservationID ;
$result = mysqli_query($db, $query);

include('lib/show_queries.php');

$Date = mysqli_fetch_assoc($result);

// query for tool info
$query = " SELECT T.ToolID, CONCAT(PowerSource, ' ', SubOption, ' ', SubType) AS ToolName, (0.15 * PurchasePrice) AS RentalPrice, (0.4 * PurchasePrice) AS DepositPrice
FROM Tools T LEFT JOIN Been B ON T.ToolID = B.ToolID
WHERE T.ToolID IN (SELECT ToolID
FROM Been) AND ReservationID = " . $ReservationID ;
$result = mysqli_query($db, $query);

include('lib/show_queries.php');

?>

<?php include("lib/header.php"); ?>
<title>Pickup Confirmation</title>
<script>

      function openToolDetails(id) {
        var table = document.getElementById('reservations-table');
        var tool_id = table.rows[id].cells[0].innerText;
        window.open("http://localhost:8080/tools4rent/script/view_tool_detail.php?id=" + tool_id);
      };

</script>
</head>

<body>
  <div id="main_container">
    <?php include("lib/clerk_menu.php"); ?>
    <div class="center_content">
      <div class="features">
      <div class="profile_section">
        <form name="drop_off_form">
        <div class="subtitle">Pickup Reservation</div>
        <table>
          <tr>
            <td class="item_label">Pick-up Clerk: </td>
            <td>
             <?php echo $clerk['ClerkFullName']; ?>
            </td>
          </tr>
          <tr>
            <td class="item_label">Customer Name: </td>
            <td>
             <?php echo $customer['FullName'];?>
            </td>
          </tr>
          <tr>
            <td class="item_label">Credit Card #:</td>
            <td>
             <?php echo $CreditCard['CreditCardNumber'] ?>
            </td>
          </tr>
          <tr>
            <td class="item_label">Start Date:</td>
            <td>
             <?php echo $Date['StartDate'] ?>
            </td>
          </tr>
          <tr>
            <td class="item_label">End Date:</td>
            <td>
             <?php echo $Date['EndDate'] ?>
            </td>
          </tr>
        </table>
      </div>
      <div class="profile_section">
        <div class="subtitle">Tools</div>
        <table id="reservations-table">
          <tr>
            <td class="heading">Tool ID</td>
            <td class="heading">Tool Name</td>
            <td class="heading">Deposit Price</td>
            <td class="heading">Rental Price</td>
          </tr>
            <?php while ($row = mysqli_fetch_assoc($result)){ ?>
          <tr>
            <td><?php echo $row['ToolID']; ?></td>
            <td><a href="#" onClick="openToolDetails(this.parentElement.parentElement.rowIndex)">
              <?php echo $row['ToolName']; ?></a></td>
            <td><?php echo $row['RentalPrice']; ?></td>
            <td><?php echo $row['DepositPrice']; ?></td>
          </tr>
          <?php	} ?>
        </table>
      </div>
      <div class="profile_section">
        <div class="subtitle">Signatures</div>
        <table>
          <tr>
            <td class="item_label">Pick-up Clerk: ___________________ </td>
            <td>
             <?php echo $clerk['ClerkFullName']; ?>
            </td>
          </tr>
          <tr>
            <td class="item_label">Date: ___________________</td>
          </tr>
          <tr>
            <td class="item_label">Customer Name: ___________________ </td>
            <td>
             <?php echo $customer['FullName'];?>
            </td>
          </tr>
          <tr>
            <td class="item_label">Date: ___________________</td>
          </tr>
        </table>
      </div>

    </div>

      <a href="javascript:window.print()" _fcksavedurl="javascript:window.print()"> <button type="button" class="btn btn-lg btn-info">Print</button>	</a>

    </form>
  </div>
<?php include("lib/error.php"); ?>
 <div class="clear"></div>
</div>
<?php include("lib/footer.php"); ?>
</div>
</body>
