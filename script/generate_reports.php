<?php

include('lib/common.php');

//if (!isset($_SESSION['email'])) {
if(isset($_POST['login'])) {
    header('Location: login.php');
    exit();
}

?>

<?php include("lib/header.php"); ?>
<title>Generate Reports Menu</title>
</head>

<body>
    <div id="main_container">
        <?php include("lib/clerk_menu.php"); ?>
        <h1>Select a Report</h1>
        <div class="menu_list">
          <div class="list-group" >
              <a href="clerk_report.php" class="list-group-item">Clerk Report</a>
              <a href="customer_report.php" class="list-group-item">Customer Report</a>
              <a href="tool_inventory_report.php" class="list-group-item">Tool Inventory Report</a>
          </div>
       </div>
    </div>

<?php include("lib/footer.php"); ?>
