<?php
    include("inc/config.php"); 
     if(isset($_SESSION['userLoggedIn'])) {
     	$userLoggedIn = $_SESSION['userLoggedIn'];
     }
     else {
     	header("Location: register.php");
     }
    ?>
<html>
<head>
	<title>Welcome!</title>
</head>

<body>
	Welcome <?php   ?>
</body>

</html>