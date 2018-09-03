<?php

include('lib/common.php');
// written by GTusername3

if (!isset($_SESSION['email'])) {
	header('Location: login.php');
	exit();
}

/* if form was submitted, then execute query to search for available Tools */
if ($_SERVER['REQUEST_METHOD'] == 'POST') {

	$start_date = db_escape($db, $_POST['StartDate']);
	$end_date = db_escape($db, $_POST['EndDate']);
	$custom_search = db_escape($db, $_POST['CustomSearch']);
	$type = db_escape($db, $_POST['ToolType']);
	$power_source = '';

	if ($type == 'AllTools'){
		$power_source = db_escape($db, $_POST['All_PowerSource']);
	} elseif ($type == 'PowerTool') {
		$power_source = db_escape($db, $_POST['ElectricCordlessGas_PowerSource']);
	} else {
		$power_source = db_escape($db, $_POST['Manual_PowerSource']);
	}

	$sub_type = '';

	if ($type == 'AllTools') {
		$sub_type = db_escape($db, $_POST['All_SubType']);
	} elseif ($type == 'HandTool' ) {
		$sub_type = db_escape($db, $_POST['HandTool_SubType']);
	} elseif ($type == 'GardenTool') {
		$sub_type = db_escape($db, $_POST['GardenTool_SubType']);
	} elseif ($type == 'Ladder') {
		$sub_type = db_escape($db, $_POST['Ladder_SubType']);
	} elseif ($type == 'PowerTool') {
		$sub_type = db_escape($db, $_POST['PowerTool_SubType']);
	}

	$field = 'ToolID';
	$sort = 'DESC';
	$sortOrder='';
	$sortDescription='Description';
	$sortRentalPrice='Rental Price';
	$sortDepositPrice='Deposit Price';
	$sortToolID='Tool ID';

	if(isset($_GET['field']))
	{
	    if($_GET['field']=='Description')
	    {
	        $field='Description';
	        $sortTotalofToolsRented='Description ' . $sortOrder;
	    }
	    elseif($_GET['field']=='RentalPrice')
	    {
	        $field='RentalPrice';
	        $sortCustomerID='Rental Price ' . $sortOrder;
	    }
	    elseif($_GET['field']=='DepositPrice')
	    {
	        $field='DepositPrice';
	        $sortFirstName='Deposit Price ' . $sortOrder;
	    }
	    elseif($_GET['field']=='ToolID')
	    {
	        $field='ToolID';
	        $sortMiddleName='Tool ID ' . $sortOrder;
	    }
	}

	$query = "SELECT Tools.ToolID AS ToolID, CONCAT(Tools.PowerSource, ' ', Tools.SubOption, ' ', Tools.SubType) AS Description, (0.15 * Tools.PurchasePrice) AS RentalPrice, (0.4 * Tools.PurchasePrice) AS DepositPrice
						FROM Tools
						LEFT JOIN Tools AS SelectedTool
						ON Tools.ToolID = SelectedTool.ToolID
						WHERE Tools.PowerSource = '" . $power_source . "' AND Tools.SubType = '" . $sub_type . "' " ;

	if (!empty($custom_search)) {
		$query = $query . " AND Tools.SubOption LIKE '%$custom_search%' ";
	}

	if (!empty($start_date) AND !empty($end_date)) {
		$query =	$query . " AND Tools.ToolID NOT IN " .
										   "( " .
											 "SELECT Been.ToolID FROM Been " .
											 "LEFT JOIN Reservation " .
											 "ON Been.ReservationID = Reservation.ReservationID " .
											 "WHERE " .
											 "('" . $start_date ."' > Reservation.StartDate  AND '" . $start_date ."' < Reservation.EndDate) " .
											 "OR " .
											 "('" . $end_date . "' > Reservation.StartDate  AND '" . $end_date . "' < Reservation.EndDate) " .
											 ") ";
	}

	if (!empty($start_date) AND empty($end_date)) {
		$query =	$query . " AND Tools.ToolID NOT IN " .
										   "( " .
											 "SELECT Been.ToolID FROM Been " .
											 "LEFT JOIN Reservation " .
											 "ON Been.ReservationID = Reservation.ReservationID " .
											 "WHERE " .
											 "('" . $start_date ."' > Reservation.StartDate  AND '" . $start_date ."' < Reservation.EndDate) " .
											 ") ";
	}

	if (empty($start_date) AND !empty($end_date)) {
		$query =	$query . " AND Tools.ToolID NOT IN " .
										   "( " .
											 "SELECT Been.ToolID FROM Been " .
											 "LEFT JOIN Reservation " .
											 "ON Been.ReservationID = Reservation.ReservationID " .
											 "WHERE " .
											 "('" . $end_date . "' > Reservation.StartDate  AND '" . $end_date . "' < Reservation.EndDate) " .
											 ") ";
	}


	$query = $query . " ORDER BY $field $sort";

	$result = mysqli_query($db, $query);

    include('lib/show_queries.php');

    if (mysqli_affected_rows($db) == -1) {
        array_push($error_msg,  "SELECT ERROR:Failed to find available tools ... <br>" . __FILE__ ." line:". __LINE__ );
    }

}
?>

<?php include("lib/header.php"); ?>
		<title>Check Tool Availability</title>
		<script>
        function dropDownUpdate(str) {
            var subtypes = ['All_SubType', 'HandTool_SubType', 'GardenTool_SubType', 'Ladder_SubType', 'PowerTool_SubType'];
            var powersource = ['Manual_PowerSource', 'ElectricCordlessGas_PowerSource', 'All_PowerSource'];
            for (i = 0; i < subtypes.length; i++) {
                document.getElementById(subtypes[i]).style.display="none";
            }
            for (j = 0; j < powersource.length; j++) {
                document.getElementById(powersource[j]).style.display="none";
            }
            if (str == 'HandTool') {
                document.getElementById('HandTool_SubType').style.display = "block";
				document.getElementById('Manual_PowerSource').style.display="block";
            } else if (str == 'GardenTool') {
                document.getElementById('GardenTool_SubType').style.display = "block";
                document.getElementById('Manual_PowerSource').style.display="block";
            } else if (str == 'Ladder') {
                document.getElementById('Ladder_SubType').style.display = "block";
                document.getElementById('Manual_PowerSource').style.display="block";
            } else if (str == 'PowerTool') {
                document.getElementById('PowerTool_SubType').style.display = "block";
                document.getElementById('ElectricCordlessGas_PowerSource').style.display="block";
            } else {
                document.getElementById('All_SubType').style.display="block";
                document.getElementById('All_PowerSource').style.display = "block";
            }
        }
        function openToolDetails(id) {
        	var table = document.getElementById('reservations-table');
        	var tool_id = table.rows[id].cells[0].innerText;
        	window.open("http://localhost:8080/tools4rent/script/view_tool_detail.php?id=" + tool_id);
        }
    </script>
	</head>

	<body>
    	<div id="main_container">
            <?php include("lib/customer_menu.php"); ?>

			<div class="center_content">
				<div class="center_left">
					<h1 class="well">Check Tool Availability</h1>
					<div class="features">
						<div class="profile_section">
							<form name="searchform" action="check_tool_availability.php" method="POST">
								<div class="row">
									<div class="col-sm-4"><b>Start Date:</b></div>
									<div class="col-sm-4"><b>End Date:</b></div>
									<div class="col-sm-4"><b>Custom Search:</b></div>
								</div>
								<div class="row">
									<div class="col-sm-4 form-group">
										<input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" name="StartDate">
									</div>
									<div class="col-sm-4 form-group">
										<input type="date" value="<?php echo date('Y-m-d'); ?>" class="form-control" name="EndDate">
									</div>
									<div class="col-sm-4 form-group">
										<input type="text" placeholder="Custom Search" class="form-control" name="CustomSearch">
									</div>
								</div>
								<div class="row">
									<div class="col-sm-6"><b>Type:</b></div>
								</div>
								<div class="row">
									<label class="col-sm-2 radio-inline"><input type="radio" name="ToolType" value="AllTools" checked="checked" onclick="dropDownUpdate(this.value)">All Tools </label>
									<label class="col-sm-2 radio-inline"><input type="radio" name="ToolType" value="HandTool" onclick="dropDownUpdate(this.value)"> Hand Tool</label>
									<label class="col-sm-2 radio-inline"><input type="radio" name="ToolType" value="GardenTool" onclick="dropDownUpdate(this.value)"> Garden Tool</label>
									<label class="col-sm-2 radio-inline"><input type="radio" name="ToolType" value="Ladder" onclick="dropDownUpdate(this.value)"> Ladder</label>
									<label class="col-sm-2 radio-inline"><input type="radio" name="ToolType" value="PowerTool" onclick="dropDownUpdate(this.value)"> Power Tool</label>
								</div>
								<div class="row">
									<br>
									<div class="col-sm-4"><b>Power Source:</b></div>
									<div class="col-sm-4"><b>Sub-Type:</b></div>
								</div>
								<div class="row">
									<div class="col-sm-4 form-group">
										<div class="form-group" id="All_PowerSource">
			                                <select class="form-control" name="All_PowerSource" >
			                                	<option value='Manual'>Manual</option>
			                                	<option value='Electric'>Electric</option>
			                                	<option value='Cordless'>Cordless</option>
			                                	<option value='Gas'>Gas</option>
			                                </select>
			                            </div>
			                            <div class="form-group" id="Manual_PowerSource" style="display: none">
			                                <select class="form-control" name="Manual_PowerSource" >
			                                	<option value='Manual'>Manual</option>
			                                </select>
			                            </div>
			                             <div class="form-group" id="ElectricCordlessGas_PowerSource" style="display: none">
			                                <select class="form-control" name="ElectricCordlessGas_PowerSource" >
			                                	<option value='Electric'>Electric</option>
			                                	<option value='Cordless'>Cordless</option>
			                                	<option value='Gas'>Gas</option>
			                                </select>
			                            </div>
									</div>
									<div class="col-sm-4 form-group">
										<div class="form-group" id="All_SubType">
			                                <select class="form-control" name="All_SubType" >
			                                    <option value='Screwdriver'>Screwdriver</option>
			                                    <option value='Socket'>Socket</option>
			                                    <option value='Ratchet'>Ratchet</option>
			                                    <option value='Wrench'>Wrench</option>
			                                    <option value='Pliers'>Pliers</option>
			                                    <option value='Gun'>Gun</option>
			                                    <option value='Hammer'>Hammer</option>
			                                    <option value='Digger'>Digger</option>
	                            				<option value='Pruner'>Pruner</option>
	                            				<option value='Rakes'>Rakes</option>
	                            				<option value='Wheelbarrows'>Wheelbarrows</option>
	                            				<option value='Striking'>Striking</option>
	                            				<option value='Straight'>Straight</option>
	                            				<option value='Step'>Step</option>
	                            				<option value='Drill'>Drill</option>
	                            				<option value='Saw'>Saw</option>
	                            				<option value='Sander'>Sander</option>
	                            				<option value='Air-Compressor'>Air-Compressor</option>
	                            				<option value='Mixer'>Mixer</option>
	                            				<option value='Generator'>Generator</option>
			                                </select>
	                            		</div>
										<div class="form-group" id="HandTool_SubType" style="display: none">
			                                <select class="form-control" name="HandTool_SubType" >
			                                    <option value='Screwdriver'>Screwdriver</option>
			                                    <option value='Socket'>Socket</option>
			                                    <option value='Ratchet'>Ratchet</option>
			                                    <option value='Wrench'>Wrench</option>
			                                    <option value='Pliers'>Pliers</option>
			                                    <option value='Gun'>Gun</option>
			                                    <option value='Hammer'>Hammer</option>
			                                </select>
	                            		</div>
	                            		<div class="form-group" id="GardenTool_SubType" style="display: none">
	                            			<select class="form-control" name="GardenTool_SubType" >
	                            				<option value='Digger'>Digger</option>
	                            				<option value='Pruner'>Pruner</option>
	                            				<option value='Rakes'>Rakes</option>
	                            				<option value='Wheelbarrows'>Wheelbarrows</option>
	                            				<option value='Striking'>Striking</option>
	                            			</select>
	                            		</div>
	                            		<div class="form-group" id="Ladder_SubType" style="display: none">
	                            			<select class="form-control" name="Ladder_SubType" >
	                            				<option value='Straight'>Straight</option>
	                            				<option value='Step'>Step</option>
	                            			</select>
	                            		</div>
	                            		<div class="form-group" id="PowerTool_SubType" style="display: none">
	                            			<select class="form-control" name="PowerTool_SubType" >
	                            				<option value='Drill'>Drill</option>
	                            				<option value='Saw'>Saw</option>
	                            				<option value='Sander'>Sander</option>
	                            				<option value='Air-Compressor'>Air-Compressor</option>
	                            				<option value='Mixer'>Mixer</option>
	                            				<option value='Generator'>Generator</option>
	                            			</select>
	                            		</div>
									</div>
								</div>
								<a href="javascript:searchform.submit();"><button type="button" class="btn btn-lg btn-info">Search</button></a>
							</form>
						</div>

						<div class='profile_section'>
						<div class='subtitle'>Search Results</div>
						<table id="reservations-table">
							<tr>
								<td class="heading"><a href="check_tool_availability.php?sorting=<?php echo $sort ?>&field=ToolID"><?php echo $sortToolID; ?></td>
								<td class="heading"><a href="check_tool_availability.php?sorting=<?php echo $sort ?>&field=Description"><?php echo $sortDescription; ?></td>
								<td class="heading"><a href="check_tool_availability.php?sorting=<?php echo $sort ?>&field=RentalPrice"><?php echo $sortRentalPrice; ?></td>
								<td class="heading"><a href="check_tool_availability.php?sorting=<?php echo $sort ?>&field=DepositPrice"><?php echo $sortDepositPrice; ?></td>
							</tr>
								<?php while ($row = mysqli_fetch_assoc($result)){ ?>
										 <tr>
											 <td><?php echo $row['ToolID']; ?></td>
											 <td><a href="#" onClick="openToolDetails(this.parentElement.parentElement.rowIndex)">
											 	<?php echo $row['Description']; ?></a></td>
											 <td><?php echo $row['RentalPrice']; ?></td>
											 <td><?php echo $row['DepositPrice']; ?></td>
										</tr>
								<?php	} ?>
							</table>
							</div>
					 </div>
				</div>

                <?php include("lib/error.php"); ?>

				<div class="clear"></div>
			</div>

               <?php include("lib/footer.php"); ?>

		</div>
	</body>
</html>
