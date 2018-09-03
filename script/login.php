<?php
include('lib/common.php');


if($showQueries){
  array_push($query_msg, "showQueries currently turned ON, to disable change to 'false' in lib/common.php");
}

//Note: known issue with _POST always empty using PHPStorm built-in web server: Use *AMP server instead
if( is_post_request()) {

	$enteredEmail = db_escape($db, $_POST['email']);
	$enteredPassword = db_escape($db, $_POST['password']);
  $user_table = db_escape($db, $_POST['logintype']);

    if (empty($enteredEmail)) {
      array_push($error_msg,  "Please enter an email address.");
  }

  if (empty($enteredPassword)) {
     array_push($error_msg,  "Please enter a password.");
  }

// user login
if ( !empty($enteredEmail) && !empty($enteredPassword) && $user_table == customer )   {

    $query = "SELECT password FROM $user_table WHERE email='$enteredEmail'";

    $result = mysqli_query($db, $query);
    include('lib/show_queries.php');
    $count = mysqli_num_rows($result);

    if (!empty($result) && ($count > 0) ) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $storedPassword = $row['password'];

        $options = [
            'cost' => 8,
        ];
             //convert the plaintext passwords to their respective hashses
             // 'michael123' = $2y$08$kr5P80A7RyA0FDPUa8cB2eaf0EqbUay0nYspuajgHRRXM9SgzNgZO
            $storedHash = password_hash($storedPassword, PASSWORD_DEFAULT , $options);   //may not want this if $storedPassword are stored as hashes (don't rehash a hash)
            $enteredHash = password_hash($enteredPassword, PASSWORD_DEFAULT , $options);

            if($showQueries){
                array_push($query_msg, "Plaintext entered password: ". $enteredPassword);
                //Note: because of salt, the entered and stored password hashes will appear different each time
                array_push($query_msg, "Entered Hash:". $enteredHash);
                array_push($query_msg, "Stored Hash:  ". $storedHash . NEWLINE);  //note: change to storedHash if tables store the plaintext password value
                //unsafe, but left as a learning tool uncomment if you want to log passwords with hash values
                //error_log('email: '. $enteredEmail  . ' password: '. $enteredPassword . ' hash:'. $enteredHash);
            }

            //depends on if you are storing the hash $storedHash or plaintext $storedPassword
            if (password_verify($enteredPassword, $storedHash) ) {
                array_push($query_msg, "Password is Valid! ");
                $_SESSION['email'] = $enteredEmail;
                array_push($query_msg, "logging in... ");
                redirect_to('customer_main_menu.php');

            } else {
                array_push($error_msg, "Login failed: " . $enteredEmail . NEWLINE . "Password is incorrect for this user.");
            }

        } else {
            array_push($error_msg, "The username entered does not exist: " . $enteredEmail);
            redirect_to('registration.php');
        }
    }
// clerk login
if ( !empty($enteredEmail) && !empty($enteredPassword) && $user_table == clerk )   {

    $query = "SELECT password FROM $user_table WHERE email='$enteredEmail'";

    $result = mysqli_query($db, $query);
    include('lib/show_queries.php');
    $count = mysqli_num_rows($result);

    if (!empty($result) && ($count > 0) ) {
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $storedPassword = $row['password'];

        $options = [
            'cost' => 8,
        ];
             //convert the plaintext passwords to their respective hashses
             // 'michael123' = $2y$08$kr5P80A7RyA0FDPUa8cB2eaf0EqbUay0nYspuajgHRRXM9SgzNgZO
            $storedHash = password_hash($storedPassword, PASSWORD_DEFAULT , $options);   //may not want this if $storedPassword are stored as hashes (don't rehash a hash)
            $enteredHash = password_hash($enteredPassword, PASSWORD_DEFAULT , $options);

            if($showQueries){
                array_push($query_msg, "Plaintext entered password: ". $enteredPassword);
                //Note: because of salt, the entered and stored password hashes will appear different each time
                array_push($query_msg, "Entered Hash:". $enteredHash);
                array_push($query_msg, "Stored Hash:  ". $storedHash . NEWLINE);  //note: change to storedHash if tables store the plaintext password value
                //unsafe, but left as a learning tool uncomment if you want to log passwords with hash values
                //error_log('email: '. $enteredEmail  . ' password: '. $enteredPassword . ' hash:'. $enteredHash);
            }

            //depends on if you are storing the hash $storedHash or plaintext $storedPassword
            if (password_verify($enteredPassword, $storedHash) && $enteredPassword == 0000 ) {
              array_push($query_msg, "Password is Valid! ");
              $_SESSION['email'] = $enteredEmail;
              array_push($query_msg, "logging in... ");
              redirect_to('new_password.php');

            } elseif (password_verify($enteredPassword, $storedHash) && $enteredPassword != 0000) {
              array_push($query_msg, "Password is Valid! ");
              $_SESSION['email'] = $enteredEmail;
              array_push($query_msg, "logging in... ");
              redirect_to('clerk_main_menu.php');
            }
            else {
                array_push($error_msg, "Login failed: " . $enteredEmail . NEWLINE . "Password is incorrect for this clerk.");
            }

        } else {
            array_push($error_msg, "There is no clerk with username: " . $enteredEmail);
        }
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
            <form action="login.php" method="post" enctype="multipart/form-data">
                <div class="title">Login Form</div>
                <div class="login_form_row">
                    <label class="login_label">Email:</label>
                    <input type="text" name="email" value="" class="form_control"/>
                </div>
                <div class="login_form_row">
                    <label class="login_label">Password:</label>
                    <input type="password" name="password" value="" class="form_control"/>
                </div>
                <div class="customer_clerk_radio">
                    <label class="radio-inline"><input type="radio" name="logintype" value="customer" checked="checked"> Customer</label>
                    <label class="radio-inline"><input type="radio" name="logintype" value="clerk"> Clerk</label><br><br>
                </div>
                <input type="image" src="img/login.gif" class="login"/>
                <form/>
            </div>

            <?php include("lib/error.php"); ?>

            <div class="clear"></div>
        </div>

            <!--
            <div class="map">
            <iframe style="position:relative;z-index:999;" width="820" height="600" src="https://maps.google.com/maps?q=801 Atlantic Drive, Atlanta - 30332&t=&z=14&ie=UTF8&iwloc=B&output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0"><a class="google-map-code" href="http://www.embedgooglemap.net" id="get-map-data">801 Atlantic Drive, Atlanta - 30332</a><style>#gmap_canvas img{max-width:none!important;background:none!important}</style></iframe>
            </div>
        -->
        <?php include("lib/footer.php"); ?>

    </div>
</body>
</html>
