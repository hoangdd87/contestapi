<?php
include_once 'PDOHelper.php';
if ( $_POST ) { // Nếu user vừa bấm nút đăng nhập
	$pdoHelper = new PDOHelper();
	$user      = $pdoHelper->getUser( $_POST );
	if($user) {
		session_start();
		$_SESSION['user'] = $user;
	}
	else{
	    echo 'login failed';
    }
} else {

	?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Login</title>
    </head>
    <body>
    <form enctype="multipart/form-data" action="login.php" method="POST">
        <label>ID:</label> <input type="text" name="id"><br/>
        <br>
        <label>Password:</label><input type="password" name="password">
        <button type="submit">Submit</button>
    </form>
    </body>
    </html>

<?php } ?>

