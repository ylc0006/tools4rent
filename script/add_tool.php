<?php

include('lib/common.php');

//if (!isset($_SESSION['email'])) {
if(isset($_POST['login'])) {
	header('Location: login.php');
	exit();
}

if (is_post_request()) {
	$tools = [];
	$tools['Type'] = '';
	if ($_POST['ToolType']== HandTool) {
		$tools['Type'] = 'Hand Tool';
	} elseif ($_POST['ToolType']== GardenTool) {
		$tools['Type'] = 'Garden Tool';
	} elseif ($_POST['ToolType']== Ladder) {
		$tools['Type'] = 'Ladder Tool';
	} elseif ($_POST['ToolType']== PowerTool) {
		$tools['Type'] = 'Power Tool';
	}



	$tools['SubType'] = '';
	if(!empty($_POST['HandToolManual_SubType'])) {
		$tools['SubType'] = $_POST['HandToolManual_SubType'];
	} elseif (!empty($_POST['GardenToolManual_SubType'])) {
		$tools['SubType'] = $_POST['GardenToolManual_SubType'];
	} elseif (!empty($_POST['LadderManual_SubType'])) {
		$tools['SubType'] = $_POST['LadderManual_SubType'];
	} elseif (!empty($_POST['PowerToolElectric_SubType'])) {
		$tools['SubType'] = $_POST['PowerToolElectric_SubType'];
	} elseif (!empty($_POST['PowerToolCordless_SubType'])) {
		$tools['SubType'] = $_POST['PowerToolCordless_SubType'];
	} elseif (!empty($_POST['PowerToolGas_SubType'])) {
		$tools['SubType'] = $_POST['PowerToolGas_SubType'];
	}


	$tools['SubOption'] = '';
	if(!empty($_POST['Screwdriver_SubOption'])) {
		$tools['SubOption'] = $_POST['Screwdriver_SubOption'];
	} elseif (!empty($_POST['Socket_SubOption'])) {
		$tools['SubOption'] = $_POST['Socket_SubOption'];
	} elseif (!empty($_POST['Ratchet_SubOption'])) {
		$tools['SubOption'] = $_POST['Ratchet_SubOption'];
	} elseif (!empty($_POST['Wrench_SubOption'])) {
		$tools['SubOption'] = $_POST['Wrench_SubOption'];
	} elseif (!empty($_POST['Pliers_SubOption'])) {
		$tools['SubOption'] = $_POST['Pliers_SubOption'];
	} elseif (!empty($_POST['Gun_SubOption'])) {
		$tools['SubOption'] = $_POST['Gun_SubOption'];
	} elseif (!empty($_POST['Hammer_SubOption'])) {
		$tools['SubOption'] = $_POST['Hammer_SubOption'];
	} elseif (!empty($_POST['Digger_SubOption'])) {
		$tools['SubOption'] = $_POST['Digger_SubOption'];
	} elseif (!empty($_POST['Pruner_SubOption'])) {
		$tools['SubOption'] = $_POST['Pruner_SubOption'];
	} elseif (!empty($_POST['Rakes_SubOption'])) {
		$tools['SubOption'] = $_POST['Rakes_SubOption'];
	} elseif (!empty($_POST['Wheelbarrows_SubOption'])) {
		$tools['SubOption'] = $_POST['Wheelbarrows_SubOption'];
	} elseif (!empty($_POST['Striking_SubOption'])) {
		$tools['SubOption'] = $_POST['Striking_SubOption'];
	} elseif (!empty($_POST['Straight_SubOption'])) {
		$tools['SubOption'] = $_POST['Straight_SubOption'];
	} elseif (!empty($_POST['Step_SubOption'])) {
		$tools['SubOption'] = $_POST['Step_SubOption'];
	} elseif (!empty($_POST['Drill_SubOption'])) {
		$tools['SubOption'] = $_POST['Drill_SubOption'];
	} elseif (!empty($_POST['Saw_SubOption'])) {
		$tools['SubOption'] = $_POST['Saw_SubOption'];
	} elseif (!empty($_POST['Sander_SubOption'])) {
		$tools['SubOption'] = $_POST['Sander_SubOption'];
	} elseif (!empty($_POST[ 'AirCompressor_SubOption'])) {
		$tools['SubOption'] = $_POST[ 'AirCompressor_SubOption'];
	} elseif (!empty($_POST['Mixer_SubOption'])) {
		$tools['SubOption'] = $_POST['Mixer_SubOption'];
	} elseif (!empty($_POST['Generator_SubOption'])) {
		$tools['SubOption'] = $_POST['Generator_SubOption'];
	}



	$tools['PowerSource'] = '';
	if(!empty($_POST['HandTool_PowerSource'])){
		$tools['PowerSource'] = $_POST['HandTool_PowerSource'];
	} elseif (!empty($_POST['GardenTool_PowerSource'])) {
		$tools['PowerSource'] = $_POST['GardenTool_PowerSource'];
	} elseif (!empty($_POST['Ladder_PowerSource'])) {
		$tools['PowerSource'] = $_POST['Ladder_PowerSource'];
	} elseif (!empty($_POST['PowerTool_PowerSource'])) {
		$tools['PowerSource'] = $_POST['PowerTool_PowerSource'];
	}


	function footToInch(&$Int, &$Fraction, &$Unit) {
		$NewFraction = $Fraction * 12;
		$Round = floor($NewFraction);
		$NewInt = ($Int * 12) + $Round;
		$Int = $NewInt;
		$Fraction = $NewFraction - $Round;
		$Unit = 'inch';
	}


	$tools['Manufacturer'] = $_POST['Manufacturer'];
	$tools['Material'] = $_POST['Material'];
	$tools['PurchasePrice'] = $_POST['PurchasePrice'];
	$tools['Weight'] = $_POST['Weight'];
	$tools['LengthInt'] = $_POST['Length'];
	$tools['LengthFraction'] = (isset($_POST['LengthFraction']) ? $_POST['LengthFraction'] : 0);
	$tools['LengthUnit'] = $_POST['LengthUnit'];
	if ($tools['LengthUnit'] == 'feet') {
		footToInch($tools['LengthInt'], $tools['LengthFraction'], $tools['LengthUnit']);
	}
	$tools['Width_Diameter_Int'] = $_POST['Width'];
	$tools['Width_Diameter_Fraction'] = (isset($_POST['Width_Diameter_Fraction']) ? $_POST['Width_Diameter_Fraction'] : 0);
	$tools['Width_Diameter_Unit'] = $_POST['WidthUnit'];
	if ($tools['Width_Diameter_Unit'] == 'feet') {
		footToInch($tools['Width_Diameter_Int'], $tools['Width_Diameter_Fraction'], $tools['Width_Diameter_Unit']);
	}
	$screwsize = $_POST['ScrewSize'];
	$Socket_DriveSize = $_POST['Socket_DriveSize'];
	$saesize = $_POST['SaeSize'];
	$DeepSocket = $_POST['DeepSocket'];
	$Ratchet_DriveSize = $_POST['Ratchet_DriveSize'];
	$Adjustable = $_POST['Adjustable'];
	$GaugeRating = $_POST['GaugeRating'];
	$Capacity = $_POST['Capacity'];
	$AntiVibration = $_POST['AntiVibration'];


	$WeightCapacity = '';
	if (!empty($_POST['Straight_WeightCapacity'])) {
		$WeightCapacity = $_POST['Straight_WeightCapacity'];
	} elseif (!empty($_POST['Step_WeightCapacity'])) {
		$WeightCapacity = $_POST['Step_WeightCapacity'];
	}

	$StepCount = '';
	if(!empty($_POST['Straight_StepCount'])) {
		$StepCount = $_POST['Straight_StepCount'];
	} elseif (!empty($_POST['Step_StepCount'])) {
		$StepCount = $_POST['Step_StepCount'];
	}

	$RubberFeet = $_POST['RubberFeet'];
	$PailShelf = $_POST['PailShelf'];

	$HandleMaterial = '';
	if(!empty($_POST['Pruner_HandleMaterial'])) {
		$HandleMaterial = $_POST['Pruner_HandleMaterial'];
	} elseif (!empty($_POST['Striking_HandleMaterial'])) {
		$HandleMaterial = $_POST['Striking_HandleMaterial'];
	} elseif (!empty($_POST['Digger_HandleMaterial'])) {
		$HandleMaterial = $_POST['Digger_HandleMaterial'];
	} elseif (!empty($_POST['Rakes_HandleMaterial'])) {
		$HandleMaterial = $_POST['Rakes_HandleMaterial'];
	} elseif (!empty($_POST['Wheelbarrows_HandleMaterial'])) {
		$HandleMaterial = $_POST['Wheelbarrows_HandleMaterial'];
	}

	$BladeMaterial = $_POST['BladeMaterial'];
	$Pruner_BladeLength = $_POST['Pruner_BladeLength'];
	$HeadWeight = $_POST['HeadWeight'];
	$BladeWidth = $_POST['BladeWidth'];
	$Digger_BladeLength = $_POST['Digger_BladeLength'];
	$TineCount = $_POST['TineCount'];
	$BinMaterial = $_POST['BinMaterial'];
	$BinVolume = $_POST['BinVolume'];
	$WheelCount = $_POST['WheelCount'];




  // insert into tools table
	$query = "INSERT INTO Tools ";
	$query .= "(Type, SubType, SubOption, PowerSource, Manufacturer, Material, PurchasePrice, Weight, LengthInt, LengthFraction, LengthUnit, Width_Diameter_Int, Width_Diameter_Fraction, Width_Diameter_Unit) ";
	$query .= "VALUES (";
	$query .= "'" . db_escape($db,$tools['Type']) . "',";
	$query .= "'" . db_escape($db,$tools['SubType']) . "',";
	$query .= "'" . db_escape($db,$tools['SubOption']) . "',";
	$query .= "'" . db_escape($db,$tools['PowerSource']) . "',";
	$query .= "'" . db_escape($db,$tools['Manufacturer']) . "',";
	$query .= "'" . db_escape($db,$tools['Material']) . "',";
	$query .= "'" . db_escape($db,$tools['PurchasePrice']) . "',";
	$query .= "'" . db_escape($db,$tools['Weight']) . "',";
	$query .= "'" . db_escape($db,$tools['LengthInt']) . "',";
	$query .= "'" . db_escape($db,$tools['LengthFraction']) . "',";
	$query .= "'" . db_escape($db,$tools['LengthUnit']) . "',";
	$query .= "'" . db_escape($db,$tools['Width_Diameter_Int']) . "',";
	$query .= "'" . db_escape($db,$tools['Width_Diameter_Fraction']) . "',";
	$query .= "'" . db_escape($db,$tools['Width_Diameter_Unit']) . "'";
	$query .= ")";
	$result = mysqli_query($db, $query);
	include('lib/show_queries.php');

	// get the new ToolID
	$query = "SELECT MAX(ToolID) AS ToolID FROM Tools ";
	$result = mysqli_query($db, $query);
	$row = mysqli_fetch_assoc($result);
	$toolID = $row['ToolID'];

	// insert into handtools if new tool is HandTool
	if ($tools['Type'] == 'Hand Tool') {
		$query = "INSERT INTO HandTools ";
		$query .= "(ToolID) ";
		$query .= "VALUES ( " . $toolID . ") ";
		$result = mysqli_query($db, $query);

		// insert into Screwdriver if new tool is Screwdriver
		if ($tools['SubType'] == Screwdriver ) {
			$query = "INSERT INTO Screwdriver ";
			$query .= "(ToolID, ScrewSize) ";
			$query .= "VALUES ( " . $toolID . ", '" . $screwsize . "') " ;
			$result = mysqli_query($db, $query);
			include('lib/show_queries.php');

			if($result === true) {
				redirect_to('add_tool_complete.php');
			} else {
				$errors = $result;
			}
		}

		// insert into Socket if new tool is Socket
		if ($tools['SubType'] == Socket ) {
			$query = "INSERT INTO Socket ";
			$query .= "(ToolID, DriveSize, SaeSize, DeepSocket) ";
			$query .= "VALUES ( " . $toolID . ", '" . $Socket_DriveSize . "', '" . $saesize . "', " . $DeepSocket . ") " ;
			$result = mysqli_query($db, $query);
			include('lib/show_queries.php');

			if($result === true) {
				redirect_to('add_tool_complete.php');
			} else {
				$errors = $result;
			}
		}

		// insert into Ratchet if new tool is Ratchet
		if ($tools['SubType'] == Ratchet ) {
			$query = "INSERT INTO Ratchet ";
			$query .= "(ToolID, DriveSize) ";
			$query .= "VALUES ( " . $toolID . ", '" . $Ratchet_DriveSize . "') " ;
			$result = mysqli_query($db, $query);
			include('lib/show_queries.php');

			if($result === true) {
				redirect_to('add_tool_complete.php');
			} else {
				$errors = $result;
			}
		}

		// insert into Pliers if new tool is Pliers
		if ($tools['SubType'] == Pliers ) {
			$query = "INSERT INTO Plier ";
			$query .= "(ToolID, Adjustable) ";
			$query .= "VALUES ( " . $toolID . ", '" . $Adjustable . "') " ;
			$result = mysqli_query($db, $query);
			include('lib/show_queries.php');

			if($result === true) {
				redirect_to('add_tool_complete.php');
			} else {
				$errors = $result;
			}
		}

		// insert into Gun if new tool is Gun
		if ($tools['SubType'] == Gun ) {
			$query = "INSERT INTO Gun ";
			$query .= "(ToolID, GaugeRating, Capacity) ";
			$query .= "VALUES ( " . $toolID . ", '" . $GaugeRating . "', '"  . $Capacity . "') " ;
			$result = mysqli_query($db, $query);
			include('lib/show_queries.php');

			if($result === true) {
				redirect_to('add_tool_complete.php');
			} else {
				$errors = $result;
			}
		}

		// insert into Hammer if new tool is Hammer
		if ($tools['SubType'] == Hammer ) {
			$query = "INSERT INTO Hammer ";
			$query .= "(ToolID, AntiVibration) ";
			$query .= "VALUES ( " . $toolID . ", '" . $AntiVibration . "') " ;
			$result = mysqli_query($db, $query);
			include('lib/show_queries.php');

			if($result === true) {
				redirect_to('add_tool_complete.php');
			} else {
				$errors = $result;
			}
		}

	}

	// insert into laddertools if new tool is ladderTool
	if ($tools['Type'] == 'Ladder Tool') {
		$query = "INSERT INTO LadderTools (ToolID, WeightCapacity, StepCount)
		VALUES (" . $toolID . ", '" . $WeightCapacity . "', '"  . $StepCount . "') " ;
		$result = mysqli_query($db, $query);
		include('lib/show_queries.php');

		// insert into Straight if new tool is Straight
		if ($tools['SubType'] == Straight) {
			$query = "INSERT INTO Straight (ToolID, RubberFeet)
			VALUES ( " . $toolID . ", '" . $RubberFeet . "') " ;
			$result = mysqli_query($db, $query);
			include('lib/show_queries.php');

			if($result === true) {
				redirect_to('add_tool_complete.php');
			} else {
				$errors = $result;
			}
		}

		// insert into Step if new tool is Step
		if ($tools['SubType'] == Step) {
			$query = "INSERT INTO Step (ToolID, PailShelf)
			VALUES ( " . $toolID . ", '" . $PailShelf . "') " ;
			$result = mysqli_query($db, $query);
			include('lib/show_queries.php');

			if($result === true) {
				redirect_to('add_tool_complete.php');
			} else {
				$errors = $result;
			}
		}
	}

	// insert into Gardentools if new tool is GardenTool
	if ($tools['Type'] == 'Garden Tool') {
		$query = "INSERT INTO GardenTools (ToolID, HandleMaterial)
		VALUES (" . $toolID . ", '" .  $HandleMaterial . "') ";
		$result = mysqli_query($db, $query);
		include('lib/show_queries.php');
		// insert into PruningTools if new tool is PruningTools
		if ($tools['SubType'] == Pruner) {
			$query = "INSERT INTO PruningTools(ToolID, BladeMaterial, BladeLength)
			VALUES  (" . $toolID . ", '" . $BladeMaterial . "', '"  . $Pruner_BladeLength . "') " ;
			$result = mysqli_query($db, $query);
			include('lib/show_queries.php');

			if($result === true) {
				redirect_to('add_tool_complete.php');
			} else {
				$errors = $result;
			}
		}

		// insert into StrikingTools if new tool is StrikingTools
		if ($tools['SubType'] == Striking) {
			$query = "INSERT INTO StrikingTools(ToolID, HeadWeight)
			VALUES (" . $toolID . ", '" .  $HeadWeight . "') ";
			$result = mysqli_query($db, $query);
			include('lib/show_queries.php');

			if($result === true) {
				redirect_to('add_tool_complete.php');
			} else {
				$errors = $result;
			}
		}

		// insert into DiggingTools if new tool is DiggingTools
		if ($tools['SubType'] == Digger) {
			$query = "INSERT INTO DiggingTools(ToolID, BladeWidth, BladeLength)
			VALUES (" . $toolID . ", '" . $BladeWidth . "', '"  . $Digger_BladeLength . "') " ;
			$result = mysqli_query($db, $query);
			include('lib/show_queries.php');

			if($result === true) {
				redirect_to('add_tool_complete.php');
			} else {
				$errors = $result;
			}
		}

		// insert into RakeTools if new tool is RakeTools
		if ($tools['SubType'] == Rakes) {
			$query = "INSERT INTO RakeTools(ToolID, TineCount)
			VALUES (" . $toolID . ", '" .  $TineCount . "') ";
			$result = mysqli_query($db, $query);
			include('lib/show_queries.php');

			if($result === true) {
				redirect_to('add_tool_complete.php');
			} else {
				$errors = $result;
			}
		}

		// insert into WheelbarrowTools if new tool is WheelbarrowTools
		if ($tools['SubType'] == Wheelbarrows) {
			$query = "INSERT INTO WheelbarrowTools(ToolID, BinMaterial, BinVolume , WheelCount)
			VALUES (" . $toolID . ", '" . $BinMaterial . "', '" . $BinVolume . "', '" . $WheelCount . "') " ;
			$result = mysqli_query($db, $query);
			include('lib/show_queries.php');

			if($result === true) {
				redirect_to('add_tool_complete.php');
			} else {
				$errors = $result;
			}
		}

	}

	// insert into PowerTools if new tool is PowerTool
	if ($tools['Type'] == 'Power Tool') {

		$VoltRating = $_POST['VoltRating'];
		$AmpRating = $_POST['AmpRating'];
		$AmpRatingUnit = $_POST['AmpRatingUnit'];
		$AmpRating = $AmpRating * $AmpRatingUnit;
		$MinRPMRating = $_POST['MinRPMRating'];
		$MaxRPMRating = '';
		if (!empty($_POST['MaxRPMRating'])) {
			$MaxRPMRating = $_POST['MaxRPMRating'];
		} else {
			$MaxRPMRating = 'NULL';
		}

		$PowerToolAccessoryDescription = $_POST['PowerToolAccessoryDescription'];
		$PowerToolAccessoryQuantity = $_POST['PowerToolAccessoryQuantity'];

		$CordlessBatteryType = '';
		if (!empty($_POST['CordlessBatteryType'])) {
			$CordlessBatteryType = $_POST['CordlessBatteryType'];
		} else {
			$CordlessBatteryType = 'NULL';
		}

		$CordlessBatteryDCVoltRating = '';
		if (!empty($_POST['CordlessBatteryDCVoltRating'])) {
			$CordlessBatteryDCVoltRating = $_POST['CordlessBatteryDCVoltRating'];
		} else {
			$CordlessBatteryDCVoltRating = 'NULL';
		}

		$CordlessBatteryDCVoltRatingUnit = '';
		if (!empty($_POST['CordlessBatteryDCVoltRatingUnit'])) {
			$CordlessBatteryDCVoltRatingUnit = $_POST['CordlessBatteryDCVoltRatingUnit'];
		} else {
			$CordlessBatteryDCVoltRatingUnit = 'NULL';
		}

		$CordlessBatteryDCVoltRating = $CordlessBatteryDCVoltRating * $CordlessBatteryDCVoltRatingUnit;

		$CordlessBatteryQuantity = '';
		if (!empty($_POST['CordlessBatteryQuantity'])) {
			$CordlessBatteryQuantity = $_POST['CordlessBatteryQuantity'];
		} else {
			$CordlessBatteryQuantity = 'NULL';
		}

		$query = "INSERT INTO PowerTools(ToolID, VoltRating, AmpRating, RPMRatingMin, RPMRatingMax)
		VALUES  (" . $toolID . ", '" . $VoltRating . "', '" . $AmpRating . "', '"  .  $MinRPMRating . "', " .  $MaxRPMRating . ") " ;
		$result = mysqli_query($db, $query);
		include('lib/show_queries.php');

		// insert into Drill if new tool is Drill
		if ($tools['SubType'] == Drill) {

			$AdjustableClutch = '';
			if (!empty($_POST['AdjustableClutch'])) {
				$AdjustableClutch = $_POST['AdjustableClutch'];
			} else {
				$AdjustableClutch = 'NULL';
			}
			$MinTorqueRating = $_POST['MinTorqueRating'];
			$MaxTorqueRating = '';
			if (!empty($_POST['MaxTorqueRating'])) {
				$MaxTorqueRating = $_POST['MaxTorqueRating'];
			} else {
				$MaxTorqueRating = 'NULL';
			}

			$query = "INSERT INTO Drill(ToolID, TorqueRatingMin, TorqueRatingMax, AdjustableClutch)
			VALUES  (" . $toolID . ", '" . $MinTorqueRating . "', "  . $MaxTorqueRating . ", '"  . $AdjustableClutch . "') " ;
			$result = mysqli_query($db, $query);
			include('lib/show_queries.php');

			// insert into accessories for cordless tool
			if ($tools['PowerSource'] == Cordless ) {
				$query = "INSERT INTO Accessories(ToolID, AccessoryDescription, Quantity, BatteryType, VoltRating, BatteryQuantity)
				VALUES  (" . $toolID . ", '" . $PowerToolAccessoryDescription . "', '"  . $PowerToolAccessoryQuantity . "', '"  . $CordlessBatteryType . "', "  . $CordlessBatteryDCVoltRating . ", "  .$CordlessBatteryQuantity . ") " ;
				$result = mysqli_query($db, $query);
				include('lib/show_queries.php');

				// get new AccessoryID
				$query = "SELECT MAX(AccessoryID) AS AccessoryID FROM Accessories ";
				$result = mysqli_query($db, $query);
				$row = mysqli_fetch_assoc($result);
				$AccessoryID = $row['AccessoryID'];

				// insert into Contain
				$query = "INSERT INTO Contain(ToolID, AccessoryID)
				VALUES (" . $toolID . ", " . $AccessoryID .  ") " ;
				$result = mysqli_query($db, $query);
				include('lib/show_queries.php');

				if($result === true) {
					redirect_to('add_tool_complete.php');
				} else {
					$errors = $result;
				}
			}


		}

		// insert into Generator if new tool is Generator
		if ($tools['SubType'] == Generator) {

			$PowerRating = $_POST['PowerRating'];
			$PowerRatingUnit = $_POST['PowerRatingUnit'];
			$PowerRating = $PowerRating * $PowerRatingUnit;

			$query = "INSERT INTO Generator(ToolID, PowerGenerated)
			VALUES (" . $toolID . ", '" . $PowerRating . "') " ;
			$result = mysqli_query($db, $query);
			include('lib/show_queries.php');
		}

		// insert into Saw if new tool is Saw
		if ($tools['SubType'] == Saw) {
			$BladeSize = $_POST['BladeSize'];

			$query = "INSERT INTO  Saw(ToolID, BladeSize)
			VALUES (" . $toolID . ", '" . $BladeSize .  "') " ;
			$result = mysqli_query($db, $query);
			include('lib/show_queries.php');

			// insert into accessories for cordless tool
			if ($tools['PowerSource'] == Cordless ) {
				$query = "INSERT INTO Accessories(ToolID, AccessoryDescription, Quantity, BatteryType, VoltRating, BatteryQuantity)
				VALUES  (" . $toolID . ", '" . $PowerToolAccessoryDescription . "', '"  . $PowerToolAccessoryQuantity . "', '"  . $CordlessBatteryType . "', "  . $CordlessBatteryDCVoltRating . ", "  .$CordlessBatteryQuantity . ") " ;
				$result = mysqli_query($db, $query);
				include('lib/show_queries.php');

				// get new AccessoryID
				$query = "SELECT MAX(AccessoryID) AS AccessoryID FROM Accessories ";
				$result = mysqli_query($db, $query);
				$row = mysqli_fetch_assoc($result);
				$AccessoryID = $row['AccessoryID'];

				// insert into Contain
				$query = "INSERT INTO Contain(ToolID, AccessoryID)
				VALUES (" . $toolID . ", " . $AccessoryID .  ") " ;
				$result = mysqli_query($db, $query);
				include('lib/show_queries.php');

				if($result === true) {
					redirect_to('add_tool_complete.php');
				} else {
					$errors = $result;
				}
			}
		}

		// insert into Sander if new tool is Sander
		if ($tools['SubType'] == Sander) {
			$DustBag = $_POST['DustBag'];

			$query = "INSERT INTO  Sander(ToolID, Dustbag)
			VALUES (" . $toolID . ", '" . $DustBag .  "') " ;
			$result = mysqli_query($db, $query);
			include('lib/show_queries.php');

			// insert into accessories for cordless tool
			if ($tools['PowerSource'] == Cordless ) {
				$query = "INSERT INTO Accessories(ToolID, AccessoryDescription, Quantity, BatteryType, VoltRating, BatteryQuantity)
				VALUES  (" . $toolID . ", '" . $PowerToolAccessoryDescription . "', '"  . $PowerToolAccessoryQuantity . "', '"  . $CordlessBatteryType . "', "  . $CordlessBatteryDCVoltRating . ", "  .$CordlessBatteryQuantity . ") " ;
				$result = mysqli_query($db, $query);
				include('lib/show_queries.php');

				// get new AccessoryID
				$query = "SELECT MAX(AccessoryID) AS AccessoryID FROM Accessories ";
				$result = mysqli_query($db, $query);
				$row = mysqli_fetch_assoc($result);
				$AccessoryID = $row['AccessoryID'];

				// insert into Contain
				$query = "INSERT INTO Contain(ToolID, AccessoryID)
				VALUES (" . $toolID . ", " . $AccessoryID .  ") " ;
				$result = mysqli_query($db, $query);
				include('lib/show_queries.php');

				if($result === true) {
					redirect_to('add_tool_complete.php');
				} else {
					$errors = $result;
				}
			}
		}

		// insert into Mixer if new tool is Mixer
		if ($tools['SubType'] == Mixer) {

			$MotorRating = $_POST['MotorRating'];
			$DrumSize = $_POST['DrumSize'];

			$query = "INSERT INTO  Mixer(ToolID ,MotorRating ,DrumSize)
			VALUES (" . $toolID . ", '" . $MotorRating . "', '" . $DrumSize . "') " ;
			$result = mysqli_query($db, $query);
			include('lib/show_queries.php');
		}

		// insert into AirCompressor if new tool is AirCompressor (UI not complete yet)
		if ($tools['SubType'] == AirCompressor) {

			$PressureRatingMin = $_POST['PressureRatingMin'];
			$PressureRatingMax = $_POST['PressureRatingMax'];
			$TankSize = $_POST['TankSize'];

			$query = "INSERT INTO AirCompressor(ToolID,PressureRatingMin,PressureRatingMax ,TankSize)
			VALUES (" . $toolID . ", '" . $PressureRatingMin . "', '"  . $PressureRatingMax .  "' , '"  . $TankSize .  "') " ;
			$result = mysqli_query($db, $query);
			include('lib/show_queries.php');
		}

		// insert into Accessory and Contain if there is Accessory
		if (!empty($PowerToolAccessoryDescription) AND !empty($PowerToolAccessoryQuantity)) {
			$query = "INSERT INTO Accessories(ToolID, AccessoryDescription, Quantity)
			VALUES  (" . $toolID . ", '" . $PowerToolAccessoryDescription . "', "  . $PowerToolAccessoryQuantity .  ") " ;
			$result = mysqli_query($db, $query);
			include('lib/show_queries.php');

			// get new AccessoryID
			$query = "SELECT MAX(AccessoryID) AS AccessoryID FROM Accessories ";
			$result = mysqli_query($db, $query);
			$row = mysqli_fetch_assoc($result);
			$AccessoryID = $row['AccessoryID'];

			// insert into Contain
			$query = "INSERT INTO Contain(ToolID, AccessoryID)
			VALUES (" . $toolID . ", " . $AccessoryID .  ") " ;
			$result = mysqli_query($db, $query);
			include('lib/show_queries.php');

		}


		if($result === true) {
			redirect_to('add_tool_complete.php');
		} else {
			$errors = $result;
		}

	}
/*
	if($result === true) {
	 //  $new_id = mysqli_insert_id($db);
		redirect_to('add_tool_complete.php');
	} else {
		$errors = $result;
	} */



}



?>

<?php include("lib/header.php"); ?>
<title>Add Tool</title>
<meta charset="utf-8">

<script>
	var ToolTypeGlobal = ''
	var PowerSourceGlobal =''
	var SubTypeGlobal = ''
	var SubOptionGlobal = ''
	var powersource = ['HandTool_PowerSource', 'GardenTool_PowerSource', 'Ladder_PowerSource', 'PowerTool_PowerSource'];
	var subtype = ['HandToolManual_SubType', 'GardenToolManual_SubType', 'LadderManual_SubType', 'PowerToolElectric_SubType', 'PowerToolCordless_SubType','PowerToolGas_SubType' ];
	var suboption = ['Screwdriver_SubOption', 'Socket_SubOption', 'Ratchet_SubOption', 'Wrench_SubOption', 'Pliers_SubOption', 'Gun_SubOption', 'Hammer_SubOption', 'Digger_SubOption', 'Pruner_SubOption', 'Rakes_SubOption', 'Wheelbarrows_SubOption', 'Striking_SubOption', 'Straight_SubOption', 'Step_SubOption', 'Drill_SubOption', 'Saw_SubOption', 'Sander_SubOption', 'AirCompressor_SubOption', 'Mixer_SubOption', 'Generator_SubOption'];

	function updatePowerSource(str) {
		for (i = 0; i < powersource.length; i++) {
			document.getElementById(powersource[i]).style.display="none";
			document.getElementById(powersource[i].concat("_ID")).selectedIndex = 0;
		}
		for (j = 0; j < subtype.length; j++) {
			document.getElementById(subtype[j]).style.display="none";
			document.getElementById(subtype[j].concat("_ID")).selectedIndex = 0;
		}
		for (k = 0; k < suboption.length; k++) {
			console.log(suboption[k]);
			document.getElementById(suboption[k]).style.display="none";
			document.getElementById(suboption[k].concat("_ID")).selectedIndex = 0;
			document.getElementById(suboption[k].concat("_Attributes")).style.display="none";
			document.getElementById(suboption[k].concat("_Attributes")).selectedIndex = 0;
		}
		document.getElementById("All_Attributes").style.display="none";
		document.getElementById("All_Attributes").selectedIndex = 0;
		document.getElementById("PowerTool_Attributes").style.display = "none";
		document.getElementById("PowerTool_Attributes").selectedIndex = 0;
		document.getElementById("PowerToolAccessory").style.display = "none";
		document.getElementById("CordlessBattery").style.display = "none";
		document.getElementById("CordlessBatteryType_ID").selectedIndex = 0;

		ToolTypeGlobal = str;
		SubTypeGlobal = '';
		SubOptionGlobal = '';
		if (str == 'HandTool') {
			document.getElementById('HandTool_PowerSource').style.display = "block";
		} else if (str == 'GardenTool') {
			document.getElementById('GardenTool_PowerSource').style.display = "block";
		} else if (str == 'Ladder') {
			document.getElementById('Ladder_PowerSource').style.display = "block";
		} else if (str == 'PowerTool') {
			document.getElementById('PowerTool_PowerSource').style.display = "block";
			document.getElementById('PowerToolAccessory').style.display = "block";
		}
	}
	function updateSubType(str) {
		for (j = 0; j < subtype.length; j++) {
			document.getElementById(subtype[j]).style.display="none";
			document.getElementById(subtype[j].concat("_ID")).selectedIndex = 0;
		}
		for (k = 0; k < suboption.length; k++) {
			document.getElementById(suboption[k]).style.display="none";
			document.getElementById(suboption[k].concat("_ID")).selectedIndex = 0;
			document.getElementById(suboption[k].concat("_Attributes")).style.display="none";
			document.getElementById(suboption[k].concat("_Attributes")).selectedIndex = 0;
		}
		document.getElementById("All_Attributes").style.display="none";
		document.getElementById("All_Attributes").selectedIndex = 0;
		document.getElementById("PowerTool_Attributes").style.display = "none";
		document.getElementById("PowerTool_Attributes").selectedIndex = 0;
		document.getElementById("PowerToolAccessory").style.display = "none";
		document.getElementById("CordlessBattery").style.display = "none";
		document.getElementById("CordlessBatteryType_ID").selectedIndex = 0;

		SubTypeGlobal = str;
		SubOptionGlobal = '';
		if (str == 'Manual' && ToolTypeGlobal == 'HandTool') {
			document.getElementById('HandToolManual_SubType').style.display = "block";
		} else if (str == 'Manual' && ToolTypeGlobal == 'GardenTool') {
			document.getElementById('GardenToolManual_SubType').style.display = "block";
		} else if (str == 'Manual' && ToolTypeGlobal == 'Ladder') {
			document.getElementById('LadderManual_SubType').style.display = "block";
		} else if (str == 'Electric' && ToolTypeGlobal == 'PowerTool') {
			document.getElementById('PowerToolElectric_SubType').style.display = "block";
			document.getElementById("PowerToolAccessory").style.display = "block";
		} else if (str == 'Cordless' && ToolTypeGlobal == 'PowerTool') {
			document.getElementById('PowerToolCordless_SubType').style.display = "block";
			document.getElementById('CordlessBattery').style.display = "block";
			document.getElementById("PowerToolAccessory").style.display = "block";
		} else if (str == 'Gas' && ToolTypeGlobal == 'PowerTool') {
			document.getElementById('PowerToolGas_SubType').style.display = "block";
			document.getElementById("PowerToolAccessory").style.display = "block";
		}
	}
	function updateSubOption(str) {
		for (k = 0; k < suboption.length; k++) {
			document.getElementById(suboption[k]).style.display="none";
			document.getElementById(suboption[k].concat("_ID")).selectedIndex = 0;
			document.getElementById(suboption[k].concat("_Attributes")).style.display="none";
			document.getElementById(suboption[k].concat("_Attributes")).selectedIndex = 0;
		}
		SubOptionGlobal = str;

		document.getElementById('All_Attributes').style.display="block";

		if (str == 'Screwdriver') {
			document.getElementById('Screwdriver_SubOption').style.display="block";
			document.getElementById('Screwdriver_SubOption_Attributes').style.display="block";
		} else if (str == 'Socket') {
			document.getElementById('Socket_SubOption').style.display="block";
			document.getElementById('Socket_SubOption_Attributes').style.display="block";
		} else if (str == 'Ratchet') {
			document.getElementById('Ratchet_SubOption').style.display="block";
			document.getElementById('Ratchet_SubOption_Attributes').style.display="block";
		} else if (str == 'Wrench') {
			document.getElementById('Wrench_SubOption').style.display="block";
			document.getElementById('Wrench_SubOption_Attributes').style.display="block";
		} else if (str == 'Pliers') {
			document.getElementById('Pliers_SubOption').style.display="block";
			document.getElementById('Pliers_SubOption_Attributes').style.display="block";
		} else if (str == 'Gun') {
			document.getElementById('Gun_SubOption').style.display="block";
			document.getElementById('Gun_SubOption_Attributes').style.display="block";
		} else if (str == 'Hammer') {
			document.getElementById('Hammer_SubOption').style.display="block";
			document.getElementById('Hammer_SubOption_Attributes').style.display="block";
		} else if (str == 'Digger') {
			document.getElementById('Digger_SubOption').style.display="block";
			document.getElementById('Digger_SubOption_Attributes').style.display="block";
		} else if (str == 'Pruner') {
			document.getElementById('Pruner_SubOption').style.display="block";
			document.getElementById('Pruner_SubOption_Attributes').style.display="block";
		} else if (str == 'Rakes') {
			document.getElementById('Rakes_SubOption').style.display="block";
			document.getElementById('Rakes_SubOption_Attributes').style.display="block";
		} else if (str == 'Wheelbarrows') {
			document.getElementById('Wheelbarrows_SubOption').style.display="block";
			document.getElementById('Wheelbarrows_SubOption_Attributes').style.display="block";
		} else if (str == 'Striking') {
			document.getElementById('Striking_SubOption').style.display="block";
			document.getElementById('Striking_SubOption_Attributes').style.display="block";
		} else if (str == 'Straight') {
			document.getElementById('Straight_SubOption').style.display="block";
			document.getElementById('Straight_SubOption_Attributes').style.display="block";
		} else if (str == 'Step') {
			document.getElementById('Step_SubOption').style.display="block";
			document.getElementById('Step_SubOption_Attributes').style.display="block";
		} else if (str == 'Drill') {
			document.getElementById('Drill_SubOption').style.display="block";
			document.getElementById('PowerTool_Attributes').style.display="block";
			document.getElementById('Drill_SubOption_Attributes').style.display="block";
		} else if (str == 'Saw') {
			document.getElementById('Saw_SubOption').style.display="block";
			document.getElementById('PowerTool_Attributes').style.display="block";
			document.getElementById('Saw_SubOption_Attributes').style.display="block";
		} else if (str == 'Sander') {
			document.getElementById('Sander_SubOption').style.display="block";
			document.getElementById('PowerTool_Attributes').style.display="block";
			document.getElementById('Sander_SubOption_Attributes').style.display="block";
		} else if (str == 'AirCompressor') {
			document.getElementById('AirCompressor_SubOption').style.display="block";
			document.getElementById('PowerTool_Attributes').style.display="block";
			document.getElementById('AirCompressor_SubOption_Attributes').style.display="block";
		} else if (str == 'Mixer') {
			document.getElementById('Mixer_SubOption').style.display="block";
			document.getElementById('PowerTool_Attributes').style.display="block";
			document.getElementById('Mixer_SubOption_Attributes').style.display="block";
		} else if (str == 'Generator') {
			document.getElementById('Generator_SubOption').style.display="block";
			document.getElementById('PowerTool_Attributes').style.display="block";
			document.getElementById('Generator_SubOption_Attributes').style.display="block";
		}
	}

	$(document).ready(function () {
		var counter = 0;

		$("#addrow").on("click", function () {
			var newRow = $("<tr>");
			var cols = "";

			cols += '<td><input type="text" class="form-control" name="name' + counter + '"/></td>';
			cols += '<td><input type="text" class="form-control" name="mail' + counter + '"/></td>';
			cols += '<td><input type="text" class="form-control" name="phone' + counter + '"/></td>';

			cols += '<td><input type="button" class="ibtnDel btn btn-md btn-danger "  value="Delete"></td>';
			newRow.append(cols);
			$("table.order-list").append(newRow);
			counter++;
		});



		$("table.order-list").on("click", ".ibtnDel", function (event) {
			$(this).closest("tr").remove();
			counter -= 1
		});


	});



	function addRow(input) {
		var table = document.getElementById("myTable");
		var i = parseInt(input.id.substring(3, input.id.length));
		document.getElementById('icon' + i).className = "glyphicon glyphicon-minus";
		var row = table.insertRow(table.rows.length);
		row.id = "row" + (i + 1);
		var cell = row.insertCell(0);
		cell.innerHTML = '<div class="row">'+
		'<div class="col-sm-3 form-group">'+
		'<input type="number" class="form-control" name="PowerToolAccessoryQuantity" placeholder="Enter Accessory Quantity">'+
		'</div>'+
		'<div class="col-sm-4 form-group">'+
		'<input type="text" class="form-control" name="PowerToolAccessoryDescription" placeholder="Enter Accessory Description">'+
		'</div>'+
		'<span class="input-group-btn">'+
		'<button id="btn'+(i+1)+'" type="button" class="btn btn-primary" onclick="addRow(this)">'+
		'<span id="icon'+(i+1)+'" class="glyphicon glyphicon-plus"></span>'+
		'</button>'+
		'</span>'+
		'</div>';
		document.getElementById('btn'+i).setAttribute("onclick", "remRow(this)");
	}

	function remRow(input) {
		var table = document.getElementById("myTable");
		var i = parseInt(input.id.substring(3, input.id.length));
		var ind = table.rows["row" +i].rowIndex;
		table.deleteRow(ind);
	}

</script>
</head>
<body>
	<div id="main_container">
		<?php include("lib/clerk_menu.php"); ?>

		<div class="center_content">
			<h1 class="well">Add Tool</h1>
			<?php echo display_errors($errors); ?>
			<div class="col-sm-12">
				<form name="addtoolform" action="add_tool.php" method="post">
					<div class="row">
						<div class="form-group">
							<label>Type: </label>
							<label class="radio-inline"><input type="radio" name="ToolType" value="HandTool" onclick="updatePowerSource(this.value)"> Hand Tool </label>
							<label class="radio-inline"><input type="radio" name="ToolType" value="GardenTool" onclick="updatePowerSource(this.value)"> Garden Tool </label>
							<label class="radio-inline"><input type="radio" name="ToolType" value="Ladder" onclick="updatePowerSource(this.value)"> Ladder </label>
							<label class="radio-inline"><input type="radio" name="ToolType" value="PowerTool" onclick="updatePowerSource(this.value)"> Power Tool </label>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4 form-group">
							<div class="form-group" id="HandTool_PowerSource" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Power Source:</b></div>
								<select class="form-control" name="HandTool_PowerSource" id="HandTool_PowerSource_ID" onChange="updateSubType(this.value)" >
									<option value='SelectPowerSource' disabled selected>Select Power Source</option>
									<option value='Manual'>Manual</option>
								</select>
							</div>
							<div class="form-group" id="GardenTool_PowerSource" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Power Source:</b></div>
								<select class="form-control" name="GardenTool_PowerSource" id="GardenTool_PowerSource_ID" onChange="updateSubType(this.value)" >
									<option value='SelectPowerSource' disabled selected>Select Power Source</option>
									<option value='Manual'>Manual</option>
								</select>
							</div>
							<div class="form-group" id="Ladder_PowerSource" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Power Source:</b></div>
								<select class="form-control" name="Ladder_PowerSource" id="Ladder_PowerSource_ID" onChange="updateSubType(this.value)" >
									<option value='SelectPowerSource' disabled selected>Select Power Source</option>
									<option value='Manual'>Manual</option>
								</select>
							</div>
							<div class="form-group" id="PowerTool_PowerSource" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Power Source:</b></div>
								<select class="form-control" name="PowerTool_PowerSource" id="PowerTool_PowerSource_ID" onChange="updateSubType(this.value)" >
									<option value='SelectPowerSource' disabled selected>Select Power Source</option>
									<option value='Electric'>Electric</option>
									<option value='Cordless'>Cordless</option>
									<option value='Gas'>Gas</option>
								</select>
							</div>
						</div>
						<div class="col-sm-4 form-group">
							<div class="form-group" id="HandToolManual_SubType" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Sub Type:</b></div>
								<select class="form-control" name="HandToolManual_SubType" id="HandToolManual_SubType_ID" onChange="updateSubOption(this.value)" >
									<option value='SelectSubType' disabled selected>Select Sub-Type</option>
									<option value='Screwdriver'>Screwdriver</option>
									<option value='Socket'>Socket</option>
									<option value='Ratchet'>Ratchet</option>
									<option value='Wrench'>Wrench</option>
									<option value='Pliers'>Pliers</option>
									<option value='Gun'>Gun</option>
									<option value='Hammer'>Hammer</option>
								</select>
							</div>
							<div class="form-group" id="GardenToolManual_SubType" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Sub Type:</b></div>
								<select class="form-control" name="GardenToolManual_SubType" id="GardenToolManual_SubType_ID" onChange="updateSubOption(this.value)" >
									<option value='SelectSubType' disabled selected>Select Sub-Type</option>
									<option value='Digger'>Digger</option>
									<option value='Pruner'>Pruner</option>
									<option value='Rakes'>Rakes</option>
									<option value='Wheelbarrows'>Wheelbarrows</option>
									<option value='Striking'>Striking</option>
								</select>
							</div>
							<div class="form-group" id="LadderManual_SubType" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Sub Type:</b></div>
								<select class="form-control" name="LadderManual_SubType" id="LadderManual_SubType_ID" onChange="updateSubOption(this.value)" >
									<option value='SelectSubType' disabled selected>Select Sub-Type</option>
									<option value='Straight' onclick="updateSubOption(this.value)">Straight</option>
									<option value='Step' onclick="updateSubOption(this.value)">Step</option>
								</select>
							</div>
							<div class="form-group" id="PowerToolElectric_SubType" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Sub Type:</b></div>
								<select class="form-control" name="PowerToolElectric_SubType" id="PowerToolElectric_SubType_ID" onChange="updateSubOption(this.value)" >
									<option value='SelectSubType' disabled selected>Select Sub-Type</option>
									<option value='Drill'>Drill</option>
									<option value='Saw'>Saw</option>
									<option value='Sander'>Sander</option>
									<option value='AirCompressor'>Air-Compressor</option>
									<option value='Mixer'>Mixer</option>
								</select>
							</div>
							<div class="form-group" id="PowerToolCordless_SubType" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Sub Type:</b></div>
								<select class="form-control" name="PowerToolCordless_SubType" id="PowerToolCordless_SubType_ID" onChange="updateSubOption(this.value)" >
									<option value='SelectSubType' disabled selected>Select Sub-Type</option>
									<option value='Drill'>Drill</option>
									<option value='Saw'>Saw</option>
									<option value='Sander'>Sander</option>
								</select>
							</div>
							<div class="form-group" id="PowerToolGas_SubType" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Sub Type:</b></div>
								<select class="form-control" name="PowerToolGas_SubType" id="PowerToolGas_SubType_ID" onChange="updateSubOption(this.value)" >
									<option value='SelectSubType' disabled selected>Select Sub-Type</option>
									<option value='AirCompressor'>Air-Compressor</option>
									<option value='Mixer'>Mixer</option>
									<option value='Generator'>Generator</option>
								</select>
							</div>
						</div>
						<div class="col-sm-4 form-group">
							<div class="form-group" id="Screwdriver_SubOption" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Sub Option:</b></div>
								<select class="form-control" name="Screwdriver_SubOption" id="Screwdriver_SubOption_ID">
									<option value='SelectSubOption' disabled selected>Select Sub-Option</option>
									<option value='phillips(cross)'>phillips (cross)</option>
									<option value='hex'>hex</option>
									<option value='torx'>torx</option>
									<option value='slotted(flat)'>slotted (flat)</option>
								</select>
							</div>
							<div class="form-group" id="Socket_SubOption" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Sub Option:</b></div>
								<select class="form-control" name="Socket_SubOption" id="Socket_SubOption_ID">
									<option value='SelectSubOption' disabled selected>Select Sub-Option</option>
									<option value='deep' >deep</option>
									<option value='standard' >standard</option>
								</select>
							</div>
							<div class="form-group" id="Ratchet_SubOption" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Sub Option:</b></div>
								<select class="form-control" name="Ratchet_SubOption" id="Ratchet_SubOption_ID">
									<option value='SelectSubOption' disabled selected>Select Sub-Option</option>
									<option value='adjustable'>adjustable</option>
									<option value='fixed'>fixed</option>
								</select>
							</div>
							<div class="form-group" id="Wrench_SubOption" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Sub Option:</b></div>
								<select class="form-control" name="Wrench_SubOption" id="Wrench_SubOption_ID">
									<option value='SelectSubOption' disabled selected>Select Sub-Option</option>
									<option value='crescent'>crescent</option>
									<option value='torque'>torque</option>
									<option value='pipe'>pipe</option>
								</select>
							</div>
							<div class="form-group" id="Pliers_SubOption" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Sub Option:</b></div>
								<select class="form-control" name="Pliers_SubOption" id="Pliers_SubOption_ID">
									<option value='SelectSubOption' disabled selected>Select Sub-Option</option>
									<option value='needle nose'>needle nose</option>
									<option value='cutting'>cutting</option>
									<option value='crimper'>crimper</option>
								</select>
							</div>
							<div class="form-group" id="Gun_SubOption" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Sub Option:</b></div>
								<select class="form-control" name="Gun_SubOption" id="Gun_SubOption_ID">
									<option value='SelectSubOption' disabled selected>Select Sub-Option</option>
									<option value='nail'>nail</option>
									<option value='staple'>staple</option>
								</select>
							</div>
							<div class="form-group" id="Hammer_SubOption" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Sub Option:</b></div>
								<select class="form-control" name="Hammer_SubOption" id="Hammer_SubOption_ID">
									<option value='SelectSubOption' disabled selected>Select Sub-Option</option>
									<option value='claw'>claw</option>
									<option value='sledge'>sledge</option>
									<option value='framing'>framing</option>
								</select>
							</div>
							<div class="form-group" id="Digger_SubOption" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Sub Option:</b></div>
								<select class="form-control" name="Digger_SubOption" id="Digger_SubOption_ID">
									<option value='SelectSubOption' disabled selected>Select Sub-Option</option>
									<option value='pointed shovel'>pointed shovel</option>
									<option value='flat shovel'>flat shovel</option>
									<option value='scoop shovel'>scoop shovel</option>
									<option value='edger'>edger</option>
								</select>
							</div>
							<div class="form-group" id="Pruner_SubOption" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Sub Option:</b></div>
								<select class="form-control" name="Pruner_SubOption" id="Pruner_SubOption_ID">
									<option value='SelectSubOption' disabled selected>Select Sub-Option</option>
									<option value='sheer'>sheer</option>
									<option value='loppers'>loppers</option>
									<option value='hedge'>hedge</option>
								</select>
							</div>
							<div class="form-group" id="Rakes_SubOption" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Sub Option:</b></div>
								<select class="form-control" name="Rakes_SubOption" id="Rakes_SubOption_ID">
									<option value='SelectSubOption' disabled selected>Select Sub-Option</option>
									<option value='leaf'>leaf</option>
									<option value='landscaping'>landscaping</option>
									<option value='rock'>rock</option>
								</select>
							</div>
							<div class="form-group" id="Wheelbarrows_SubOption" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Sub Option:</b></div>
								<select class="form-control" name="Wheelbarrows_SubOption" id="Wheelbarrows_SubOption_ID">
									<option value='SelectSubOption' disabled selected>Select Sub-Option</option>
									<option value='1-wheel'>1-wheel</option>
									<option value='2-wheel'>2-wheel</option>
								</select>
							</div>
							<div class="form-group" id="Striking_SubOption" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Sub Option:</b></div>
								<select class="form-control" name="Striking_SubOption" id="Striking_SubOption_ID">
									<option value='SelectSubOption' disabled selected>Select Sub-Option</option>
									<option value='bar pry'>bar pry</option>
									<option value='rubber mallet'>rubber mallet</option>
									<option value='tamper'>tamper</option>
									<option value='pick axe'>pick axe</option>
									<option value='single bit axe'>single bit axe</option>
								</select>
							</div>
							<div class="form-group" id="Straight_SubOption" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Sub Option:</b></div>
								<select class="form-control" name="Straight_SubOption" id="Straight_SubOption_ID">
									<option value='SelectSubOption' disabled selected>Select Sub-Option</option>
									<option value='rigid'>rigid</option>
									<option value='telescoping'>telescoping</option>
								</select>
							</div>
							<div class="form-group" id="Step_SubOption" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Sub Option:</b></div>
								<select class="form-control" name="Step_SubOption" id="Step_SubOption_ID">
									<option value='SelectSubOption' disabled selected>Select Sub-Option</option>
									<option value='folding'>folding</option>
									<option value='multi-position'>multi-position</option>
								</select>
							</div>
							<div class="form-group" id="Drill_SubOption" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Sub Option:</b></div>
								<select class="form-control" name="Drill_SubOption" id="Drill_SubOption_ID">
									<option value='SelectSubOption' disabled selected>Select Sub-Option</option>
									<option value='driver'>driver</option>
									<option value='hammer'>hammer</option>
								</select>
							</div>
							<div class="form-group" id="Saw_SubOption" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Sub Option:</b></div>
								<select class="form-control" name="Saw_SubOption" id="Saw_SubOption_ID">
									<option value='SelectSubOption' disabled selected>Select Sub-Option</option>
									<option value='circular'>circular</option>
									<option value='reciprocating'>reciprocating</option>
									<option value='jig'>jig</option>
								</select>
							</div>
							<div class="form-group" id="Sander_SubOption" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Sub Option:</b></div>
								<select class="form-control" name="Sander_SubOption" id="Sander_SubOption_ID">
									<option value='SelectSubOption' disabled selected>Select Sub-Option</option>
									<option value='finish'>finish</option>
									<option value='sheet'>sheet</option>
									<option value='belt'>belt</option>
									<option value='random orbital'>random orbital</option>
								</select>
							</div>
							<div class="form-group" id="AirCompressor_SubOption" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Sub Option:</b></div>
								<select class="form-control" name="AirCompressor_SubOption" id="AirCompressor_SubOption_ID">
									<option value='SelectSubOption' disabled selected>Select Sub-Option</option>
									<option value='reciprocating'>reciprocating</option>
								</select>
							</div>
							<div class="form-group" id="Mixer_SubOption" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Sub Option:</b></div>
								<select class="form-control" name="Mixer_SubOption" id="Mixer_SubOption_ID">
									<option value='SelectSubOption' disabled selected>Select Sub-Option</option>
									<option value='concrete'>concrete</option>
								</select>
							</div>
							<div class="form-group" id="Generator_SubOption" style="display: none">
								<div class="col-sm-4" style="text-align: left;"><b>Sub Option:</b></div>
								<select class="form-control" name="Generator_SubOption" id="Generator_SubOption_ID">
									<option value='SelectSubOption' disabled selected>Select Sub-Option</option>
									<option value='electric'>electric</option>
								</select>
							</div>
						</div>
					</div>
					<div class="form-group" id="CordlessBattery" style="display: none">
						<div class="row">
							<div class="col-sm-4" style="text-align: left;"><b>Battery Type:</b></div>
							<div class="col-sm-4" style="text-align: left;"><b>Battery Quantity:</b></div>
							<div class="col-sm-4" style="text-align: left;"><b>DC Volt Rating (7.2-80.0 Volts):</b></div>
						</div>
						<div class="row">
							<div class="col-sm-4 form-group">
								<select class="form-control" name="CordlessBatteryType" id="CordlessBatteryType_ID" >
									<option value='' disabled selected>Select Battery Type</option>
									<option value='Li-Ion'>Li-Ion</option>
									<option value='NiCd'>NiCd</option>
									<option value='NiMH'>NiMH</option>
								</select>
							</div>
							<div class="col-sm-4 form-group">
								<input type="number" class="form-control" name="CordlessBatteryQuantity" placeholder="Enter Battery Quantity">
							</div>
							<div class="col-sm-3 form-group">
								<input type="number" class="form-control" name="CordlessBatteryDCVoltRating" placeholder="Enter D/C Volt Rating">
							</div>
							<span class="input-group-btn" style="width:0px;"></span>
							<div class="col-sm-1 form-group">
								<select class="form-control" name="CordlessBatteryDCVoltRatingUnit">
									<option value="" selected disabled>Enter Volt Unit</option>
									<option value='0.001'>mili</option>
									<option value='1'> </option>
									<option value='1000'>kilo</option>
								</select>
							</div>
						</div>
					</div>
					<div id="All_Attributes" style="display: none">
						<div class="row">
							<div class="col-sm-3" style="text-align: left;"><b>Purchase Price:</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Manufacturer:</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Material:</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Weight:</b></div>
						</div>
						<div class="row">
							<div class="col-sm-3 form-group">
								<div class="input-group">
									<span class="input-group-addon" id="sizing-addon2">$</span>
									<input type="number" class="form-control" name="PurchasePrice" placeholder="Enter Purchase Price">
								</div>
							</div>
							<div class="col-sm-3 form-group">
								<input type="text" class="form-control" name="Manufacturer" placeholder="Enter Manufacturer">
							</div>
							<div class="col-sm-3 form-group">
								<input type="text" class="form-control" name="Material" placeholder="Enter Material">
							</div>
							<div class="col-sm-3 form-group">
								<input type="text" class="form-control" name="Weight" placeholder="Enter Weight">
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3" style="text-align: left;"><b>Width:</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Width Fraction:</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Width Unit:</b></div>
						</div>
						<div class="row">
							<div class="col-sm-3 form-group">
								<input type="number" class="form-control" name="Width" placeholder="Enter Width">
							</div>
							<div class="col-sm-3 form-group">
								<select class="form-control" name="WidthFraction" id="WidthFraction_ID">
									<option value=0 selected>0</option>
									<option value=0.125>1/8</option>
									<option value=0.25>1/4</option>
									<option value=0.375>3/8</option>
									<option value=0.5>1/2</option>
									<option value=0.625>5/8</option>
									<option value=0.75>3/4</option>
									<option value=0.875>7/8</option>
								</select>
							</div>
							<div class="col-sm-3 form-group">
								<select class="form-control" name="WidthUnit" id="WidthUnit_ID">
									<option value='inch' selected>inches</option>
									<option value='feet'>feet</option>
								</select>
							</div>
						</div>
						<div class="row">
							<div class="col-sm-3" style="text-align: left;"><b>Length:</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Length Fraction:</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Length Unit:</b></div>
						</div>
						<div class="row">
							<div class="col-sm-3 form-group">
								<input type="number" class="form-control" name="Length" placeholder="Enter Length">
							</div>
							<div class="col-sm-3 form-group">
								<select class="form-control" name="LengthFraction" id="LengthFraction_ID">
									<option value=0 selected>0</option>
									<option value=0.125>1/8</option>
									<option value=0.25>1/4</option>
									<option value=0.375>3/8</option>
									<option value=0.5>1/2</option>
									<option value=0.625>5/8</option>
									<option value=0.75>3/4</option>
									<option value=0.875>7/8</option>
								</select>
							</div>
							<div class="col-sm-3 form-group">
								<select class="form-control" name="LengthUnit" id="LengthUnit_ID">
									<option value='inch' selected>inches</option>
									<option value='feet'>feet</option>
								</select>
							</div>
						</div>
					</div>
					<div id="Screwdriver_SubOption_Attributes" style="display: none">
						<div class="row">
							<div class="col-sm-3" style="text-align: left;"><b>Screw Size:</b></div>
						</div>
						<div class="row">
							<div class="col-sm-3 form-group">
								<input type="number" class="form-control" name="ScrewSize" placeholder="Enter Screw Size">
							</div>
						</div>
					</div>
					<div id="Socket_SubOption_Attributes" style="display: none">
						<div class="row">
							<div class="col-sm-3" style="text-align: left;"><b>Drive Size (inch):</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Sae Size:</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Deep Socket:</b></div>
						</div>
						<div class="row">
							<div class="col-sm-3 form-group">
								<select class="form-control" name="Socket_DriveSize">
									<option value="" selected disabled>Enter Drive Size</option>
									<option value='1/4"'>1/4"</option>
									<option value='1/2"'>1/2"</option>
									<option value='3/8"'>3/8"</option>
									<option value='3/4"'>3/4"</option>
								</select>
							</div>
							<div class="col-sm-3 form-group">
								<input type="number" class="form-control" name="SaeSize" placeholder="Enter Sae Size">
							</div>
							<div class="col-sm-3 form-group">
								<select class="form-control" name="DeepSocket">
									<option value="" selected disabled>True/False</option>
									<option value='1'>True</option>
									<option value='0'>False</option>
								</select>
							</div>
						</div>
					</div>
					<div id="Ratchet_SubOption_Attributes" style="display: none">
						<div class="row">
							<div class="col-sm-3" style="text-align: left;"><b>Drive Size (inch):</b></div>
						</div>
						<div class="row">
							<div class="col-sm-3 form-group">
								<select class="form-control" name="Ratchet_DriveSize">
									<option value="" selected disabled>Enter Drive Size</option>
									<option value='1/4"'>1/4"</option>
									<option value='1/2"'>1/2"</option>
									<option value='3/8"'>3/8"</option>
									<option value='3/4"'>3/4"</option>
								</select>
							</div>
						</div>
					</div>
					<div id="Wrench_SubOption_Attributes" style="display: none">
					</div>
					<div id="Pliers_SubOption_Attributes" style="display: none">
						<div class="row">
							<div class="col-sm-3" style="text-align: left;"><b>Adjustable:</b></div>
						</div>
						<div class="row">
							<div class="col-sm-3 form-group">
								<select class="form-control" name="Adjustable">
									<option value="" selected disabled>True/False</option>
									<option value='1'>True</option>
									<option value='0'>False</option>
								</select>
							</div>
						</div>
					</div>
					<div id="Gun_SubOption_Attributes" style="display: none">
						<div class="row">
							<div class="col-sm-3" style="text-align: left;"><b>Gauge Rating (gauge):</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Capacity (number of nails/staples):</b></div>
						</div>
						<div class="row">
							<div class="col-sm-3 form-group">
								<select class="form-control" name="GaugeRating">
									<option value="" selected disabled>Enter Gauge Rating</option>
									<option value='18G'>18G</option>
									<option value='20G'>20G</option>
									<option value='22G'>22G</option>
									<option value='24G'>24G</option>
								</select>
							</div>
							<div class="col-sm-3 form-group">
								<input type="number" class="form-control" name="Capacity" placeholder="Enter Capacity">
							</div>
						</div>
					</div>
					<div id="Hammer_SubOption_Attributes" style="display: none">
						<div class="row">
							<div class="col-sm-3" style="text-align: left;"><b>Anti-vibration:</b></div>
						</div>
						<div class="row">
							<div class="col-sm-3 form-group">
								<select class="form-control" name="AntiVibration">
									<option value="" selected disabled>True/False</option>
									<option value='1'>True</option>
									<option value='0'>False</option>
								</select>
							</div>
						</div>
					</div>
					<div id="Pruner_SubOption_Attributes" style="display: none">
						<div class="row">
							<div class="col-sm-3" style="text-align: left;"><b>Handle Material:</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Blade Material:</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Blade Length (inch):</b></div>
						</div>
						<div class="row">
							<div class="col-sm-3 form-group">
								<input type="text" class="form-control" name="Pruner_HandleMaterial" placeholder="Enter Handle Material">
							</div>
							<div class="col-sm-3 form-group">
								<input type="number" class="form-control" name="BladeMaterial" placeholder="Enter Blade Material">
							</div>
							<div class="col-sm-3 form-group">
								<input type="number" class="form-control" name="Pruner_BladeLength" placeholder="Enter Blade Length">
							</div>
						</div>
					</div>
					<div id="Striking_SubOption_Attributes" style="display: none">
						<div class="row">
							<div class="col-sm-3" style="text-align: left;"><b>Handle Material:</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Head Weight (pound):</b></div>
						</div>
						<div class="row">
							<div class="col-sm-3 form-group">
								<input type="text" class="form-control" name="Striking_HandleMaterial" placeholder="Enter Handle Material">
							</div>
							<div class="col-sm-3 form-group">
								<input type="number" class="form-control" name="HeadWeight" placeholder="Enter Head Weight">
							</div>
						</div>
					</div>
					<div id="Digger_SubOption_Attributes" style="display: none">
						<div class="row">
							<div class="col-sm-3" style="text-align: left;"><b>Handle Material:</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Blade Width (inch):</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Blade Length:</b></div>
						</div>
						<div class="row">
							<div class="col-sm-3 form-group">
								<input type="text" class="form-control" name="Digger_HandleMaterial" placeholder="Enter Handle Material">
							</div>
							<div class="col-sm-3 form-group">
								<input type="number" class="form-control" name="BladeWidth" placeholder="Enter Blade Width">
							</div>
							<div class="col-sm-3 form-group">
								<input type="number" class="form-control" name="Digger_BladeLength" placeholder="Enter Blade Length">
							</div>
						</div>
					</div>
					<div id="Rakes_SubOption_Attributes" style="display: none">
						<div class="row">
							<div class="col-sm-3" style="text-align: left;"><b>Handle Material:</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Tine Count:</b></div>
						</div>
						<div class="row">
							<div class="col-sm-3 form-group">
								<input type="text" class="form-control" name="Rakes_HandleMaterial" placeholder="Enter Handle Material">
							</div>
							<div class="col-sm-3 form-group">
								<input type="number" class="form-control" name="TineCount" placeholder="Enter Tine Count">
							</div>
						</div>
					</div>
					<div id="Wheelbarrows_SubOption_Attributes" style="display: none">
						<div class="row">
							<div class="col-sm-3" style="text-align: left;"><b>Handle Material:</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Bin Material:</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Bin Volume (cubic feet):</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Wheel Count:</b></div>
						</div>
						<div class="row">
							<div class="col-sm-3 form-group">
								<input type="text" class="form-control" name="Wheelbarrows_HandleMaterial" placeholder="Enter Handle Material">
							</div>
							<div class="col-sm-3 form-group">
								<input type="text" class="form-control" name="BinMaterial" placeholder="Enter Bin Material">
							</div>
							<div class="col-sm-3 form-group">
								<input type="number" class="form-control" name="BinVolume" placeholder="Enter Bin Volume">
							</div>
							<div class="col-sm-3 form-group">
								<input type="number" class="form-control" name="WheelCount" placeholder="Enter Wheel Count">
							</div>
						</div>
					</div>
					<div id="PowerTool_Attributes" style="display: none">
						<div class="row">
							<div class="col-sm-3" style="text-align: left;"><b>Volt Rating:</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Amp Rating:</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Min RPM Rating:</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Max RPM Rating:</b></div>
						</div>
						<div class="row">
							<div class="col-sm-3 form-group">
								<select class="form-control" name="VoltRating">
									<option value="" selected disabled>Enter Volt Rating</option>
									<option value='110'>110V</option>
									<option value='120'>120V</option>
									<option value='220'>220V</option>
									<option value='240'>240V</option>
								</select>
							</div>
							<div class="col-sm-2 form-group">
								<input type="number" class="form-control" name="AmpRating" placeholder="Enter Amp Rating">
							</div>
							<span class="input-group-btn" style="width:0px;"></span>
							<div class="col-sm-1 form-group">
								<select class="form-control" name="AmpRatingUnit">
									<option value="" selected disabled>Enter Amp Unit</option>
									<option value='0.001'>mili</option>
									<option value='1'> </option>
									<option value='1000'>kilo</option>
								</select>
							</div>
							<div class="col-sm-3 form-group">
								<input type="number" class="form-control" name="MinRPMRating" placeholder="Enter Min RPM Rating">
							</div>
							<div class="col-sm-3 form-group">
								<input type="number" class="form-control" name="MaxRPMRating" placeholder="Enter Max RPM Rating">
							</div>
						</div>
					</div>
					<div id="Drill_SubOption_Attributes" style="display: none">
						<div class="row">
							<div class="col-sm-3" style="text-align: left;"><b>Adjustable Clutch:</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Min Torque Rating (ft-lb):</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Max Torque Rating (ft-lb):</b></div>
						</div>
						<div class="row">
							<div class="col-sm-3 form-group">
								<select class="form-control" name="AdjustableClutch">
									<option value="" selected disabled>True/False</option>
									<option value='1'>True</option>
									<option value='0'>False</option>
								</select>
							</div>
							<div class="col-sm-3 form-group">
								<input type="number" class="form-control" name="MinTorqueRating" placeholder="Enter Min Torque Rating">
							</div>
							<div class="col-sm-3 form-group">
								<input type="number" class="form-control" name="MaxTorqueRating" placeholder="Enter Max Torque Rating">
							</div>
						</div>
					</div>
					<div id="Saw_SubOption_Attributes" style="display: none">
						<div class="row">
							<div class="col-sm-3" style="text-align: left;"><b>Blade Size (inch):</b></div>
						</div>
						<div class="row">
							<div class="col-sm-3 form-group">
								<input type="number" class="form-control" name="BladeSize" placeholder="Enter Blade Size">
							</div>
						</div>
					</div>
					<div id="Sander_SubOption_Attributes" style="display: none">
						<div class="row">
							<div class="col-sm-3" style="text-align: left;"><b>Dust Bag:</b></div>
						</div>
						<div class="row">
							<div class="col-sm-3 form-group">
								<select class="form-control" name="DustBag">
									<option value="" selected disabled>True/False</option>
									<option value="1">True</option>
									<option value="0">False</option>
								</select>
							</div>
						</div>
					</div>
					<div id="AirCompressor_SubOption_Attributes" style="display: none">
						<div class="row">
							<div class="col-sm-3" style="text-align: left;"><b>Tank Size (gallon):</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Pressure Rating Max (psi):</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Pressure Rating Min (psi):</b></div>
						</div>
						<div class="row">
							<div class="col-sm-3 form-group">
								<input type="number" class="form-control" name="TankSize" placeholder="Enter Tank Size">
							</div>
							<div class="col-sm-3 form-group">
								<input type="number" class="form-control" name="PressureRatingMax" placeholder="Enter Pressure Rating Max">
							</div>
							<div class="col-sm-3 form-group">
								<input type="number" class="form-control" name="PressureRatingMin" placeholder="Enter Pressure Rating Min">
							</div>
						</div>
					</div>
					<div id="Mixer_SubOption_Attributes" style="display: none">
						<div class="row">
							<div class="col-sm-3" style="text-align: left;"><b>Motor Rating (HP):</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Drum Size (cubic feet):</b></div>
						</div>
						<div class="row">
							<div class="col-sm-3 form-group">
								<input type="number" class="form-control" name="MotorRating" placeholder="Enter Motor Rating">
							</div>
							<div class="col-sm-3 form-group">
								<input type="number" class="form-control" name="DrumSize" placeholder="Enter Drum Size">
							</div>
						</div>
					</div>
					<div id="Generator_SubOption_Attributes" style="display: none">
						<div class="row">
							<div class="col-sm-3" style="text-align: left;"><b>Power Rating (watts):</b></div>
						</div>
						<div class="row">
							<div class="col-sm-2 form-group">
								<input type="number" class="form-control" name="PowerRating" placeholder="Enter Power Rating">
							</div>
							<span class="input-group-btn" style="width:0px;"></span>
							<div class="col-sm-1 form-group">
								<select class="form-control" name="PowerRatingUnit">
									<option value="" selected disabled>Enter Power Unit</option>
									<option value='0.001'>mili</option>
									<option value='1'> </option>
									<option value='1000'>kilo</option>
								</select>
							</div>
						</div>
					</div>
					<div id="Straight_SubOption_Attributes" style="display: none">
						<div class="row">
							<div class="col-sm-3" style="text-align: left;"><b>Step Count:</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Weight Capacity (pound):</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Rubber Feet:</b></div>
						</div>
						<div class="row">
							<div class="col-sm-3 form-group">
								<input type="number" class="form-control" name="Straight_StepCount" placeholder="Enter Step Count">
							</div>
							<div class="col-sm-3 form-group">
								<input type="number" class="form-control" name="Straight_WeightCapacity" placeholder="Enter Weight Capacity">
							</div>
							<div class="col-sm-3 form-group">
								<select class="form-control" name="RubberFeet">
									<option value="" selected disabled>True/False</option>
									<option value='1'>True</option>
									<option value='0'>False</option>
								</select>
							</div>
						</div>
					</div>

					<div id="Step_SubOption_Attributes" style="display: none">
						<div class="row">
							<div class="col-sm-3" style="text-align: left;"><b>Step Count:</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Weight Capacity (pound):</b></div>
							<div class="col-sm-3" style="text-align: left;"><b>Pail Shelf:</b></div>
						</div>
						<div class="row">
							<div class="col-sm-3 form-group">
								<input type="number" class="form-control" name="Step_StepCount" placeholder="Enter Step Count">
							</div>
							<div class="col-sm-3 form-group">
								<input type="number" class="form-control" name="Step_WeightCapacity" placeholder="Enter Weight Capacity">
							</div>
							<div class="col-sm-3 form-group">
								<select class="form-control" name="PailShelf">
									<option value="" selected disabled>True/False</option>
									<option value='1'>True</option>
									<option value='0'>False</option>
								</select>
							</div>
						</div>
					</div>

					<div class="form-group" id="PowerToolAccessory" style="display: none">
						<table class="table" id="myTable">
							<thead>
								<div class="row">
									<div class="col-sm-3" style="text-align: left;"><b>Accessory Quantity:</b></div>
									<div class="col-sm-4" style="text-align: left;"><b>Accessory Description:</b></div>
								</div>
							</thead>
							<tbody>
								<tr id="row0">
									<td>
										<div class="row">
											<div class="col-sm-3 form-group">
												<input type="number" class="form-control" name="PowerToolAccessoryQuantity" placeholder="Enter Accessory Quantity">
											</div>
											<div class="col-sm-4 form-group">
												<input type="text" class="form-control" name="PowerToolAccessoryDescription" placeholder="Enter Accessory Description">
											</div>
											<span class="input-group-btn">
												<button id="btn0" type="button" class="btn btn-primary" onclick="addRow(this)">
													<span id="icon0" class="glyphicon glyphicon-plus"></span>
												</button>
											</span>
										</div>
									</td>
								</tr>
							</tbody>
						</table>
					</div>

					<a href="javascript:addtoolform.submit();"><button type="button" class="btn btn-lg btn-info">Confirm</button></a><br>
				</form>
			</div>
			<?php include("lib/error.php"); ?>
			<div class="clear"></div>
		</div>
		<?php include("lib/footer.php"); ?>
	</div>
</body>
