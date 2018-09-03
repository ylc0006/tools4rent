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
    $field = 'ReservationID';
    $sort = 'DESC';
    $sortOrder='';
    $sortReservationID='Reservation ID';
    $sortToolsDescription='Tools Description';
    $sortStartDate='Start Date';
    $sortEndDate='End Date';
    $sortPickupClerkFullName='Pick-up Clerk';
    $sortDropoffClerkFullName='Drop-off Clerk';
    $sortNumberofDays='Number of Days';
    $sortTotalDepositPrice='Total Deposit Price';
    $sortTotalRentalPrice='Total Rental Price';

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
            $sortReservationID='Reservation ID ' . $sortOrder;
        }
        elseif($_GET['field']=='ToolsDescription')
        {
            $field='ToolsDescription';
            $sortToolsDescription='Tools Description ' . $sortOrder;
        }
        elseif($_GET['field']=='StartDate')
        {
            $field='StartDate';
            $sortStartDate='Start Date ' . $sortOrder;
        }
        elseif($_GET['field']=='EndDate')
        {
            $field='EndDate';
            $sortEndDate='End Date ' . $sortOrder;
        }
        elseif($_GET['field']=='PickupClerkFullName')
        {
            $field='PickupClerkFullName';
            $sortPickupClerkFullName='Pick-up Clerk ' . $sortOrder;
        }
        elseif($_GET['field']=='DropoffClerkFullName')
        {
            $field='DropoffClerkFullName';
            $sortDropoffClerkFullName='Drop-off Clerk ' . $sortOrder;
        }
        elseif($_GET['field']=='NumberofDays')
        {
            $field='NumberofDays';
            $sortNumberofDays='Number of Days' . $sortOrder;
        }
        elseif($_GET['field']=='TotalDepositPrice')
        {
            $field='TotalDepositPrice';
            $sortTotalDepositPrice='Total Deposit Price ' . $sortOrder;
        }
        elseif($_GET['field']=='TotalRentalPrice')
        {
            $field='TotalRentalPrice';
            $sortTotalRentalPrice='Total Rental Price ' . $sortOrder;
        }
    }
    
    $email = $_SESSION['email'];

    $row = find_fullname_addres_email_by_email($email);

    $home_phone = find_phonenumber_by_email_type($email, $type = 'Home Phone');

    $work_phone = find_phonenumber_by_email_type($email, $type = 'Work Phone');

    $cell_phone = find_phonenumber_by_email_type($email, $type = 'Cell Phone');

    $result = find_reservation_by_email ($email, $field, $sort);
?>

<?php include("lib/header.php"); ?>
<title>View Profile</title>
</head>

<body>
		<div id="main_container">
    <?php include("lib/customer_menu.php"); ?>

    <div class="center_content">
        <div class="center_left">
            <div class="title_name">
                <?php echo $row['Firstname'] . ' ' . $row['Lastname']; ?>
            </div>
            <div class="features">

                <div class="profile_section">
                    <div class="subtitle">Customer Info</div>
                    <table>
                        <tr>
                            <td class="item_label">E-mail</td>
                            <td>
                                <?php echo $row['Email']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="item_label">Full Name</td>
                            <td>
                                <?php echo $row['FullName'];?>
                            </td>
                        </tr>
                        <tr>
                            <td class="item_label">Home Phone</td>
                            <td>
                                <?php echo $home_phone['PhoneNumber']; ?>
                            </td>
                        </tr>

                        <tr>
                            <td class="item_label">Work Phone</td>
                            <td>
                                <?php echo $work_phone['PhoneNumber']; ?>
                            </td>
                        </tr>

                        <tr>
                            <td class="item_label">Cell Phone</td>
                            <td>
                                <?php  echo $cell_phone['PhoneNumber']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="item_label">Address</td>
                            <td>
                                <?php echo $row['Address']; ?>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="profile_section">
                    <div class="subtitle">Reservations</div>
                    <table>
                        <tr>
                            <td class="heading"><a href="view_profile.php?sorting=<?php echo $sort ?>&field=ReservationID"><?php echo $sortReservationID; ?></td>
                            <td class="heading"><a href="view_profile.php?sorting=<?php echo $sort ?>&field=ToolsDescription"><?php echo $sortToolsDescription; ?></td>
                            <td class="heading"><a href="view_profile.php?sorting=<?php echo $sort ?>&field=StartDate"><?php echo $sortStartDate; ?></td>
                            <td class="heading"><a href="view_profile.php?sorting=<?php echo $sort ?>&field=EndDate"><?php echo $sortEndDate; ?></td>
                            <td class="heading"><a href="view_profile.php?sorting=<?php echo $sort ?>&field=PickupClerkFullName"><?php echo $sortPickupClerkFullName; ?></td>
                            <td class="heading"><a href="view_profile.php?sorting=<?php echo $sort ?>&field=DropoffClerkFullName"><?php echo $sortDropoffClerkFullName; ?></td>
                            <td class="heading"><a href="view_profile.php?sorting=<?php echo $sort ?>&field=NumberofDays"><?php echo $sortNumberofDays; ?></td>
                            <td class="heading"><a href="view_profile.php?sorting=<?php echo $sort ?>&field=TotalDepositPrice"><?php echo $sortTotalDepositPrice; ?></td>
                            <td class="heading"><a href="view_profile.php?sorting=<?php echo $sort ?>&field=TotalRentalPrice"><?php echo $sortTotalRentalPrice; ?></td>
                        </tr>

                        <?php while ( $reservation = mysqli_fetch_assoc($result)){ ?>

        										<tr>
                              <td><?php echo $reservation['ReservationID']; ?></td>
                              <td><?php echo $reservation['ToolsDescription']; ?></td>
                              <td><?php echo $reservation['StartDate']; ?></td>
                              <td><?php echo $reservation['EndDate']; ?></td>
                              <td><?php echo $reservation['PickupClerkFullName']; ?></td>
                              <td><?php echo $reservation['DropoffClerkFullName']; ?></td>
                              <td><?php echo $reservation['NumberofDays']; ?></td>
                              <td><?php echo $reservation['TotalDepositPrice']; ?></td>
                              <td><?php echo $reservation['TotalRentalPrice']; ?></td>
        										</tr>

                        <?php  } ?>
                    </table>
                </div>


            </div>
            <a href="customer_main_menu.php"> <button type="button" class="btn btn-lg btn-info">Back to Customer Menu</button>	</a>
        </div>

                <?php include("lib/error.php"); ?>

				<div class="clear"></div>
			</div>

               <?php include("lib/footer.php"); ?>

		</div>
	</body>
</html>
