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

$field = 'CustomerID';
$sort = 'DESC';
$sortOrder='';
$sortReservationID='Reservation ID';
$sortCustomer='Customer';
$sortCustomerID='CustomerID';
$sortStartDate='Start Date';
$sortEndDate='End Date';

if(isset($_GET['sorting']))
{
    if($_GET['sorting']=='ASC')
    {
        $sort='DESC';
        $sortOrder=' &#8595';
    }
    else
    {
        $sort='ASC';
        $sortOrder=' &#8593';
    }
}

if(isset($_GET['field']))
{
    if($_GET['field']=='ReservationID')
    {
        $field='ReservationID';
        $sortTotalofToolsRented='Reservation ID ' . $sortOrder;
    }
    elseif($_GET['field']=='Customer')
    {
        $field='Customer';
        $sortCustomerID='Customer ' . $sortOrder;
    }
    elseif($_GET['field']=='CustomerID')
    {
        $field='CustomerID';
        $sortFirstName='Customer ID ' . $sortOrder;
    }
    elseif($_GET['field']=='StartDate')
    {
        $field='StartDate';
        $sortMiddleName='Start Date ' . $sortOrder;
    }
    elseif($_GET['field']=='EndDate')
    {
        $field='EndDate';
        $sortLastName='End Date ' . $sortOrder;
    }
}

  $query = "SELECT R.ReservationID, CONCAT(C.FirstName, ' ' ,C.LastName) AS Customer , C.CustomerID, R.StartDate, R.EndDate
            FROM Customer AS C
            INNER JOIN Reservation AS R
            ON C.Email = R.Email
            WHERE R.PickUp_ClerkID IS NULL
            ORDER BY $field $sort" ;

  $result = mysqli_query($db, $query);
  include('lib/show_queries.php');

  if (is_post_request()) {
    $ReservationID = $_POST['ReservationID'];
    $Link = 'pick_up_reservation.php?id=' . $ReservationID ;
    redirect_to($Link);
  }



?>

<?php include("lib/header.php"); ?>
<title>Pick Up Reservations</title>
</head>

<body>
    <div id="main_container">
        <?php include("lib/clerk_menu.php"); ?>
        <div class="center_content">
        <div class="features">

          <div class="profile_section">
            <form name="searchform" action="pick_up.php" method="POST">
              <div class="subtitle">Pickup Reservation</div>
              <table>
                  <tr>
                    <td class="heading"><a href="pick_up.php?sorting=<?php echo $sort ?>&field=ReservationID"><?php echo $sortReservationID; ?></td>
                    <td class="heading"><a href="pick_up.php?sorting=<?php echo $sort ?>&field=Customer"><?php echo $sortCustomer; ?></td>
                    <td class="heading"><a href="pick_up.php?sorting=<?php echo $sort ?>&field=CustomerID"><?php echo $sortCustomerID; ?></td>
                    <td class="heading"><a href="pick_up.php?sorting=<?php echo $sort ?>&field=StartDate"><?php echo $sortStartDate; ?></td>
                    <td class="heading"><a href="pick_up.php?sorting=<?php echo $sort ?>&field=EndDate"><?php echo $sortEndDate; ?></td>
                  </tr>

                  <?php while ( $Pickup = mysqli_fetch_assoc($result)){ ?>

                      <tr>
                        <td><?php echo $Pickup['ReservationID']; ?></td>
                        <td><?php echo $Pickup['Customer']; ?></td>
                        <td><?php echo $Pickup['CustomerID']; ?></td>
                        <td><?php echo $Pickup['StartDate']; ?></td>
                        <td><?php echo $Pickup['EndDate']; ?></td>
                      </tr>

                  <?php  } ?>


              </table>

          </div>
          <div class="row">
            <div class="col-sm-4 form-group">
              <input type="text" placeholder="Enter Reservation ID" class="form-control" name="ReservationID">
            </div>
            </form>
          </div>
          <a href="javascript:searchform.submit();"><button type="button" class="btn btn-lg btn-info">Pick Up</button></a>
       </div>
     </div>
         <?php include("lib/footer.php"); ?>
    </div>
  </body>
