<html>
<head>
	<title>Edit Passwords</title>
	<?php require_once('header.php'); ?>
</head>
                <body style="background-color: dimgray;">
                                        <div id="TopHeader">
                    <h1 class="Myheader">Update Passwords</h1>
                    </div>
    <div align="center" id="main">
<?php 
    // CHANGE PASSWORD
if (!empty($_POST['saveadminpass'])) {
// Adding Crypt to admin password
    $AdminCrypt = crypt($_POST['adminpassword'], 'P9');
 $updatepass = $db_server->prepare("UPDATE login SET adminPass = ? WHERE password = ?");
	  $updatepass->bind_param('si', $AdminCrypt, $_POST['PassID']);
	  $updatepass->execute(); 
	  $updatepass->close();
	}
if (!empty($_POST['savestudentpass'])) {
// Adding Crypt to student password
    $StudentCrypt = crypt($_POST['password'], 'P9');
 $updatepass = $db_server->prepare("UPDATE login SET password = ? WHERE password = ?");
	  $updatepass->bind_param('si', $StudentCrypt, $_POST['PassID']);
	  $updatepass->execute(); 
	  $updatepass->close();
	} 
	

// GET THE LIST OF PASSWORDS
	$passwordresult = $db_server->query("SELECT * FROM login ORDER BY password");
    ?>
    
<div class="passwords">
<?php
// loop through passwords
while ($passlist = mysqli_fetch_assoc($passwordresult)) { ?>

<form action="" method="post">
<input type="hidden" name="PassPassID" value="<?php echo $passlist['password']; ?>">
        <div id="adminpwd">
		<input type="password" name="adminpassword" placeholder="New Admin Password" autocomplete="off" size="20">
    <button type="submit" name="saveadminpass" value="<?php echo $passlist['password']; ?>">Update</button>
    </div>
    <div id="studentpwd">
		<input type="password" name="password" placeholder="New Student Password" autocomplete="off" size="20">
    <button type="submit" name="savestudentpass" value="<?php echo $passlist['password']; ?>">Update</button>
	    	</div>
</form>
<?php 
} // end while
?>
</div>
        </div>
</body>
</html>