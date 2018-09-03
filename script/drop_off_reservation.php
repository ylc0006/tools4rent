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

// query for tool info
$query = " SELECT T.ToolID, CONCAT(PowerSource, ' ', SubOption, ' ', SubType) AS ToolName, (0.15 * PurchasePrice) AS RentalPrice, (0.4 * PurchasePrice) AS DepositPrice
FROM Tools T LEFT JOIN Been B ON T.ToolID = B.ToolID
WHERE T.ToolID IN (SELECT ToolID
FROM Been) AND ReservationID = " . $ReservationID ;
$result = mysqli_query($db, $query);

include('lib/show_queries.php');


// once drop Off button is pressed
if (is_post_request()) {

    // update reservation table
    $query = "UPDATE Reservation
    SET DropOff_ClerkID = ( SELECT ClerkID FROM Clerk WHERE Email ='" . $email . "') " .
    "WHERE ReservationID = " . $ReservationID  ;

    $result = mysqli_query($db, $query);
    $Link = 'drop_off_confirmation.php?id=' . $ReservationID ;

    include('lib/show_queries.php');

    if ($result === True) {
      redirect_to($Link);
    }

}



?>

<?php include("lib/header.php"); ?>
<title>Drop Off Reservations</title>
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
          <form name="drop_off_form" action="<?php echo 'drop_off_reservation.php?id=' . $ReservationID ; ?>" method="POST">
            <div class="subtitle">Reservation Details</div>
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
                <td class="item_label">Total Due: $</td>
                <td>
                  <?php echo (max($sql_row['TotalRentalPrice'] - $sql_row['TotalDepositPrice'], 0)) ?>
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


        </div>

        <a href="javascript:drop_off_form.submit();"> <button type="button" class="btn btn-lg btn-info">Confirm Drop Off</button>	</a>
      </form>
    </div>
    <?php include("lib/error.php"); ?>

    <div class="clear"></div>
  </div>
  <?php include("lib/footer.php"); ?>
</div>
</body>
