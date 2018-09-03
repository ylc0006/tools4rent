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

// for sorting
$field = 'TotalofToolsRented';
$sort = 'DESC';
$sortOrder='';
$sortCustomerID='Customer ID';
$sortFirstName='First Name';
$sortMiddleName='Middle Name';
$sortLastName='Last Name';
$sortEmail='Email';
$sortPhoneNumber='Phone Number';
$sortTotalofReservation='Total # of Reservation';
$sortTotalofToolsRented='Total # of Tools Rented';

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
    if($_GET['field']=='TotalofToolsRented')
    {
        $field='TotalofToolsRented';
        $sortTotalofToolsRented='Total # of Tools Rented ' . $sortOrder;
    }
    elseif($_GET['field']=='CustomerID')
    {
        $field='CustomerID';
        $sortCustomerID='Customer ID ' . $sortOrder;
    }
    elseif($_GET['field']=='FirstName')
    {
        $field='FirstName';
        $sortFirstName='First Name ' . $sortOrder;
    }
    elseif($_GET['field']=='MiddleName')
    {
        $field='MiddleName';
        $sortMiddleName='Middle Name ' . $sortOrder;
    }
    elseif($_GET['field']=='LastName')
    {
        $field='LastName';
        $sortLastName='Last Name ' . $sortOrder;
    }
    elseif($_GET['field']=='Email')
    {
        $field='Email';
        $sortEmail='Email ' . $sortOrder;
    }
    elseif($_GET['field']=='Phone')
    {
        $field='PhoneNumber';
        $sortPhoneNumber='Phone Number' . $sortOrder;
    }
    elseif($_GET['field']=='TotalofReservation')
    {
        $field='TotalofReservation';
        $sortTotalofReservation='Total # of Reservation ' . $sortOrder;
    }
}

    $query = "SELECT CustomerID, FirstName, MiddleName, LastName, Email, PhoneNumber, COUNT(DISTINCT(ReservationID)) AS TotalofReservation , COUNT(ToolID) AS TotalofToolsRented
              FROM
              (SELECT C.CustomerID, C.FirstName, C.MiddleName, C.LastName, C.Email, CONCAT('(', AreaCode, ')' , ' ', MainNumber, '-', Extension ) AS PhoneNumber, Reservation.ReservationID, Been.ToolID
               FROM Customer AS C
               INNER JOIN Reservation ON C.Email = Reservation.Email
               INNER JOIN Been ON Reservation.ReservationID = Been.ReservationID
               INNER JOIN Tools ON Been.ToolID = Tools.ToolID
               WHERE MONTH(Reservation.EndDate) < MONTH(CURDATE()))
               AS Temp
               GROUP BY CustomerId, FirstName, MiddleName, LastName, Email, PhoneNumber
               ORDER BY $field $sort"; //TotalofToolsRented DESC, LastName DESC " ;

    $result = mysqli_query($db, $query);
    include('lib/show_queries.php');



?>

<?php include("lib/header.php"); ?>
<title>Customer Report</title>
</head>

<body>
    <div id="main_container">
        <?php include("lib/clerk_menu.php"); ?>
        <div class="center_content">
          <div class="center_left">
            <div class="features">

              <div class="profile_section">
                  <div class="subtitle">Customer Report</div>
                  <table>
                      <tr>

                          <td class="heading"><a href="customer_report.php?sorting=<?php echo $sort ?>&field=CustomerID"><?php echo $sortCustomerID; ?></td>
                          <td class="heading">View Profile</td>
                          <td class="heading"><a href="customer_report.php?sorting=<?php echo $sort ?>&field=FirstName"><?php echo $sortFirstName; ?></td>
                          <td class="heading"><a href="customer_report.php?sorting=<?php echo $sort ?>&field=MiddleName"><?php echo $sortMiddleName; ?></td>
                          <td class="heading"><a href="customer_report.php?sorting=<?php echo $sort ?>&field=LastName"><?php echo $sortLastName; ?></td>
                          <td class="heading"><a href="customer_report.php?sorting=<?php echo $sort ?>&field=Email"><?php echo $sortEmail; ?></td>
                          <td class="heading"><a href="customer_report.php?sorting=<?php echo $sort ?>&field=PhoneNumber"><?php echo $sortPhoneNumber; ?></td>
                          <td class="heading"><a href="customer_report.php?sorting=<?php echo $sort ?>&field=TotalofReservation"><?php echo $sortTotalofReservation; ?></td>
                          <td class="heading"><a href="customer_report.php?sorting=<?php echo $sort ?>&field=TotalofToolsRented"><?php echo $sortTotalofToolsRented; ?></td>
                      </tr>

                      <?php while ( $CustomerReport = mysqli_fetch_assoc($result)){ ?>

                          <tr>
                            <td><?php echo $CustomerReport['CustomerID']; ?></td>
                            <td><a class="action" href="<?php echo 'view_profile_by_clerk.php?id=' . $CustomerReport['CustomerID']; ?>">View Profile</a></td>
                            <td><?php echo $CustomerReport['FirstName']; ?></td>
                            <td><?php echo $CustomerReport['MiddleName']; ?></td>
                            <td><?php echo $CustomerReport['LastName']; ?></td>
                            <td><?php echo $CustomerReport['Email']; ?></td>
                            <td><?php echo $CustomerReport['PhoneNumber']; ?></td>
                            <td><?php echo $CustomerReport['TotalofReservation']; ?></td>
                            <td><?php echo $CustomerReport['TotalofToolsRented']; ?></td>
                          </tr>

                      <?php  } ?>


                  </table>
              </div>
              <a href="generate_reports.php"> <button type="button" class="btn btn-lg btn-info">Back to Report Menu</button>	</a>
            </div>
       </div>
          <?php include("lib/error.php"); ?>

       <div class="clear"></div>
     </div>
         <?php include("lib/footer.php"); ?>
    </div>
  </body>
