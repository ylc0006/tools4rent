<?php

include('lib/common.php');

//if (!isset($_SESSION['email'])) {
if(isset($_POST['login'])) {
    header('Location: login.php');
    exit();
}

?>

<?php include("lib/header.php"); ?>
<title>Tools-4-Rent! Clerk Main Menu</title>
</head>

<body>
    <div id="main_container">
        <?php include("lib/clerk_menu.php"); ?>
        <div class="menu_list">
        <div class="list-group" >
            <a href="pick_up.php" class="list-group-item">Pick Up Reservations</a>
            <a href="drop_off.php" class="list-group-item">Drop Off Reservations</a>
            <a href="add_tool.php" class="list-group-item">Add New Tool</a>
            <a href="generate_reports.php" class="list-group-item">Generate Reports</a>
            <a href="logout.php" class="list-group-item">Exit</a>
        </div>
    </div>
    </div>

<?php include("lib/footer.php"); ?>
