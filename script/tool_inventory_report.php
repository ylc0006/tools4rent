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
$field = 'TotalProfit';
$sort = 'DESC';
$sortOrder='';
$sortTotalProfit='Total Profit';
$sortToolID = 'Tool ID';
$sortCurrentStatus = 'Current Status';
$sortDate = 'Date';
$sortDescription = 'Description';
$sortTotalRentalProfit = 'Total Rental Profit';
$sortTotalCost = 'Total Cost';
$sortTotalProfit = 'Total Profit';

if(isset($_GET['sorting']))
{
    if($_GET['sorting']=='DESC')
    {
        $sort='ASC';
        $sortOrder=' &#8593';
    }
    else
    {
        $sort='DESC';
        $sortOrder=' &#8595';
    }
}

function get_query ($custom_search, $field, $sort) {
  $query = "SELECT T.ToolID, (CASE
            WHEN NOW() <= RS.EndDate THEN 'Rented'
            ELSE 'Available'
            END) AS CurrentStatus, (CASE
            WHEN NOW() > RS.EndDate THEN ''
            ELSE RS.EndDate
            END) AS Date, CONCAT_WS(' ',CASE T.PowerSource WHEN 'manual' THEN '' ELSE T.PowerSource END, T.SubOption, T.SubType) AS Description,
            IFNULL(RS.TotalRentalProfit,0) AS TotalRentalProfit, (T.PurchasePrice) AS TotalCost, (IFNULL(RS.TotalRentalProfit,0) - T.PurchasePrice) AS TotalProfit
            FROM Tools AS T
            LEFT JOIN (
            SELECT Tools.ToolID, Max(EndDate) as EndDate, Sum(.15 * PurchasePrice) AS TotalRentalProfit
            FROM Reservation
            LEFT JOIN BEEN ON Reservation.ReservationID= Been.ReservationID
            LEFT JOIN Tools ON Been.ToolID = Tools.ToolID
            GROUP BY ToolID
            ) AS RS ON T.ToolID = RS.ToolID
            WHERE T.SubOption LIKE '%$custom_search%'
            ORDER BY $field $sort"
            ;
    return $query;
}

if(isset($_GET['field']))
{
    if($_GET['field']=='TotalProfit')
    {
        $field='TotalProfit';
        $sortTotalProfit='Total Profit ' . $sortOrder;

        // if all tool selected
          $custom_search = db_escape($db, $_POST['CustomSearch']);

          $query = get_query ($custom_search, $field, $sort);
          $result = mysqli_query($db, $query);
          include('lib/show_queries.php');
    }
    elseif ($_GET['field']=='ToolID')
        {
            $field='ToolID';
            $sortTotalProfit='Tool ID ' . $sortOrder;

            // if all tool selected
              $custom_search = db_escape($db, $_POST['CustomSearch']);

              $query = get_query ($custom_search, $field, $sort);
              $result = mysqli_query($db, $query);
              include('lib/show_queries.php');
        }
        elseif ($_GET['field']=='CurrentStatus')
            {
                $field='CurrentStatus';
                $sortTotalProfit='Current Status ' . $sortOrder;

                // if all tool selected
                  $custom_search = db_escape($db, $_POST['CustomSearch']);

                  $query = get_query ($custom_search, $field, $sort);
                  $result = mysqli_query($db, $query);
                  include('lib/show_queries.php');
            }
            elseif ($_GET['field']=='Date')
                {
                    $field='Date';
                    $sortTotalProfit='Date ' . $sortOrder;

                    // if all tool selected
                      $custom_search = db_escape($db, $_POST['CustomSearch']);

                      $query = get_query ($custom_search, $field, $sort);
                      $result = mysqli_query($db, $query);
                      include('lib/show_queries.php');
                }
                elseif ($_GET['field']=='Description')
                    {
                        $field='Description';
                        $sortTotalProfit='Description ' . $sortOrder;

                        // if all tool selected
                          $custom_search = db_escape($db, $_POST['CustomSearch']);

                          $query = get_query ($custom_search, $field, $sort);
                          $result = mysqli_query($db, $query);
                          include('lib/show_queries.php');
                    }
                    elseif ($_GET['field']=='TotalRentalProfit')
                        {
                            $field='TotalRentalProfit';
                            $sortTotalProfit='Total Rental Profit ' . $sortOrder;

                            // if all tool selected
                              $custom_search = db_escape($db, $_POST['CustomSearch']);

                              $query = get_query ($custom_search, $field, $sort);
                              $result = mysqli_query($db, $query);
                              include('lib/show_queries.php');
                        }
                        elseif ($_GET['field']=='TotalCost')
                            {
                                $field='TotalCost';
                                $sortTotalProfit='Total Cost ' . $sortOrder;

                                // if all tool selected
                                  $custom_search = db_escape($db, $_POST['CustomSearch']);

                                  $query = get_query ($custom_search, $field, $sort);
                                  $result = mysqli_query($db, $query);
                                  include('lib/show_queries.php');
                            }
}


if (is_post_request()) {
  $custom_search = db_escape($db, $_POST['CustomSearch']);
	$type = db_escape($db, $_POST['ToolType']);


  // if specific tool type selected
  if ($type != AllTools ) {
    $query = "SELECT T.ToolID, (CASE
              WHEN NOW() <= RS.EndDate THEN 'Rented'
              ELSE 'Available'
              END) AS CurrentStatus, (CASE
              WHEN NOW() > RS.EndDate THEN ''
              ELSE RS.EndDate
              END) AS Date, CONCAT_WS(' ',CASE T.PowerSource WHEN 'manual' THEN '' ELSE T.PowerSource END, T.SubOption, T.SubType) AS Description,
              IFNULL(RS.TotalRentalProfit,0) AS TotalRentalProfit, (T.PurchasePrice) AS TotalCost, (IFNULL(RS.TotalRentalProfit,0) - T.PurchasePrice) AS TotalProfit
              FROM Tools AS T
              LEFT JOIN (
              SELECT Tools.ToolID, Max(EndDate) as EndDate, Sum(.15 * PurchasePrice) AS TotalRentalProfit
              FROM Reservation
              LEFT JOIN BEEN ON Reservation.ReservationID= Been.ReservationID
              LEFT JOIN Tools ON Been.ToolID = Tools.ToolID
              GROUP BY ToolID
            ) AS RS ON T.ToolID = RS.ToolID
              WHERE T.Type = '" . $type . "' AND T.SubOption LIKE '%$custom_search%'
              ORDER BY $field $sort" ;

      $result = mysqli_query($db, $query);
      include('lib/show_queries.php');
  }

  // if all tool selected
  if ($type == AllTools ) {
    $query = "SELECT T.ToolID, (CASE
              WHEN NOW() <= RS.EndDate THEN 'Rented'
              ELSE 'Available'
              END) AS CurrentStatus, (CASE
              WHEN NOW() > RS.EndDate THEN ''
              ELSE RS.EndDate
              END) AS Date, CONCAT_WS(' ',CASE T.PowerSource WHEN 'manual' THEN '' ELSE T.PowerSource END, T.SubOption, T.SubType) AS Description,
              IFNULL(RS.TotalRentalProfit,0) AS TotalRentalProfit, (T.PurchasePrice) AS TotalCost, (IFNULL(RS.TotalRentalProfit,0) - T.PurchasePrice) AS TotalProfit
              FROM Tools AS T
              LEFT JOIN (
              SELECT Tools.ToolID, Max(EndDate) as EndDate, Sum(.15 * PurchasePrice) AS TotalRentalProfit
              FROM Reservation
              LEFT JOIN BEEN ON Reservation.ReservationID= Been.ReservationID
              LEFT JOIN Tools ON Been.ToolID = Tools.ToolID
              GROUP BY ToolID
              ) AS RS ON T.ToolID = RS.ToolID
              WHERE T.SubOption LIKE '%$custom_search%'
              ORDER BY $field $sort"
              ;

      $result = mysqli_query($db, $query);
      include('lib/show_queries.php');
  }

}


?>

<?php include("lib/header.php"); ?>
<title>Tool Inventory Report</title>
<script>

      function openToolDetails(id) {
        var table = document.getElementById('reservations-table');
        var tool_id = table.rows[id].cells[0].innerText;
        window.open("http://localhost:8080/tools4rent/script/view_tool_detail.php?id=" + tool_id);
      };

</script>
</head>

<body>
    <div id="main_container">
        <?php include("lib/clerk_menu.php"); ?>
        <div class="center_content">
        <div class="features">

          <div class="profile_section">
            <form name="searchform" action="tool_inventory_report.php" method="POST">
              <div class="subtitle">Tool Inventory Report</div>
              <div class="row">
                <div class="col-sm-6"><b>Type:</b></div>
              </div>
              <div class="row">
                <label class="col-sm-2 radio-inline"><input type="radio" name="ToolType" value="AllTools" checked="checked" onclick="dropDownUpdate(this.value)">All Tools </label>
                <label class="col-sm-2 radio-inline"><input type="radio" name="ToolType" value="Hand Tool" onclick="dropDownUpdate(this.value)"> Hand Tool</label>
                <label class="col-sm-2 radio-inline"><input type="radio" name="ToolType" value="Garden Tool" onclick="dropDownUpdate(this.value)"> Garden Tool</label>
                <label class="col-sm-2 radio-inline"><input type="radio" name="ToolType" value="Ladder Tool" onclick="dropDownUpdate(this.value)"> Ladder</label>
                <label class="col-sm-2 radio-inline"><input type="radio" name="ToolType" value="Power Tool" onclick="dropDownUpdate(this.value)"> Power Tool</label>
              </div>
              <div class="row">
                <div class="col-sm-4"><b>Custom Search:</b></div>
              </div>
              <div class="row">
                <div class="col-sm-4 form-group">
                  <input type="text" placeholder="Custom Search" class="form-control" name="CustomSearch">
                </div>
              </div>
              <a href="javascript:searchform.submit();"><button type="button" class="btn btn-lg btn-info">Search</button></a>
              </form>
              <table id="reservations-table">
                  <tr>
                      <td class="heading"><a href="tool_inventory_report.php?sorting=<?php echo $sort ?>&field=ToolID"><?php echo $sortToolID; ?></td>
                      <td class="heading"><a href="tool_inventory_report.php?sorting=<?php echo $sort ?>&field=CurrentStatus"><?php echo $sortCurrentStatus; ?></td>
                      <td class="heading"><a href="tool_inventory_report.php?sorting=<?php echo $sort ?>&field=Date"><?php echo $sortDate; ?></td>
                      <td class="heading"><a href="tool_inventory_report.php?sorting=<?php echo $sort ?>&field=Description"><?php echo $sortDescription; ?></td>
                      <td class="heading"><a href="tool_inventory_report.php?sorting=<?php echo $sort ?>&field=TotalRentalProfit"><?php echo $sortTotalRentalProfit; ?></td>
                      <td class="heading"><a href="tool_inventory_report.php?sorting=<?php echo $sort ?>&field=TotalCost"><?php echo $sortTotalCost; ?></td>
                      <td class="heading"><a href="tool_inventory_report.php?sorting=<?php echo $sort ?>&field=TotalProfit"><?php echo $sortTotalProfit; ?></td>

                  </tr>

                  <?php while ( $ToolInventoryReport = mysqli_fetch_assoc($result)){ ?>

                      <tr>
                        <td><?php echo $ToolInventoryReport['ToolID'];  ?></td>
                        <td>
                        <?php
                        $color = "green";
                        if ($ToolInventoryReport['CurrentStatus'] == 'Rented')
                          $color = "yellow";
                        echo '<span style="background-color:' . $color . ';text-align:center;">'. $ToolInventoryReport['CurrentStatus'] .'</span>'?></td>
                        <td><?php echo $ToolInventoryReport['Date']; ?></td>
                        <td><a href="#" onClick="openToolDetails(this.parentElement.parentElement.rowIndex)">
                          <?php echo $ToolInventoryReport['Description']; ?></td>
                        <td><?php echo $ToolInventoryReport['TotalRentalProfit']; ?></td>
                        <td><?php echo $ToolInventoryReport['TotalCost']; ?></td>
                        <td><?php echo $ToolInventoryReport['TotalProfit']; ?></td>
                      </tr>

                  <?php  } ?>


              </table>
          </div>
          <a href="generate_reports.php"> <button type="button" class="btn btn-lg btn-info">Back to Report Menu</button>	</a>
       </div>
       <?php include("lib/error.php"); ?>

       <div class="clear"></div>
     </div>
         <?php include("lib/footer.php"); ?>
    </div>
  </body>
