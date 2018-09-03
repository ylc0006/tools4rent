<?php

include('lib/common.php');

$id = $_GET['id'] ?? '1';

$query = "SELECT T.ToolID, T.Type, CONCAT_WS(' ', (CASE PowerSource WHEN 'manual' THEN '' ELSE PowerSource END), SubOption, SubType) AS ShortDescription, " .
          "CONCAT_WS(' ', Width_Diameter_Int, Width_Diameter_Fraction, Width_Diameter_Unit, 'W x', LengthInt, LengthFraction, LengthUnit, 'L', Weight, 'lb', (CASE PowerSource " .
          "WHEN 'manual' THEN '' " .
          "ELSE PowerSource END), SubOption, SubType, (CASE Type " .
          "WHEN 'Hand Tool' THEN (CASE SubType " .
          "WHEN 'Screwdriver' THEN CONCAT('#', SCR.ScrewSize) " .
          "WHEN 'Socket' THEN CONCAT_WS(' ', SOC.DriveSize, " .
          "SOC. SaeSize, (CASE DeepSocket " .
          "WHEN TRUE THEN 'Deep Socket' " .
          "ELSE 'Non-Deep Socket' " .
          "END)) " .
          "WHEN 'Rachet' THEN RAT .DriveSize " .
          "WHEN 'Plier' THEN (CASE PLI.Adjustable " .
          "WHEN TRUE THEN 'Adjustable' " .
          "ELSE 'Non-Adjustable' " .
          "END) " .
          "WHEN 'Gun' THEN CONCAT_WS(' ', GUN.GaugeRating, " .
          "GUN.Capacity, 'nails/staples') " .
          "WHEN 'Hammer' THEN (CASE HAM.AntiVibration " .
          "WHEN TRUE THEN 'Anti-Vibration' " .
          "ELSE 'Non Anti-Vibration' " .
          "END) " .
          "END) " .
          "WHEN 'Garden Tool' THEN CONCAT_WS(' ', HandleMaterial, (CASE " .
          "SubType " .
          "WHEN 'Pruning Tool' THEN CONCAT_WS(' ', PRU.BladeMaterial, PRU.BladeLength) " .
          "WHEN 'Striking Tool' THEN HeadWeight " .
          "WHEN 'Digging Tools' THEN CONCAT_WS(' ', DIG.BladeWidth, DIG.BladeLength) " .
          "WHEN 'Rake Tools' THEN TineCount " .
          "WHEN 'WheelbarrowTools' THEN CONCAT_WS(' ', BinMaterial, BinVolume, WheelCount) " .
          "END)) " .
          "WHEN 'LadderTools' THEN CONCAT_WS(' ', StepCount, WeightCapacity, " .
          "(CASE SubType " .
          "WHEN 'Straight' THEN (CASE RubberFeet " .
          "WHEN TRUE THEN 'Rubber Feet' " .
          "ELSE 'Non-Rubber Feet' " .
          "END) " .
          "WHEN 'Step' THEN (CASE PailShelf " .
          "WHEN TRUE THEN 'Pail Shef' " .
          "ELSE 'Non-Pail Shelf' " .
          "END) " .
          "END)) " .
          "WHEN 'Power Tools' THEN CONCAT_WS(' ', PT .VoltRating, " .
          "PT .AmpRating, 'A', PT .RPMRatingMin, PT .RPMRatingMax, (CASE SubType WHEN 'Drill' THEN CONCAT_WS(' ', (CASE AdjustableClutch " .
          "WHEN TRUE THEN 'Adjustable Clutch' " .
          "ELSE 'Non-Adjustable Clutch' " .
          "END), TorqueRatingMin, TorqueRatingMax) " .
          "WHEN 'Saw' THEN BladeSize " .
          "WHEN 'Sander' THEN (CASE DustBag " .
          "WHEN TRUE THEN 'Dust Bag' " .
          "ELSE 'Non-Dust Bag' " .
          "END) " .
          "WHEN 'AirCompresor' THEN CONCAT_WS(' ', TankSize, 'gallon' , " .
          "PressureRatingMin, 'psi', PressureRatingMax, 'psi') " .
          "WHEN 'Mixer' THEN CONCAT_WS(' ', MotorRating, 'HP', " .
          "DrumSize, 'cu ft') " .
          "WHEN 'Generator' THEN CONCAT_WS(' ', GEN.PowerGenerated, ' W') " .
          "END)) " .
          "END), Manufacturer, Material, ACC.Quantity, " .
          "ACC.AccessoryDescription, ACC.BatteryQuantity, ACC.BatteryType, ACC.VoltRating) AS " .
          "FullDescriptions, ROUND(.15* PurchasePrice,2) AS RentalPrice, ROUND(.4 * PurchasePrice, 2) AS DepositPrice " .
          "FROM Tools AS T " .
          "LEFT OUTER JOIN HandTools AS HT ON T.ToolID = HT.ToolID " .
          "LEFT OUTER JOIN Screwdriver AS SCR ON T.ToolID = SCR.ToolID " .
          "LEFT OUTER JOIN Socket AS SOC ON T.ToolID= SOC.ToolID " .
          "LEFT OUTER JOIN Ratchet AS RAT ON T.ToolID = RAT.ToolID " .
          "LEFT OUTER JOIN Plier AS PLI ON T.ToolID = PLI.ToolID " .
          "LEFT OUTER JOIN Gun AS GUN ON T.ToolID = GUN.ToolID " .
          "LEFT OUTER JOIN Hammer AS HAM ON T.ToolID = HAM.ToolID " .
          "LEFT OUTER JOIN GardenTools AS GT ON T.ToolID = GT.ToolID " .
          "LEFT OUTER JOIN PruningTools AS PRU ON T.ToolID = PRU.ToolID " .
          "LEFT OUTER JOIN StrikingTools AS STR ON T.ToolID = STR.ToolID " .
          "LEFT OUTER JOIN DiggingTools AS DIG ON T.ToolID = DIG.ToolID " .
          "LEFT OUTER JOIN RakeTools AS RAK ON T.ToolID = RAK.ToolID " .
          "LEFT OUTER JOIN WheelbarrowTools AS WHE ON T.ToolID = WHE.ToolID " .
          "LEFT OUTER JOIN PowerTools AS PT ON T.ToolID = PT.ToolID " .
          "LEFT OUTER JOIN Drill AS DRI ON T.ToolID = DRI.ToolID " .
          "LEFT OUTER JOIN Saw AS SAW ON T.ToolID = SAW.ToolID " .
          "LEFT OUTER JOIN Sander AS SAN ON T.ToolID = SAN.ToolID " .
          "LEFT OUTER JOIN AirCompressor AS AIR ON T.ToolID = AIR.ToolID " .
          "LEFT OUTER JOIN Mixer AS MIX ON T.ToolID = MIX.ToolID " .
          "LEFT OUTER JOIN Generator AS GEN ON T.ToolID = GEN.ToolID " .
          "LEFT OUTER JOIN LadderTools AS LD ON T.ToolID = LD.ToolID " .
          "LEFT OUTER JOIN Straight AS STL ON T.ToolID = STL.ToolID " .
          "LEFT OUTER JOIN Step AS STE ON T.ToolID = STE.ToolID " .
          "LEFT OUTER JOIN Contain AS CONT ON T.ToolID = CONT.ToolID " .
          "LEFT OUTER JOIN Accessories AS ACC ON CONT.AccessoryID = ACC.AccessoryID " .
          "WHERE T.ToolID = " . $id ;

$result = mysqli_query($db, $query);

include('lib/show_queries.php');

if (mysqli_affected_rows($db) == -1) {
    array_push($error_msg,  "SELECT ERROR:Failed to view tool detail ... <br>" . __FILE__ ." line:". __LINE__ );
}

$row = mysqli_fetch_assoc($result);

// query for Accessory
$query = "SELECT AccessoryDescription
          FROM Accessories
          WHERE AccessoryID IN (select AccessoryID FROM Contain Where ToolID = " . $id .") ";
$result = mysqli_query($db, $query);
include('lib/show_queries.php');

$accessoyrrow = mysqli_fetch_assoc($result);


?>

<?php include("lib/header.php"); ?>
<title>View Profile</title>
</head>

<body>
		<div id="main_container">
    <?php include("lib/clerk_menu.php"); ?>

    <div class="center_content">
        <div class="center_left">
            <div class="features">

                <div class="profile_section">
                    <div class="subtitle">Tool Details</div>
                    <table>
                        <tr>
                            <td class="item_label">Tool ID</td>
                            <td>
                                <?php echo $row['ToolID']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="item_label">Short Description</td>
                            <td>
                                <?php echo $row['ShortDescription'];?>
                            </td>
                        </tr>
                        <tr>
                            <td class="item_label">Full Description</td>
                            <td>
                                <?php echo $row['FullDescriptions']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="item_label">Deposit Price</td>
                            <td>
                                <?php echo $row['DepositPrice']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="item_label">Rental Price</td>
                            <td>
                                <?php  echo $row['RentalPrice']; ?>
                            </td>
                        </tr>
                        <tr>
                            <td class="item_label">Accessory</td>
                            <td>
                                <?php  echo $accessoyrrow['AccessoryDescription']; ?>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
            <a href="clerk_main_menu.php"> <button type="button" class="btn btn-lg btn-info">Back to Clerk Menu</button>	</a>
        </div>

                <?php include("lib/error.php"); ?>

				<div class="clear"></div>
			</div>

               <?php include("lib/footer.php"); ?>

		</div>
	</body>
</html>
