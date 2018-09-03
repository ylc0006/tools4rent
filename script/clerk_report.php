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
    $field = 'CombinedTotal';
    $sort = 'DESC';
    $sortOrder='';
    $sortCombinedTotal='Combined Total';
    $sortClerkID='Clerk ID';
    $sortFirstName='First Name';
    $sortMiddleName='Middle Name';
    $sortLastName='Last Name';
    $sortEmail='Email';
    $sortHireDate='Hire Date';
    $sortNumberOfPickups='Number of Pickups';
    $sortNumberofDropoff='Number of Dropoffs';

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
        if($_GET['field']=='CombinedTotal')
        {
            $field='CombinedTotal';
            $sortCombinedTotal='Combined Total ' . $sortOrder;
        }
        elseif($_GET['field']=='ClerkID')
        {
            $field='ClerkID';
            $sortClerkID='Clerk ID ' . $sortOrder;
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
        elseif($_GET['field']=='DateOfHire')
        {
            $field='DateOfHire';
            $sortHireDate='Hire Date ' . $sortOrder;
        }
        elseif($_GET['field']=='NumberofPickup')
        {
            $field='NumberofPickup';
            $sortNumberOfPickups='Number Of Pickups ' . $sortOrder;
        }
        elseif($_GET['field']=='NumberofDropoff')
        {
            $field='NumberofDropoff';
            $sortNumberofDropoff='Number of Dropoffs ' . $sortOrder;
        }
    }

    $email = $_SESSION['email'];


    $query = "SELECT l.*, COUNT(R2.ReservationID) AS NumberofDropoff, (NumberofPickup + COUNT(R2.ReservationID)) AS CombinedTotal
              FROM
              (SELECT C.ClerkID, C.Firstname, C.MiddleName, C.LastName, C.Email, C.DateOfHire, COUNT(R1.Pickup_ClerkID) AS NumberofPickup
                FROM Clerk AS C
                LEFT JOIN Reservation AS R1
                ON C.ClerkID = R1.Pickup_ClerkID
                GROUP BY C.ClerkID) AS l
              LEFT JOIN Reservation AS R2
              ON l.ClerkID = R2.Dropoff_ClerkID
              GROUP BY l.ClerkID
              ORDER BY $field $sort " ;

    $result = mysqli_query($db, $query);
    include('lib/show_queries.php');


?>

<?php include("lib/header.php"); ?>
<title>Clerk Report</title>
</head>

<body>
    <div id="main_container">
        <?php include("lib/clerk_menu.php"); ?>
        <div class="center_content">
        <div class="features">

          <div class="profile_section">
              <div class="subtitle">Clerk Report</div>
              <table>
                  <tr>
                      <td class="heading"><a href="clerk_report.php?sorting=<?php echo $sort ?>&field=ClerkID"><?php echo $sortClerkID; ?></td>
                      <td class="heading"><a href="clerk_report.php?sorting=<?php echo $sort ?>&field=FirstName"><?php echo $sortFirstName; ?></td>
                      <td class="heading"><a href="clerk_report.php?sorting=<?php echo $sort ?>&field=MiddleName"><?php echo $sortMiddleName; ?></td>
                      <td class="heading"><a href="clerk_report.php?sorting=<?php echo $sort ?>&field=LastName"><?php echo $sortLastName; ?></td>
                      <td class="heading"><a href="clerk_report.php?sorting=<?php echo $sort ?>&field=Email"><?php echo $sortEmail; ?></td>
                      <td class="heading"><a href="clerk_report.php?sorting=<?php echo $sort ?>&field=DateOfHire"><?php echo $sortHireDate; ?></td>
                      <td class="heading"><a href="clerk_report.php?sorting=<?php echo $sort ?>&field=NumberofPickup"><?php echo $sortNumberOfPickups; ?></td>
                      <td class="heading"><a href="clerk_report.php?sorting=<?php echo $sort ?>&field=NumberofPickup"><?php echo $sortNumberofDropoff; ?></td>
                      <td class="heading"><a href="clerk_report.php?sorting=<?php echo $sort ?>&field=CombinedTotal"><?php echo $sortCombinedTotal; ?></td>
                  </tr>

                  <?php while ( $ClerkReport = mysqli_fetch_assoc($result)){ ?>

                      <tr>
                        <td><?php echo $ClerkReport['ClerkID']; ?></td>
                        <td><?php echo $ClerkReport['Firstname']; ?></td>
                        <td><?php echo $ClerkReport['MiddleName']; ?></td>
                        <td><?php echo $ClerkReport['LastName']; ?></td>
                        <td><?php echo $ClerkReport['Email']; ?></td>
                        <td><?php echo $ClerkReport['DateOfHire']; ?></td>
                        <td><?php echo $ClerkReport['NumberofPickup']; ?></td>
                        <td><?php echo $ClerkReport['NumberofDropoff']; ?></td>
                        <td><?php echo $ClerkReport['CombinedTotal']; ?></td>
                      </tr>

                  <?php  } ?>


              </table>
          </div>
          <a href="generate_reports.php"> <button type="button" class="btn btn-lg btn-info">Back to Report Menu</button>	</a>
       </div>
     </div>
         <?php include("lib/footer.php"); ?>
    </div>
  </body>
