<?php

include('lib/common.php');

if(isset($_POST['login'])) {
    header('Location: login.php');
    exit();
}

?>

<?php include("lib/header.php"); ?>
<title>Tools-4-Rent! Customer Main Menu</title>
</head>

<body>
    <div id="main_container">
        <?php include("lib/customer_menu.php"); ?>
        <div class="menu_list">
        <div class="list-group" >
            <a href="view_profile.php" class="list-group-item">View Profile</a>
            <a href="check_tool_availability.php" class="list-group-item">Check Tool Availability</a>
            <a href="make_reservation.php" class="list-group-item">Make Reservation</a>
            <a href="logout.php" class="list-group-item">Exit</a>
        </div>
    </div>
    </div>

<?php include("lib/footer.php"); ?>
