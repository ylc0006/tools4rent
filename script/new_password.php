<?php

include('lib/common.php');

if (!isset($_SESSION['email'])) {
    header('Location: login.php');
    exit();
}

    $email = $_SESSION['email'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $password1 = mysqli_real_escape_string($db, $_POST['password1']);
    $password2 = mysqli_real_escape_string($db, $_POST['password2']);

    if ( $password1 == $password2 )   {

        $query = "UPDATE Clerk " .
                 "SET Password = '" . $password1 . "'" .
                 "WHERE Email = '" . $email . "'";

        $result = mysqli_query($db, $query);
        include('lib/show_queries.php');
        redirect_to('login.php');

    } else {
            array_push($error_msg, "Passwords do not match. Please enter again.");
            // redirect_to('new_password.php');
        }
}
?>


<?php include("lib/header.php"); ?>
<title>Tools-4-Rent!</title>
</head>
<body>
    <div id="main_container">
        <div id="header">
            <div class="logo">
               <img src="img/tools4rent_logo.png" width="820" height="100" style="opacity:0.5;background-color:E9E5E2;" border="0" alt="" title="Tools4Rent Logo">
           </div>
       </div>

       <div class="center_content">
        <div class="text_box">
            <form name="new_passwordform" action="new_password.php" method="post" enctype="multipart/form-data">
                <div class="title">Enter New Password</div>
                <div class="login_form_row">
                    <label class="login_label">New password:</label>
                    <input type="password" name="password1" value="" class="form_control"/>
                </div>
                <div class="login_form_row">
                    <label class="login_label">Enter again:</label>
                    <input type="password" name="password2" value="" class="form_control"/>
                </div>
                <a href="javascript:new_passwordform.submit();" class="fancy_button">Confirm</a>
                <form/>
            </div>

            <?php include("lib/error.php"); ?>

            <div class="clear"></div>
        </div>

            
        <?php include("lib/footer.php"); ?>

    </div>
</body>
</html>
