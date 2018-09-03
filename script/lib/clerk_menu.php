<div id="header">
   <div class="logo">
       <img src="img/tools4rent_logo.png" width="820" height="100" style="opacity:0.5;background-color:E9E5E2;" border="0" alt="" 	title="Tools4Rent Logo">
    </div>
</div>
<div class="nav_bar">
<ul>
          <li><a href="pick_up.php" <?php if($current_filename=='pick_up.php') echo "class='active'"; ?>>Pick Up Reservations</a></li>
          <li><a href="drop_off.php" <?php if(strpos($current_filename, 'drop_off.php') !== false) echo "class='active'"; ?>>Drop Off Reservations</a></li>
          <li><a href="add_tool.php" <?php if($current_filename=='add_tool.php') echo "class='active'"; ?>>Add New Tools</a></li>
          <li><a href="generate_reports.php" <?php if($current_filename=='generate_reports.php') echo "class='active'"; ?>>Generate Reports</a></li>
          <li><a href="logout.php" <span class="glyphicon glyphicon-log-out"></span> Log Out</a></li>
</ul>
</div>
