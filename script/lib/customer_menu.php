        	<div id="header">
           	 <div class="logo">
               	 <img src="img/tools4rent_logo.png" width="820" height="100" style="opacity:0.5;background-color:E9E5E2;" border="0" alt="" 	title="Tools4Rent Logo">
            	</div>
        	</div>
			<div class="nav_bar">
				<ul>
                    <li><a href="view_profile.php" <?php if($current_filename=='view_profile.php') echo "class='active'"; ?>>View Profile</a></li>
					<li><a href="check_tool_availability.php" <?php if(strpos($current_filename, 'check_tool_availability.php') !== false) echo "class='active'"; ?>>Check Tool Availability</a></li>
                    <li><a href="make_reservation.php" <?php if($current_filename=='make_reservation.php') echo "class='active'"; ?>>Make Reservation</a></li>
                    <li><a href="logout.php" <span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>              
				</ul>
			</div>
