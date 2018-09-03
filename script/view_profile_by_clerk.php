<?php

include('lib/common.php');

$CustomerID = $_GET['id'] ?? '1';

      $row = find_fullname_addres_email_by_id($CustomerID);

      $home_phone = find_phonenumber_by_id_type($CustomerID, $type = 'Home Phone');

      $work_phone = find_phonenumber_by_id_type($CustomerID, $type = 'Work Phone');

      $cell_phone = find_phonenumber_by_id_type($CustomerID, $type = 'Cell Phone');

      $result = find_reservation_by_id ($CustomerID);


 ?>

 <?php include("lib/header.php"); ?>
 <title>View Profile By Clerk</title>
 </head>

 <body>
 		<div id="main_container">
     <?php include("lib/clerk_menu.php"); ?>

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
                             <td class="heading">Reserevation ID</td>
                             <td class="heading">Tools</td>
                             <td class="heading">Start Date</td>
                             <td class="heading">End Date</td>
                             <td class="heading">Pick-up Clerk</td>
                             <td class="heading">Drop-off Clerk</td>
                             <td class="heading">Number of Days</td>
                             <td class="heading">Total Deposit Price</td>
                             <td class="heading">Total Rental Price</td>
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
         </div>
         <a href="customer_report.php"> <button type="button" class="btn btn-lg btn-info">Back to Customer Report</button>	</a>

                 <?php include("lib/error.php"); ?>

 				<div class="clear"></div>
 			</div>

                <?php include("lib/footer.php"); ?>

 		</div>
 	</body>
 </html>
