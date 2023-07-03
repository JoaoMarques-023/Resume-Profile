<?php

session_start();

if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: ../../auth/login.php");
    exit;
}

function template_header($title) {
	$username  = $_SESSION["username"];

echo <<<EOT
<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>My CMS</title>
		<link href="../../utils/style.css" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	</head>
	<body>
    <nav class="navtop">
    	<div>
    		<h1>Hello $username</h1>
    		<a href="../dashboard/dashboard.php"><i class="fas fa-address-book"></i>Home</a>
			<button type="button" onclick="history.back();">Back</button>
			<a href="../../auth/logout.php">Logout</a>
    	</div>
    </nav>

EOT;
}
function template_footer() {
echo <<<EOT
    </body>
</html>
EOT;
}
?>